<?php
/**
 * GenerateaclCommand class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * GenerateaclCommand generate ACL rules
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @package application.commands
 * @since 1.1.7
 */
class AclCommand extends CConsoleCommand
{

    private $_modules = array();
    
    private $_users = array();
    
    private $_roles;
    
    private $_assigments;

    public function getHelp()
    {
        return <<<EOD
USAGE
  yiic acl [--users]

DESCRIPTION
  This command generate ACL rules.

EOD;
    }

    public function actionIndex($users=null)
    {
        $authManager = Yii::app()->authManager;
        
        $this->_users = array_filter(explode(',', $users));
        
        $this->_modules = array_map('basename', glob(Yii::getPathOfAlias('application.modules') . '/*'));
        
        $this->_roles = Yii::app()->db->createCommand()
                ->select('*')
                ->from($authManager->itemTable)
                ->where('type=:type', array(':type'=>2))
                ->queryAll();
        
        $this->_assigments = Yii::app()->db->createCommand()
                ->select('*')
                ->from($authManager->assignmentTable)
                ->queryAll();
        
        
        $this->generateAccessLevelsTree();
        
        $systemRoles = $authManager->getSystemRoles();
        
        foreach($this->_roles as $role) {
            if(in_array($role['name'], $systemRoles))
                continue;
            
            Yii::app()->db->createCommand()->insert($authManager->itemTable, $role);
        }
        
        foreach($this->_assigments as $assigment) {
            if (!$authManager->getAuthAssignment($assigment['itemname'], $assigment['userid'])) {
                    $authManager->assign($assigment['itemname'], $assigment['userid']);
            }
        }
        
    }

    private function generateAccessLevelsTree()
    {
        $authManager = Yii::app()->authManager;
        $authManager->clearAll();

        $defaultRole = $authManager->createRole($authManager->getDefaultRoleName(), 'Regular user');

        foreach ($this->_modules as $module) {
            $id = $module;
            $class = ucfirst($module) . 'Module';
            
            Yii::import('application.modules.'.$id.'.'.$class);
            if (method_exists($class, 'createAccessRules')) {
                call_user_func_array(array($class, 'createAccessRules'), array($authManager, $defaultRole));
            }
        }

        $superadminRole= $authManager->createRole(
            $authManager->getSuperadminRoleName(),
            'Admins – can manage all data in the site',
            null,
            Yii::app()->db->createCommand()
                ->select('child')
                ->from('auth_item_child')
                ->queryColumn()
        );

        $superadminRole->addChild($authManager->getDefaultRoleName());
        if ($this->_users) foreach ($this->_users as $user) {
            $authManager->assign($authManager->getSuperadminRoleName(), $user);
        }
    }

}