<?php

class AuthController extends Controller
{
    
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', 
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('login', 'lostPassword'),
                'users' => array('?'),
            ),
            array(
                'allow',
                'actions' => array('logout'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }
    
    public function actionLogin()
    {
		$model = Yii::createComponent('user.models.forms.LoginForm');
        
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            if ($model->validate()) {
                $model->login();
                
                if (Yii::app()->user->returnUrl !== Yii::app()->user->loginUrl) {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
                $this->redirect(Yii::app()->homeUrl);    
            }
        }
        
        $this->render('login', array(
            'model' => $model,
        ));
    }
    
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    
    public function actionLostPassword($code=null)
    {
        $scenario = ($code ? 'reset' : 'request');
        $model = Yii::createComponent('user.models.forms.PasswordForm', $scenario);
        
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            if ($model->validate()) {
                return $this->render('lost_password_'.$scenario.'_sent', array(
                    'model' => $model,
                    'code' => $code,
                ));
            }
        } else if ($code) {
            $model->code = $code;
        }
        
        $this->render('lost_password_' . $scenario, array(
            'model' => $model,
            'code' => $code,
        ));
    }
    
}
