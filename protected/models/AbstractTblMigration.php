<?php
/**
 * This is the model class for table "tbl_migration".
 *
 * The followings are the available columns in table 'tbl_migration':
 * @property string $version
 * @property string $apply_time
 */
abstract class AbstractTblMigration extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractTblMigration the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_migration';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('version', 'required'),
            array('version', 'length', 'max'=>255),
            array('apply_time', 'length', 'max'=>11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('version, apply_time', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'version' => 'Version',
            'apply_time' => 'Apply Time',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('version',$this->version,true);
        $criteria->compare('apply_time',$this->apply_time,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
