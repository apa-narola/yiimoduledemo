<?php
/**
 * User model class file.
 */

/**
 * User model class.
 */
class User extends AbstractUser
{
    public $status = 1;
    public $roles;
    
    public function getStatusListData()
    {
        return array('Inactive', 'Active');
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
            'alias'=>'user',
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
        return array(
            array('status, username, email', 'required'),
            array('password', 'required', 'on' => 'create'),
            array('email', 'email'),
            array('email, username', 'unique'),
            
            
            array('status, group_id, commission, country, app_type, account, fee_type, profile_status, parent_id, IdAgentGeneral', 'numerical', 'integerOnly'=>true),
            array('fee_amount', 'numerical'),
            array('username, password, telephone, fax', 'length', 'max'=>50),
            array('email, name, prenom, credit, user_parent, agence, profile_user, original_password', 'length', 'max'=>100),
            array('ref, code_postal', 'length', 'max'=>20),
            array('company, adresse, phone, mobile, agenceid, licencenum, acciona_account, loginViatelecom, passwordViatelecom, IdServiceViatelecom, IdAgent, IdGroupe, contract', 'length', 'max'=>255),
            array('city', 'length', 'max'=>200),
            array('amount', 'length', 'max'=>1000),
            array('devise', 'length', 'max'=>5),
            array('agency_id', 'length', 'max'=>10),
            array('recovery_code', 'length', 'max'=>8),
            array('zone, last_login, creation_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, status, username, password, email, group_id, name, prenom, ref, company, commission, adresse, telephone, fax, code_postal, credit, city, country, phone, mobile, agenceid, licencenum, zone, app_type, acciona_account, account, amount, devise, fee_type, fee_amount, id_agency, profile_status, last_login, loginViatelecom, passwordViatelecom, IdServiceViatelecom, IdAgent, IdGroupe, contract, user_parent, agence, profile_user, creation_date, original_password, parent_id, IdAgentGeneral, new_id_agency, recovery_code', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array customized relational rules.
     */
    public function relations()
    {
        return array_merge(parent::relations(), array(
            'groups' => array(self::HAS_MANY, 'AuthAssignment', 'userid'),
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
            'id_agency' => 'Agency',
            'zone' => 'Commentary',
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
        if (empty($this->password)) {
            $this->unsetAttributes(array('password'));
        }
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
        if ($this->isNewRecord) {
            $this->password = md5($this->password);
        }
 
        return parent::beforeSave();
    }

    /**
     * {@inheritdoc}
     */
    protected function afterSave()
    {
        if ($this->getIsNewRecord()) {
            $suivi = new Suiviclients;
            $suivi->commentaire = 'Compte créé le ' . date('d/m/Y H:m');
            $suivi->date = date('Y-m-d H:i:s');
            $suivi->agent = $this->primaryKey;
            $suivi->BookingNumber = $this->primaryKey;
            $suivi->save();
        }
        
        if (null !== $this->roles) {
            $authManager = Yii::app()->getAuthManager();
            $authManager->revokeAll($this->primaryKey);
            foreach ($this->roles as $role) {
                $authManager->assign($role, $this->primaryKey);
            }
        }
        
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
