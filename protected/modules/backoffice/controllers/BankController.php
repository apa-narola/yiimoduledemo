<?php

class BankController extends Controller
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
                'roles' => array('Backoffice.Bank.View'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('Backoffice.Bank.Create'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('Backoffice.Bank.Update'),
            ),
            array('allow',
                'actions' => array('delete'),
                'roles' => array('Backoffice.Bank.Delete'),
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
                    'societe' => array(),
                ),
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort'=>array(
                'defaultOrder' => 'societe.name',
                'attributes'=>array(
                    'societe_name'=>array(
                        'asc'=>'societe.name',
                        'desc'=>'societe.name DESC',
                    ),
                    '*',
                ),
            ),
        ));
        
        if (null !== ($formData = Yii::app()->request->getParam(get_class($model)))) {
            Yii::app()->session->offsetSet($this->id . '__filter', $formData);
            $this->redirect('index');
        }
        
        $model->setAttributes(Yii::app()->session->offsetGet($this->id . '__filter', array()));
        
        $criteria = $dataProvider->getCriteria();
        foreach ($model->attributes as $attribute=>$value) {
            if (empty($value)) {
                continue;
            }
            $criteria->compare($attribute, $value);
        }
        
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
            'societe' => $model->societe,
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
            $model =  new Banque;
        } else {
            $model = Banque::model()->findByPk($id);
        }
        
        if ($model instanceof CModel) {
            $model->titleField = 'beneficiaire';
            return $model;
        }
        
        throw new CHttpException(404, 'Item not found');
    }
}
