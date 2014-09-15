<?php

class UserIdentity extends CUserIdentity
{
    public $model;

    public function authenticate()
    {
        $user = User::model()->find('username=:username OR email=:email', array(
            ':username' => $this->username,
            ':email' => $this->username,
        ));
        
        if (null === $user) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password !== $this->password && $user->password !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->model = $user;
            $this->username = $user->name;
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

}
