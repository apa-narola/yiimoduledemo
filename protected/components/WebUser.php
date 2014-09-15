<?php

class WebUser extends CWebUser
{
    
    public $model;
    
    protected function beforeLogin($id, $states, $fromCookie)
    {
        return parent::beforeLogin($id, $states, $fromCookie);
    }
    
    public function login($identity,$duration=0)
    {
        if ($identity->model instanceof CModel) {
            $this->model = $identity->model;
        }
        
        return parent::login($identity,$duration=0);
    }

    protected function afterLogin($fromCookie)
    {
        if (null !== $this->model) {
            foreach ($this->model->attributes as $key => $value) {
                $this->setState($key, $value);
            }
        }
        
        return parent::afterLogin($fromCookie);
    }
    
    public function getId()
    {
        if ($this->hasState('id')) {
            return $this->getState('id');
        }
        
        return parent::getId();
    }

    protected function beforeLogout()
    {
        return parent::beforeLogout();
    }

    protected function afterLogout()
    {
        return parent::afterLogout();
    }

}
