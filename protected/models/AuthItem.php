<?php
/**
 * AuthItem model class file.
 */

/**
 * AuthItem model class.
 */
class AuthItem extends AbstractAuthItem
{

    /**
     * {@inheritdoc}
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * {@inheritdoc}
     */
    public function defaultScope()
    {
        return array(
            'alias'=>'auth_item',
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
    
}
