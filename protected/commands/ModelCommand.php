<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::import('application.commands.model.*');

/**
 * Description of ModelCommand
 *
 * @author malyshev
 */
class ModelCommand extends CConsoleCommand
{
    /**
     * @var string class name for base models 
     */
    public $baseClass = 'ActiveRecord';

    /**
     * @var CDbConnection
     */
    protected $dbConnection;

    /**
     * @var CDbSchema
     */
    protected $dbSchema;

    /**
     * @var array current schema tables
     */
    protected $tableNames;
    
    /**
     * Ignore table names.
     * 
     * @var array
     */
    public $ignoreTableNames = array(
    );

    /**
     * Ignore table names(system).
     * 
     * @var array
     */
    public $systemTableNames = array(
    );

    /**
     * Initializes the command object.
     * This method is invoked after a command object is created and initialized with configurations.
     * You may override this method to further customize the command before it executes.
     * @since 1.1.6
     */
    public function init()
    {
        if (null === Yii::app()->db)
            throw new CException('An active "db" connection is required to run this command.');

        $this->dbConnection = Yii::app()->db;
        $this->dbSchema = $this->dbConnection->getSchema();
        $this->tableNames = array_diff($this->dbSchema->tableNames,
                (array) $this->ignoreTableNames, (array) $this->systemTableNames);
    }

    /**
     * Run the command with default action
     */
    public function actionIndex()
    {
        foreach ($this->tableNames as $table) {
            $this->actionModel($table);
        }
        echo "Done.\n";
    }
    
    public function actionClean()
    {
        foreach($this->moduleList as $moduleId)
        {
            $modelPath = Yii::getPathOfAlias($moduleId);
            if (file_exists($modelPath) && is_dir($modelPath))
            {
                $files = array_filter(scandir($modelPath), function($el){
                    return preg_match('/^[a-zA-Z]+Model$/', basename($el, '.php'));
                });
                
                foreach ($files as $file)
                {
                    unlink($modelPath . DIRECTORY_SEPARATOR . $file);
                }
            }
            
        }
    }

    public function actionModel($name)
    {
        $modelCode = new ExtModelCode;
        $modelCode->modelPath = 'application.models';
        $modelCode->baseClass = $this->baseClass;
        $modelCode->template = 'default';

        $modelCodeClassNameGenerator = new ReflectionMethod(get_class($modelCode), 'generateClassName');
        $modelCodeClassNameGenerator->setAccessible(true);
        $modelCode->modelClass = $modelCodeClassNameGenerator->invoke($modelCode,
                $name);

        $modelCodeClassNameGenerator->invoke($modelCode, $name);
        $modelCode->tableName = $name;
        $modelCode->prepare();

        foreach ($modelCode->files as $file) {
            echo "Generate model {$modelCode->modelClass}\n";
            file_put_contents($file->path, $file->content);
        }
    }

    /**
     * @return string help info output 
     */
    public function getHelp()
    {
        return <<<EOD
USAGE
  yiic model <action> [params]

DESCRIPTION
  This command generate/update all base AR model classes,
  and generate extended AR model classes if not exists.

ACTIONS
    model - generate/update model class, and generate extended AR model classes if not exists
EOD;
    }
}
