<?php

class GroupForm extends CFormModel
{

    public $name;
    public $description;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, description', 'required'),
            array('name', 'validateName'),
            array('name', 'length', 'max' => 100),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Name',
            'description' => 'Description',
        );
    }
    
    public function validateName()
    {
        if (null !== Yii::app()->authManager->getAuthItem($this->name)) {
            $this->addError('name', 'Group "' . $this->name . '" already exists');
        }
    }

    public function create()
    {
        if (false !== parent::validate()) {
            $this->name = trim($this->name);

            if (null === Yii::app()->authManager->getAuthItem($this->name)) {
                Yii::app()->authManager->createAccessLevel($this->name, $this->description);
                return true;
            } else {
                $this->addError('name', 'Group "' . $this->name . '" already exists');
                return false;
            }
        }

        return false;
    }
    
}
