<?php
/**
 * ExtModelCode file
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

Yii::import('system.gii.generators.model.*');
Yii::import('system.gii.*');

/**
 * ExtModelCode class
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */
class ExtModelCode extends ModelCode
{
    /**
     * Returns a list of available code templates (name=>directory).
     * This method simply returns the {@link CCodeGenerator::templates} property value.
     * @return array a list of available code templates (name=>directory).
     */
    public function getTemplates()
    {
        return array(
            'default' => dirname(__FILE__) . '/templates'
        );
    }

    /**
     * Generate a name for use as a relation name (inside relations() function in a model).
     * @param string the name of the table to hold the relation
     * @param string the foreign key name
     * @param boolean whether the relation would contain multiple objects
     * @return string the relation name
     */
    protected function generateRelationName($tableName, $fkName, $multiple)
    {
        $relationName = parent::generateRelationName($tableName, $fkName, $multiple);
        return preg_replace('/Fk$/', '', $relationName);
    }

    /**
     * Prepare view data and render code templates
     */
    public function prepare()
    {
        if(($pos=strrpos($this->tableName,'.'))!==false)
        {
            $schema=substr($this->tableName,0,$pos);
            $tableName=substr($this->tableName,$pos+1);
        }
        else
        {
            $schema='';
            $tableName=$this->tableName;
        }
        if($tableName[strlen($tableName)-1]==='*')
        {
            $tables=Yii::app()->db->schema->getTables($schema);
            if($this->tablePrefix!='')
            {
                foreach($tables as $i=>$table)
                {
                    if(strpos($table->name,$this->tablePrefix)!==0)
                        unset($tables[$i]);
                }
            }
        }
        else
            $tables=array($this->getTableSchema($this->tableName));

        $this->files=array();
        $templatePath=$this->templatePath;
        $this->relations=$this->generateRelations();

        foreach($tables as $table)
        {
            $tableName=$this->removePrefix($table->name);
            $className=$this->generateClassName($table->name);
            
            $this->createModelClass($table, $schema, $tableName, $className);
            $this->createWrapperClass($table, $schema, $tableName, $className);
        }
    }
    
    protected function createModelClass($table, $schema, $tableName, $className)
    {
        $templatePath=$this->templatePath;

        $params=array(
            'tableName'=>$schema==='' ? $tableName : $schema.'.'.$tableName,
            'modelClass'=>'Abstract'.$className,
            'columns'=>$table->columns,
            'labels'=>$this->generateLabels($table),
            'rules'=>$this->generateRules($table),
            'relations'=>isset($this->relations[$className]) ? $this->relations[$className] : array(),
        );

        $this->files[]=new CCodeFile(
            Yii::getPathOfAlias($this->modelPath).'/'.$params['modelClass'].'.php',
            $this->render($templatePath.'/model.php', $params)
        );
    }
    
    protected function createWrapperClass($table, $schema, $tableName, $className)
    {
        $templatePath=$this->templatePath;
        
        $wrapperParams = array(
            'modelClass'=>$className,
            'baseClass'=>'Abstract'.$className,
            'tableName'=>$tableName,
        );

        $modelWrapperFile = Yii::getPathOfAlias($this->modelPath).'/'.$wrapperParams['modelClass'].'.php';

        if (!file_exists($modelWrapperFile))
        {
            $this->files[]=new CCodeFile(
                $modelWrapperFile,
                $this->render($templatePath.'/model_wrapper.php', $wrapperParams)
            );
        }
    }
    
    protected function generateRelationClassName($tableName)
    {
        return $this->generateClassName($tableName);
    }

    protected function generateRelations()
    {
        if(!$this->buildRelations)
            return array();
        $relations=array();
        foreach(Yii::app()->db->schema->getTables() as $table)
        {
            if($this->tablePrefix!='' && strpos($table->name,$this->tablePrefix)!==0)
                continue;
            $tableName=$table->name;

            if ($this->isRelationTable($table))
            {
                $pks=$table->primaryKey;
                $fks=$table->foreignKeys;

                $table0=$fks[$pks[0]][0];
                $table1=$fks[$pks[1]][0];
                $className0=$this->generateRelationClassName($table0);
                $className1=$this->generateRelationClassName($table1);

                $unprefixedTableName=$this->removePrefix($tableName);

                $relationName=$this->generateRelationName($table0, $table1, true);
                $relations[$className0][$relationName]="array(self::MANY_MANY, '{$className1}', '$unprefixedTableName($pks[0], $pks[1])')";

                $relationName=$this->generateRelationName($table1, $table0, true);
                $relations[$className1][$relationName]="array(self::MANY_MANY, '{$className0}', '$unprefixedTableName($pks[1], $pks[0])')";
            }
            else
            {
                $className=$this->generateClassName($tableName);
                $classNameAlias=$this->generateRelationClassName($tableName);
                foreach ($table->foreignKeys as $fkName => $fkEntry)
                {
                    // Put table and key name in variables for easier reading
                    $refTable=$fkEntry[0]; // Table name that current fk references to
                    $refKey=$fkEntry[1];   // Key in that table being referenced
                    $refClassName=$this->generateClassName($refTable);
                    $refClassNameAlias = $this->generateRelationClassName($refTable);
                    // Add relation for this table
                    $relationName=$this->generateRelationName($tableName, $fkName, false);
                    
                    
                    
                    $relations[$className][$relationName]="array(self::BELONGS_TO, '{$refClassNameAlias}', '$fkName')";

                    // Add relation for the referenced table
                    $relationType=$table->primaryKey === $fkName ? 'HAS_ONE' : 'HAS_MANY';
                    $relationName=$this->generateRelationName($refTable, $this->removePrefix($tableName,false), $relationType==='HAS_MANY');
                    $i=1;
                    $rawName=$relationName;
                    while(isset($relations[$refClassName][$relationName]))
                        $relationName=$rawName.($i++);
                    $relations[$refClassName][$relationName]="array(self::$relationType, '{$classNameAlias}', '$fkName')";
                }
            }
        }
        return $relations;
    }

}