<?php

class PasswordForm extends CFormModel
{
    public $email;
    public $code;

    public function rules()
    {
        return array(
            array('email', 'required', 'on' => 'request'),
            array('email', 'email', 'on' => 'request'),
            array('email', 'validateEmail', 'on' => 'request'),
            
            array('code', 'required', 'on' => 'reset'),
            array('code', 'validateCode', 'on' => 'reset'),
        );
    }
    
    public function validateEmail()
    {
        $user = Yii::app()->db->createCommand()
                    ->select('id, name')
                    ->from('user')
                    ->where('email=:email', array(
                        ':email' => $this->email,
                    ))->queryRow();
        
        if (!$user) {
            return $this->addError('email', 'Email not found');
        }
        
        $this->code = sprintf('%x', crc32($this->email.time()));
        
        Yii::app()->db->createCommand()
                ->update('user', array(
                    'recovery_code' => $this->code,
                ), 'id=:userId', array(
                    ':userId' => $user['id'],
                ));
        
        Yii::app()->emailManager->createMail('lost_password', array(
            'resetLink'=>Yii::app()->createAbsoluteUrl('/backoffice/user/auth/lostPassword', array(
                'code' => $this->code,
            )),
            'name' => $user['name'],
            'code' => $this->code,
        ))->send($this->email, $user['name']);
    }
    
    public function validateCode($attribute, $params)
    {
        $user = Yii::app()->db->createCommand()
                    ->select('id, name, email')
                    ->from('user')
                    ->where('recovery_code=:recovery_code', array(
                        ':recovery_code' => $this->code,
                    ))->queryRow();
        
        if (!$user) {
            return $this->addError('code', 'Recovery code is not valid');
        }
        
        $this->email = $user['email'];
        
        $password = sprintf('%x', crc32($this->email . time()));
        
        Yii::app()->db->createCommand()
                ->update('user', array(
                    'password' => md5($password),
                   // 'code' => new CDbException('NULL'),
                ), 'id=:userId', array(
                    ':userId' => $user['id'],
                ));
        
        Yii::app()->emailManager->createMail('reset_password', array(
            'loginLink'=>Yii::app()->createAbsoluteUrl(Yii::app()->user->loginUrl),
            'name' => $user['name'],
            'password' => $password,
        ))->send($user['email'], $user['name']);
    }

}
