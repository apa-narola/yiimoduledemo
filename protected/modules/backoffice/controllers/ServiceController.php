<?php

class ServiceController extends Controller
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
                'actions' => array('index'),
                'roles' => array('Backoffice.Service.View'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('Backoffice.Service.Create'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('Backoffice.Service.Update'),
            ),
            array('allow',
                'actions' => array('delete'),
                'roles' => array('Backoffice.Service.Delete'),
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
            'criteria' => array(),
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort'=>array(
                'defaultOrder' => 'services.title',
                'attributes'=>array(
                    '*',
                ),
            ),
        ));
        
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }
    
    public function actionCreate()
    {
        $model = $this->loadModel();
        
        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            
            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            YiiDebug::dump($model->validate());
            
            YiiDebug::dump($model->errors);
            
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
     * Load Services model
     * @param integer $id
     * @return Services
     * @throws CHttpException
     */
    protected function loadModel($id=null)
    {
        if (null === $id) {
            $model =  new Services;
        } else {
            $model = Services::model()->findByPk($id);
        }
        
        if ($model instanceof CModel) {
            $model->titleField = 'name';
            return $model;
        }
        
        throw new CHttpException(404, 'Item not found');
    }
}
