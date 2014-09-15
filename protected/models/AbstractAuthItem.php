<?php
/**
 * This is the model class for table "auth_item".
 *
 * The followings are the available columns in table 'auth_item':
 * @property string $name
 * @property string $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property User[] $users
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren1
 */
abstract class AbstractAuthItem extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractAuthItem the static model class
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
        return 'auth_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, type', 'required'),
            array('name', 'length', 'max'=>64),
            array('type', 'length', 'max'=>11),
            array('description, bizrule, data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, type, description, bizrule, data', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'users' => array(self::MANY_MANY, 'User', 'auth_assignment(itemname, userid)'),
            'authItemChildren' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
            'authItemChildren1' => array(self::HAS_MANY, 'AuthItemChild', 'parent'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'bizrule' => 'Bizrule',
            'data' => 'Data',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('name',$this->name,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('bizrule',$this->bizrule,true);
        $criteria->compare('data',$this->data,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
