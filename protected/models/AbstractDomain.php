<?php
/**
 * This is the model class for table "domain".
 *
 * The followings are the available columns in table 'domain':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $identifier
 * @property string $langue_id
 * @property string $tax
 * @property string $taux
 * @property integer $show_langs
 * @property string $env
 * @property string $gmaps_key
 * @property integer $jetlag
 * @property integer $issuetickets
 * @property integer $sendmailtickets
 * @property string $smsactivitation
 * @property string $smsreservation
 * @property string $openingdays
 * @property string $openinghours
 * @property string $closinghours
 * @property integer $fashion
 * @property string $adminip
 * @property string $wsuser
 * @property string $wspass
 * @property string $theme
 * @property integer $display_phone
 * @property string $phonecallcenter
 * @property string $sav_portable
 * @property string $email
 * @property string $logo
 * @property integer $pos_h
 * @property integer $down
 * @property integer $decalage
 * @property string $currency
 * @property string $symbole
 * @property integer $show_journey
 * @property string $application_type_id
 * @property string $google_analytics
 * @property integer $escales
 * @property integer $session_resa
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $service
 * @property string $account_id
 *
 * The followings are the available model relations:
 * @property BusinessUnit[] $businessUnits
 * @property ApplicationType $applicationType
 * @property Account $account
 * @property Langue $langue
 */
abstract class AbstractDomain extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return AbstractDomain the static model class
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
        return 'domain';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name, identifier, smsactivitation, openingdays, openinghours, closinghours, theme, phonecallcenter, email, logo', 'required'),
            array('show_langs, jetlag, issuetickets, sendmailtickets, fashion, display_phone, pos_h, down, decalage, show_journey, escales, session_resa', 'numerical', 'integerOnly'=>true),
            array('name, identifier', 'length', 'max'=>32),
            array('title, smsactivitation, openingdays, wsuser, wspass, service', 'length', 'max'=>50),
            array('langue_id, application_type_id, account_id', 'length', 'max'=>11),
            array('tax', 'length', 'max'=>5),
            array('taux, adminip, theme', 'length', 'max'=>20),
            array('env, gmaps_key, smsreservation, email, logo, meta_title, meta_keywords', 'length', 'max'=>255),
            array('openinghours, closinghours', 'length', 'max'=>6),
            array('phonecallcenter, sav_portable', 'length', 'max'=>15),
            array('currency', 'length', 'max'=>25),
            array('symbole', 'length', 'max'=>12),
            array('google_analytics', 'length', 'max'=>200),
            array('meta_description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, title, identifier, langue_id, tax, taux, show_langs, env, gmaps_key, jetlag, issuetickets, sendmailtickets, smsactivitation, smsreservation, openingdays, openinghours, closinghours, fashion, adminip, wsuser, wspass, theme, display_phone, phonecallcenter, sav_portable, email, logo, pos_h, down, decalage, currency, symbole, show_journey, application_type_id, google_analytics, escales, session_resa, meta_title, meta_description, meta_keywords, service, account_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'businessUnits' => array(self::MANY_MANY, 'BusinessUnit', 'business_unit_domain(domain_id, business_unit_id)'),
            'applicationType' => array(self::BELONGS_TO, 'ApplicationType', 'application_type_id'),
            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
            'langue' => array(self::BELONGS_TO, 'Langue', 'langue_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'identifier' => 'Identifier',
            'langue_id' => 'Langue',
            'tax' => 'Tax',
            'taux' => 'Taux',
            'show_langs' => 'Show Langs',
            'env' => 'Env',
            'gmaps_key' => 'Gmaps Key',
            'jetlag' => 'Jetlag',
            'issuetickets' => 'Issuetickets',
            'sendmailtickets' => 'Sendmailtickets',
            'smsactivitation' => 'Smsactivitation',
            'smsreservation' => 'Smsreservation',
            'openingdays' => 'Openingdays',
            'openinghours' => 'Openinghours',
            'closinghours' => 'Closinghours',
            'fashion' => 'Fashion',
            'adminip' => 'Adminip',
            'wsuser' => 'Wsuser',
            'wspass' => 'Wspass',
            'theme' => 'Theme',
            'display_phone' => 'Display Phone',
            'phonecallcenter' => 'Phonecallcenter',
            'sav_portable' => 'Sav Portable',
            'email' => 'Email',
            'logo' => 'Logo',
            'pos_h' => 'Pos H',
            'down' => 'Down',
            'decalage' => 'Decalage',
            'currency' => 'Currency',
            'symbole' => 'Symbole',
            'show_journey' => 'Show Journey',
            'application_type_id' => 'Application Type',
            'google_analytics' => 'Google Analytics',
            'escales' => 'Escales',
            'session_resa' => 'Session Resa',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'service' => 'Service',
            'account_id' => 'Account',
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('identifier',$this->identifier,true);
        $criteria->compare('langue_id',$this->langue_id,true);
        $criteria->compare('tax',$this->tax,true);
        $criteria->compare('taux',$this->taux,true);
        $criteria->compare('show_langs',$this->show_langs);
        $criteria->compare('env',$this->env,true);
        $criteria->compare('gmaps_key',$this->gmaps_key,true);
        $criteria->compare('jetlag',$this->jetlag);
        $criteria->compare('issuetickets',$this->issuetickets);
        $criteria->compare('sendmailtickets',$this->sendmailtickets);
        $criteria->compare('smsactivitation',$this->smsactivitation,true);
        $criteria->compare('smsreservation',$this->smsreservation,true);
        $criteria->compare('openingdays',$this->openingdays,true);
        $criteria->compare('openinghours',$this->openinghours,true);
        $criteria->compare('closinghours',$this->closinghours,true);
        $criteria->compare('fashion',$this->fashion);
        $criteria->compare('adminip',$this->adminip,true);
        $criteria->compare('wsuser',$this->wsuser,true);
        $criteria->compare('wspass',$this->wspass,true);
        $criteria->compare('theme',$this->theme,true);
        $criteria->compare('display_phone',$this->display_phone);
        $criteria->compare('phonecallcenter',$this->phonecallcenter,true);
        $criteria->compare('sav_portable',$this->sav_portable,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('pos_h',$this->pos_h);
        $criteria->compare('down',$this->down);
        $criteria->compare('decalage',$this->decalage);
        $criteria->compare('currency',$this->currency,true);
        $criteria->compare('symbole',$this->symbole,true);
        $criteria->compare('show_journey',$this->show_journey);
        $criteria->compare('application_type_id',$this->application_type_id,true);
        $criteria->compare('google_analytics',$this->google_analytics,true);
        $criteria->compare('escales',$this->escales);
        $criteria->compare('session_resa',$this->session_resa);
        $criteria->compare('meta_title',$this->meta_title,true);
        $criteria->compare('meta_description',$this->meta_description,true);
        $criteria->compare('meta_keywords',$this->meta_keywords,true);
        $criteria->compare('service',$this->service,true);
        $criteria->compare('account_id',$this->account_id,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
}
