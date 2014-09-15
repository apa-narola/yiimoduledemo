<?php

class DomainController extends Controller
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
                'roles' => array('Backoffice.Domain.View'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('Backoffice.Domain.Create'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('Backoffice.Domain.Update'),
            ),
            array('allow',
                'actions' => array('delete'),
                'roles' => array('Backoffice.Domain.Delete'),
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
        
        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array(
                'with' => array(
                    'account',
                    'langue',
                    'applicationType',
                ),
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort'=>array(
                'defaultOrder' => 'domain.name ASC',
                'attributes'=>array(
                    'account_name'=>array(
                        'asc'=>'account.name',
                        'desc'=>'account.name DESC',
                    ),
                    'application_type'=>array(
                        'asc'=>'application_type.name',
                        'desc'=>'application_type.name DESC',
                    ),
                    
                    'language_name'=>array(
                        'asc'=>'langue.name',
                        'desc'=>'langue.name DESC',
                    ),
                    '*',
                ),
            ),
        ));
        
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }
    
    public function actionCreate($sid=null)
    {
        $model = $this->loadModel();
        $model->setAttribute('id_societe', $sid);
        
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            
            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        
        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            
            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        
        $this->render('update', array(
            'model' => $model,
        ));
    }
    
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        
        $this->render('view', array(
            'model' => $model,
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
     * Load Banque model
     * @param integer $id
     * @return Banque
     * @throws CHttpException
     */
    protected function loadModel($id=null)
    {
        if (null === $id) {
            $model =  new Domain;
        } else {
            $model = Domain::model()->findByPk($id);
        }
        
        if ($model instanceof CModel) {
            $model->titleField = 'name';
            return $model;
        }
        
        throw new CHttpException(404, 'Item not found');
    }
}
