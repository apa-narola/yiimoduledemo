<?php
/**
 * This is the model class for table "agences".
 *
 * The followings are the available columns in table 'agences':
 * @property string $id
 * @property string $status
 * @property string $account_id
 * @property string $ref
 * @property string $company
 * @property string $adresse
 * @property string $telephone
 * @property string $fax
 * @property string $code_postal
 * @property string $credit
 * @property string $devise
 * @property string $city
 * @property string $country
 * @property string $phone
 * @property string $acciona_account
 * @property string $profile_status
 * @property string $user_id
 * @property string $idAgentGeneral
 * @property string $contract
 * @property string $agent_general
 * @property string $active
 * @property string $prepaid_account
 * @property string $societe_id
 * @property string $intermediate_id
 *
 * The followings are the available model relations:
 * @property Intermediate $intermediate
 * @property Account $account
 * @property Societe $societe
 * @property User $user
 * @property AgencesFee[] $agencesFees
 * @property ApplicationType[] $applicationTypes
 * @property User[] $users
 */
abstract class AbstractAgences extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractAgences the static model class
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
        return 'agences';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('status, agent_general, active, prepaid_account', 'length', 'max'=>1),
            array('account_id, credit, acciona_account, profile_status, user_id, idAgentGeneral, societe_id, intermediate_id', 'length', 'max'=>11),
            array('ref, company, adresse, contract', 'length', 'max'=>255),
            array('telephone, fax, code_postal, phone', 'length', 'max'=>30),
            array('devise', 'length', 'max'=>50),
            array('city, country', 'length', 'max'=>100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, status, account_id, ref, company, adresse, telephone, fax, code_postal, credit, devise, city, country, phone, acciona_account, profile_status, user_id, idAgentGeneral, contract, agent_general, active, prepaid_account, societe_id, intermediate_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'intermediate' => array(self::BELONGS_TO, 'Intermediate', 'intermediate_id'),
            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
            'societe' => array(self::BELONGS_TO, 'Societe', 'societe_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'agencesFees' => array(self::HAS_MANY, 'AgencesFee', 'agence_id'),
            'applicationTypes' => array(self::MANY_MANY, 'ApplicationType', 'application_type_agences(agences_id, application_type_id)'),
            'users' => array(self::HAS_MANY, 'User', 'agency_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'status' => 'Status',
            'account_id' => 'Account',
            'ref' => 'Ref',
            'company' => 'Company',
            'adresse' => 'Adresse',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'code_postal' => 'Code Postal',
            'credit' => 'Credit',
            'devise' => 'Devise',
            'city' => 'City',
            'country' => 'Country',
            'phone' => 'Phone',
            'acciona_account' => 'Acciona Account',
            'profile_status' => 'Profile Status',
            'user_id' => 'User',
            'idAgentGeneral' => 'Id Agent General',
            'contract' => 'Contract',
            'agent_general' => 'Agent General',
            'active' => 'Active',
            'prepaid_account' => 'Prepaid Account',
            'societe_id' => 'Societe',
            'intermediate_id' => 'Intermediate',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('account_id',$this->account_id,true);
        $criteria->compare('ref',$this->ref,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('adresse',$this->adresse,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('code_postal',$this->code_postal,true);
        $criteria->compare('credit',$this->credit,true);
        $criteria->compare('devise',$this->devise,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('country',$this->country,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('acciona_account',$this->acciona_account,true);
        $criteria->compare('profile_status',$this->profile_status,true);
        $criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('idAgentGeneral',$this->idAgentGeneral,true);
        $criteria->compare('contract',$this->contract,true);
        $criteria->compare('agent_general',$this->agent_general,true);
        $criteria->compare('active',$this->active,true);
        $criteria->compare('prepaid_account',$this->prepaid_account,true);
        $criteria->compare('societe_id',$this->societe_id,true);
        $criteria->compare('intermediate_id',$this->intermediate_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
