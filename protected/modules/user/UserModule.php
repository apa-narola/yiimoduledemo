<?php

class UserModule extends CWebModule {

    public function init() {
        $this->setImport(array(
            'user.models.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            return parent::beforeControllerAction($controller, $action);
        }
        
        return false;
    }
    
    public static function createAccessRules($authManager, $defaultRole)
    {
        /* {{{ Create groups management rules */
        $authManager->createOperation('User.Groups.View', 'View');
        $authManager->createOperation('User.Groups.Update', 'Update');
        $authManager->createOperation('User.Groups.Create', 'Create');
        $authManager->createOperation('User.Groups.Delete', 'Delete');

        $task = $authManager->createTask('User.Groups', 'Groups Management');
        $task->addChild('User.Groups.View');
        $task->addChild('User.Groups.Update');
        $task->addChild('User.Groups.Create');
        $task->addChild('User.Groups.Delete');
        /* }}} */


        /* {{{ Create users management rules */
        $authManager->createOperation('User.Users.View', 'View');
        $authManager->createOperation('User.Users.Update', 'Update');
        $authManager->createOperation('User.Users.Create', 'Create');
        $authManager->createOperation('User.Users.Delete', 'Delete');

        $task = $authManager->createTask('User.Users', 'Users Management');
        $task->addChild('User.Users.View');
        $task->addChild('User.Users.Update');
        $task->addChild('User.Users.Create');
        $task->addChild('User.Users.Delete');
        /* }}} */

        $task = $authManager->createTask('User', 'User Module');
        $task->addChild('User.Groups');
        $task->addChild('User.Users');

        $defaultRole->addChild('User');
    }

}
