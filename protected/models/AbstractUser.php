<?php
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $status
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $group_id
 * @property string $name
 * @property string $prenom
 * @property string $ref
 * @property string $company
 * @property string $commission
 * @property string $adresse
 * @property string $telephone
 * @property string $fax
 * @property string $code_postal
 * @property string $credit
 * @property string $city
 * @property string $country
 * @property string $phone
 * @property string $mobile
 * @property string $agenceid
 * @property string $licencenum
 * @property string $zone
 * @property integer $app_type
 * @property string $acciona_account
 * @property string $account
 * @property string $amount
 * @property string $devise
 * @property integer $fee_type
 * @property double $fee_amount
 * @property string $agency_id
 * @property integer $profile_status
 * @property string $last_login
 * @property string $loginViatelecom
 * @property string $passwordViatelecom
 * @property string $IdServiceViatelecom
 * @property string $IdAgent
 * @property string $IdGroupe
 * @property string $contract
 * @property string $user_parent
 * @property string $agence
 * @property string $profile_user
 * @property string $creation_date
 * @property string $original_password
 * @property string $parent_id
 * @property string $IdAgentGeneral
 * @property string $recovery_code
 *
 * The followings are the available model relations:
 * @property Agences[] $agences
 * @property AuthItem[] $authItems
 * @property Agences $agency
 */
abstract class AbstractUser extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractUser the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('status, username, password, email, ref, IdAgentGeneral', 'required'),
            array('app_type, fee_type, profile_status', 'numerical', 'integerOnly'=>true),
            array('fee_amount', 'numerical'),
            array('status', 'length', 'max'=>1),
            array('username, password, telephone, fax', 'length', 'max'=>50),
            array('email, name, prenom, credit, user_parent, agence, profile_user, original_password', 'length', 'max'=>100),
            array('group_id, country, account, agency_id, parent_id, IdAgentGeneral', 'length', 'max'=>11),
            array('ref, code_postal', 'length', 'max'=>20),
            array('company, adresse, phone, mobile, agenceid, licencenum, acciona_account, loginViatelecom, passwordViatelecom, IdServiceViatelecom, IdAgent, IdGroupe, contract', 'length', 'max'=>255),
            array('commission', 'length', 'max'=>2),
            array('city', 'length', 'max'=>200),
            array('devise', 'length', 'max'=>5),
            array('recovery_code', 'length', 'max'=>8),
            array('zone, amount, last_login, creation_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, status, username, password, email, group_id, name, prenom, ref, company, commission, adresse, telephone, fax, code_postal, credit, city, country, phone, mobile, agenceid, licencenum, zone, app_type, acciona_account, account, amount, devise, fee_type, fee_amount, agency_id, profile_status, last_login, loginViatelecom, passwordViatelecom, IdServiceViatelecom, IdAgent, IdGroupe, contract, user_parent, agence, profile_user, creation_date, original_password, parent_id, IdAgentGeneral, recovery_code', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'agences' => array(self::HAS_MANY, 'Agences', 'user_id'),
            'authItems' => array(self::MANY_MANY, 'AuthItem', 'auth_assignment(userid, itemname)'),
            'agency' => array(self::BELONGS_TO, 'Agences', 'agency_id'),
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
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'group_id' => 'Group',
            'name' => 'Name',
            'prenom' => 'Prenom',
            'ref' => 'Ref',
            'company' => 'Company',
            'commission' => 'Commission',
            'adresse' => 'Adresse',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'code_postal' => 'Code Postal',
            'credit' => 'Credit',
            'city' => 'City',
            'country' => 'Country',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'agenceid' => 'Agenceid',
            'licencenum' => 'Licencenum',
            'zone' => 'Zone',
            'app_type' => 'App Type',
            'acciona_account' => 'Acciona Account',
            'account' => 'Account',
            'amount' => 'Amount',
            'devise' => 'Devise',
            'fee_type' => 'Fee Type',
            'fee_amount' => 'Fee Amount',
            'agency_id' => 'Agency',
            'profile_status' => 'Profile Status',
            'last_login' => 'Last Login',
            'loginViatelecom' => 'Login Viatelecom',
            'passwordViatelecom' => 'Password Viatelecom',
            'IdServiceViatelecom' => 'Id Service Viatelecom',
            'IdAgent' => 'Id Agent',
            'IdGroupe' => 'Id Groupe',
            'contract' => 'Contract',
            'user_parent' => 'User Parent',
            'agence' => 'Agence',
            'profile_user' => 'Profile User',
            'creation_date' => 'Creation Date',
            'original_password' => 'Original Password',
            'parent_id' => 'Parent',
            'IdAgentGeneral' => 'Id Agent General',
            'recovery_code' => 'Recovery Code',
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
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('group_id',$this->group_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('prenom',$this->prenom,true);
        $criteria->compare('ref',$this->ref,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('commission',$this->commission,true);
        $criteria->compare('adresse',$this->adresse,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('code_postal',$this->code_postal,true);
        $criteria->compare('credit',$this->credit,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('country',$this->country,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('mobile',$this->mobile,true);
        $criteria->compare('agenceid',$this->agenceid,true);
        $criteria->compare('licencenum',$this->licencenum,true);
        $criteria->compare('zone',$this->zone,true);
        $criteria->compare('app_type',$this->app_type);
        $criteria->compare('acciona_account',$this->acciona_account,true);
        $criteria->compare('account',$this->account,true);
        $criteria->compare('amount',$this->amount,true);
        $criteria->compare('devise',$this->devise,true);
        $criteria->compare('fee_type',$this->fee_type);
        $criteria->compare('fee_amount',$this->fee_amount);
        $criteria->compare('agency_id',$this->agency_id,true);
        $criteria->compare('profile_status',$this->profile_status);
        $criteria->compare('last_login',$this->last_login,true);
        $criteria->compare('loginViatelecom',$this->loginViatelecom,true);
        $criteria->compare('passwordViatelecom',$this->passwordViatelecom,true);
        $criteria->compare('IdServiceViatelecom',$this->IdServiceViatelecom,true);
        $criteria->compare('IdAgent',$this->IdAgent,true);
        $criteria->compare('IdGroupe',$this->IdGroupe,true);
        $criteria->compare('contract',$this->contract,true);
        $criteria->compare('user_parent',$this->user_parent,true);
        $criteria->compare('agence',$this->agence,true);
        $criteria->compare('profile_user',$this->profile_user,true);
        $criteria->compare('creation_date',$this->creation_date,true);
        $criteria->compare('original_password',$this->original_password,true);
        $criteria->compare('parent_id',$this->parent_id,true);
        $criteria->compare('IdAgentGeneral',$this->IdAgentGeneral,true);
        $criteria->compare('recovery_code',$this->recovery_code,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
