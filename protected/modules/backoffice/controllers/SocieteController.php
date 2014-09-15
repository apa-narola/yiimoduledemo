<?php

class SocieteController extends Controller
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
                'roles' => array('Backoffice.Societe.View'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('Backoffice.Societe.Create'),
            ),
            array('allow',
                'actions' => array('update'),
                'roles' => array('Backoffice.Societe.Update'),
            ),
            array('allow',
                'actions' => array('delete'),
                'roles' => array('Backoffice.Societe.Delete'),
            ),
            array('allow',
                'actions' => array('bank'),
                'roles' => array('Backoffice.Bank.Create'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function getBankDataProvider($id)
    {
        $model = $this->loadModel($id);
        
        if (Yii::app()->session->offsetExists($this->id . '_bankList') && $model->isNewRecord) {
            $rawData = array();
            foreach (Yii::app()->session->offsetGet($this->id . '_bankList') as $attributes) {
                $model = new Banque;
                $model->setAttributes($attributes);
                $rawData[] = $model;
            }
            return new CArrayDataProvider($rawData);
        }

        Yii::app()->session->offsetUnset($this->id . '_bankList');

        return new CActiveDataProvider('Banque', array(
            'criteria' => array(
                'condition' => 'societe_id = :id',
                'params' => array(
                    ':id' => $id,
                ),
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'beneficiaire',
                'attributes' => array(
                    '*',
                ),
            ),
        ));
    }

    public function actionBank()
    {
        $model = new Banque;
        $callback = Yii::app()->request->getParam('callback', CHtml::normalizeUrl(array('index')));

        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);
            $societe = $this->loadModel($model->societe_id ? $model->societe_id : null);

            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if (!$societe->getIsNewRecord() && $model->save()) {
                $this->redirect($callback);
            } else if ($societe->getIsNewRecord()) {

                $bankList = Yii::app()->session->offsetGet($this->id . '_bankList', array());
                $bankList[] = $model->attributes;
                Yii::app()->session->offsetSet($this->id . '_bankList', $bankList);
                Yii::app()->session->offsetSet($this->id . '_' . get_class($societe), Yii::app()->request->getPost(get_class($societe), array()));

                $this->redirect($callback);
            }
        }
    }

    public function actionIndex()
    {
        $model = $this->loadModel();
        $model->resetScope();

        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array(
                'with' => array(
                    'country',
                ),
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => 'societe.name',
                'attributes' => array(
                    'country' => array(
                        'asc' => 'countrylist.name',
                        'desc' => 'countrylist.name DESC',
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

    public function actionCreate()
    {
        if (Yii::app()->request->getUrlReferrer() 
                !== Yii::app()->createAbsoluteUrl(Yii::app()->request->getUrl())) {
            Yii::app()->session->offsetUnset($this->id . '_bankList');
            Yii::app()->session->offsetUnset($this->id . '_Societes');
        }
        
        $model = $this->loadModel();
        $banqueModel = new BanqueForm;

        if (null !== ($formData = Yii::app()->request->getPost(get_class($model)))) {
            $model->setAttributes($formData);

            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if ($model->save()) {
                if (Yii::app()->session->offsetExists($this->id . '_bankList')) {
                    foreach (Yii::app()->session->offsetGet($this->id . '_bankList') as $attributes) {
                        $attributes['societe_id'] = $model->primaryKey;
                        $banqueModel = new Banque;
                        $banqueModel->setAttributes(array_merge($attributes, array(
                            'societe_id' => $model->primaryKey,
                        )));

                        $banqueModel->save(false);
                    }
                    Yii::app()->session->offsetUnset($this->id . '_bankList');
                }

                $this->redirect(array('view', 'id' => $model->primaryKey));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'banqueModel' => $banqueModel,
            'bankList' => $this->getBankDataProvider($model->primaryKey),
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
                $this->redirect(array('view', 'id' => $model->primaryKey));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'bankList' => $this->getBankDataProvider($model->primaryKey),
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
            'bankList' => $this->getBankDataProvider($model->primaryKey),
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
     * Load Societes model
     * @param integer $id
     * @return Societes
     * @throws CHttpException
     */
    protected function loadModel($id = null)
    {
        if (null === $id) {

            $model = new Societe;
            $ssid = $this->id . '_' . get_class($model);
            
            if (Yii::app()->session->offsetExists($ssid)) {
                $model->setAttributes(Yii::app()->session->offsetGet($ssid));
                Yii::app()->session->offsetUnset($ssid);
            }
        } else {
            $model = Societe::model()->findByPk($id);
        }

        if ($model instanceof CModel) {
            $model->titleField = 'name';
            return $model;
        }

        throw new CHttpException(404, 'Account not found');
    }
}
