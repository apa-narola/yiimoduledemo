<?php
/**
 * Domain model class file.
 */

/**
 * Domain model class.
 */
class Domain extends AbstractDomain
{
    
    private static $themes;

    public $down = 0;

    public function getEscalesLabel()
    {
        $labels = array('No', 'Yes', 'Yes, If no direct flights');
        return $labels[$this->escales];
    }
    
    public static function getThemesListData()
    {
        if (null === self::$themes) {
            $themes = array_diff(array_map('basename', glob(Yii::app()->themeManager->basePath . '/*', GLOB_ONLYDIR)), array(
                //'backoffice',
            ));
            self::$themes = array_combine($themes, array_map('ucfirst', $themes));
        }
        
        return self::$themes;
    }

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
            'alias'=>'domain',
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
            array('email', 'email'),
            array('account_id', 'default', 'setOnEmpty' => true, 'value' => null),
            array('application_type_id', 'default', 'setOnEmpty' => true, 'value' => null),
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
            'down' => 'Activation',
            'fashion' => 'Mode',
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
