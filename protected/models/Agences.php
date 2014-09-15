<?php

/**
 * Agences model class file.
 */

/**
 * Agences model class.
 */
class Agences extends AbstractAgences
{
    
    public $profile_status = 0;

    /**
     * {@inheritdoc}
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * {@inheritdoc}
     */
    public function defaultScope()
    {
        return array(
            'alias' => 'agences',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function scopes()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('intermediate_id, account_id, societe_id', 'default', 'setOnEmpty' => true, 'value' => null),
        ));
    }

    /**
     * @return array customized relational rules.
     */
    public function relations()
    {
        return array_merge(parent::relations(), array(
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function search()
    {
        return parent::search();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'devise' => 'Currency',
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function afterConstruct()
    {
        parent::afterConstruct();
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeFind()
    {
        parent::beforeFind();
    }

    /**
     * {@inheritdoc}
     */
    protected function afterFind()
    {
        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeValidate()
    {
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    protected function afterValidate()
    {
        return parent::afterValidate();
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeSave()
    {
        return parent::beforeSave();
    }

    /**
     * {@inheritdoc}
     */
    protected function afterSave()
    {
        parent::afterSave();
    }

    /**
     * {@inheritdoc}
     */
    protected function beforeDelete()
    {
        return parent::beforeDelete();
    }

    /**
     * {@inheritdoc}
     */
    protected function afterDelete()
    {
        parent::afterDelete();
    }
    
    
    public function entityName()
    {
        return 'agency';
    }

}
