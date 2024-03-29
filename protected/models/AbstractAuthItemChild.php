<?php
/**
 * This is the model class for table "auth_item_child".
 *
 * The followings are the available columns in table 'auth_item_child':
 * @property string $parent
 * @property string $child
 *
 * The followings are the available model relations:
 * @property AuthItem $child0
 * @property AuthItem $parent0
 */
abstract class AbstractAuthItemChild extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractAuthItemChild the static model class
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
        return 'auth_item_child';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('parent, child', 'required'),
            array('parent, child', 'length', 'max'=>64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('parent, child', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'child0' => array(self::BELONGS_TO, 'AuthItem', 'child'),
            'parent0' => array(self::BELONGS_TO, 'AuthItem', 'parent'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'parent' => 'Parent',
            'child' => 'Child',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('parent',$this->parent,true);
        $criteria->compare('child',$this->child,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
