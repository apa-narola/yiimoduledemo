<?php

class UsersController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'roles' => array('User.Users.View'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('User.Users.Create'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('User.Users.Update'),
            ),
            array('allow',
                'actions' => array('delete'),
                'roles' => array('User.Users.Delete'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $model = $this->loadModel();
        $model->resetScope();
        $groups = Yii::app()->authManager->getGroups();
        
        $users = new CActiveDataProvider($model, array(
            'criteria' => array(
                'with' => array(
                    'agency' => array(
                        'together' => false,
                    ),
                ),
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort'=>array(
                'attributes'=>array(
                    'agency'=>array(
                        'asc'=>'agences.company',
                        'desc'=>'agences.company DESC',
                    ),
                    '*',
                ),
            ),
        ));
        
        $this->render('index', array(
            'users' => $users,
            'model' => $model,
            'groups' => $groups,
        ));
    }
    
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $groups = Yii::app()->authManager->getGroups();
        $this->render('view', array(
            'model' => $model,
            'groups' => $groups,
        ));
    }
    
    public function actionCreate()
    {
        $model = $this->loadModel();
        $model->scenario = 'create';
        $groups = Yii::app()->authManager->getGroups();
        
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            $model->roles = Yii::app()->request->getPost('role', array());
            
            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->primaryKey));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'groups' => $groups,
        ));
    }
    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $groups = Yii::app()->authManager->getGroups();
        $authManager = Yii::app()->getAuthManager();
        $model->unsetAttributes(array('password'));
                
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            
            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            $model->roles = Yii::app()->request->getPost('role', array());
            
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->primaryKey));
            }
        }
        
        $this->render('update', array(
            'model' => $model,
            'groups' => $groups,
        ));
    }
    
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();
        
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('index'));
        }
        
        return true;
    }
    
    /**
     * Load model
     * @param integer $id
     * @return User
     * @throws CHttpException
     */
    protected function loadModel($id=null)
    {
        if (null === $id) {
            return new User;
        } 
        
        $model = User::model()->findByPk($id);
        
        if ($model instanceof CModel) {
            return $model;
        }
        
        throw new CHttpException(404, 'User not found');
    }
}
