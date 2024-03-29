<?php
/**
 * This is the model class for table "auth_assignment".
 *
 * The followings are the available columns in table 'auth_assignment':
 * @property string $itemname
 * @property string $userid
 * @property string $bizrule
 * @property string $data
 */
abstract class AbstractAuthAssignment extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractAuthAssignment the static model class
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
        return 'auth_assignment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('itemname, userid', 'required'),
            array('itemname', 'length', 'max'=>64),
            array('userid', 'length', 'max'=>11),
            array('bizrule, data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('itemname, userid, bizrule, data', 'safe', 'on'=>'search'),
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
            'itemname' => 'Itemname',
            'userid' => 'Userid',
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

        $criteria->compare('itemname',$this->itemname,true);
        $criteria->compare('userid',$this->userid,true);
        $criteria->compare('bizrule',$this->bizrule,true);
        $criteria->compare('data',$this->data,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
