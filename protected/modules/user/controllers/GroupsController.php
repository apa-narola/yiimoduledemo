<?php

class GroupsController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete, assignUser, revokeAccess',
            'ajaxOnly + findUser, assignUser, revokeAccess',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index'),
                'roles' => array('User.Groups.View'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('User.Groups.Create'),
            ),
            array('allow',
                'actions' => array('update', 'findUser', 'assignUser', 'revokeAccess'),
                'roles' => array('User.Groups.Update'),
            ),
            array('allow',
                'actions' => array('delete'),
                'roles' => array('User.Groups.Delete'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $groups = new CArrayDataProvider(Yii::app()->authManager->getGroups(), array(
            'keyField' => 'id',
            'sort' => array(
                'attributes' => array(
                    'name ASC',
                ),
            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
        
        $model = Yii::createComponent('user.models.forms.GroupForm');
        
        $viewData = array(
            'groups' => $groups,
            'model' => $model,
        );

        $this->render('index', $viewData);
    }
    
    public function actionFindUser($group, $term)
    {
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'select' => array(
                    'id',
                    'email',
                ),
            ),
            'pagination' => array(
                'pageSize' => 500,
            ),
        ));
        
        $criteria = $dataProvider->getCriteria();
        $criteria->compare('email', $term, true);
        $result = CHtml::listData($dataProvider->getData(), 'id', 'email');
        
        $members = Yii::app()->db->createCommand()
                    ->select('userid')
                    ->from(AuthAssignment::model()->tableName())
                    ->where('itemname=:group', array(
                        ':group' => $group,
                    ))->queryColumn();
      
        echo CJSON::encode(array_diff_key($result, array_flip($members)));
        Yii::app()->end();
    }
    
    public function actionRevokeAccess()
    {
        $group = Yii::app()->request->getPost('group');
        $user = Yii::app()->request->getPost('user');
        $authManager = Yii::app()->authManager;
        
        if ($group && $user) {
            $authManager->revoke($group, $user);
        }
    }
    
    public function actionAssignUser()
    {
        $group = Yii::app()->request->getPost('group');
        $user = Yii::app()->request->getPost('user');
        $authManager = Yii::app()->authManager;
        
        if ($group && $user) {
            $authManager->assign($group, $user);
        }
    }

    public function actionCreate()
    {
        $model = Yii::createComponent('user.models.forms.GroupForm');

        if (null !== ($formData = Yii::app()->request->getPost('GroupForm'))) {
            $model->setAttributes($formData);

            if (Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            if (false !== $model->create()) {
                $this->redirect(array('index'));
            }
        }
    }

    public function actionUpdate($id)
    {
        $authManager = Yii::app()->authManager;
        
        if (null === ($group = $authManager->getAuthItem($id))) {
            throw new CHttpException(404, 'Group not found.');
        }

        $operations = new ArrayObject(array(
            'accessLevelTree' => array(),
            'role' => $group
        ));

        $assessLevelTree = $authManager->getAccessLevelTree();
        array_walk($assessLevelTree, array(__CLASS__, 'prepareTreeData'), $operations);
        
        if (Yii::app()->request->isPostRequest) {
            $group->data = array_keys(Yii::app()->request->getPost('role', array()));
            $this->refresh();
        }
        
        $members = new CActiveDataProvider('User', array(
            'criteria' => array(
                'with' => array(
                    'groups' => array(
                        'together' => true,
                    ),
                ),
                'condition' => 'auth_assignment.itemname=:itemname',
                'params' => array(
                    ':itemname' => $id,
                ),
            ),
            'pagination' => array(
                'pageSize' => 15,
            ),
        ));
        
        
        $viewData = array(
            'accessLevelTree'=>array(array(
                'text' => $group->name,
                'children' => $operations['accessLevelTree'],
            )),
            'model' => $group,
            'members' => $members,
            'isSystemGroup' => Yii::app()->authManager->getIsSystemRole($id),
        );

        if (Yii::app()->request->isAjaxRequest && 
            null !== ($partial = Yii::app()->request->getParam('ajax'))) {
            
            $this->renderPartial($partial, $viewData);
            Yii::app()->end();
        }
        
        $this->render('update', $viewData);
    }
    
    public function actionDelete($id)
    {
        Yii::app()->authManager->removeAuthItem($id);
    }

    public static function prepareTreeData($item, $key, &$data)
    {
        $authItem = $item['item'];
        $children = $item['children'];
        $role = $data['role'];
        if ($authItem instanceof CAuthItem) {
            $new = array(
                'id' => $authItem->name,
                'text' => Yii::app()->controller->renderPartial('_auth_item', array(
                    'authItem' => $authItem,
                    'role' => $role,
                ), true),
                'children' => array(),
            );
            if (null != $children) {
                array_walk(
                    $children, array(__CLASS__, __METHOD__), array(
                        'accessLevelTree' => &$new['children'],
                        'role' => $role
                    )
                );
            }
            array_push($data['accessLevelTree'], $new);
        }
    }

}
