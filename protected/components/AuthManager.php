<?php

/**
 * DbAuthManager class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */

/**
 * DbAuthManager class
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */
class AuthManager extends CDbAuthManager
{

    public $itemTable = 'auth_item';
    public $itemChildTable = 'auth_item_child';
    public $assignmentTable = 'auth_assignment';
    public static $_defaultRoleName = 'RegularUser';
    public static $_superadminRoleName = 'Administrator';
    
    private $_groups;
    
    public function getIsSystemRole($role)
    {
        return in_array($role, $this->getSystemRoles());
    }

    public function getSystemRoles()
    {
        return array(
            $this->getDefaultRoleName(),
            $this->getSuperadminRoleName()
        );
    }

    public function getDefaultRoleName()
    {
        return self::$_defaultRoleName;
    }

    public function getSuperadminRoleName()
    {
        return self::$_superadminRoleName;
    }

    public function checkAccess($itemName, $userId, $params = array())
    {
        return in_array($itemName, $this->getAllowedOperations($userId));
    }

    public function getAllowedOperations($userId)
    {
        if (!isset(Yii::app()->user->allowedOperations) || empty(Yii::app()->user->allowedOperations)) {
            $operations = array();
            $roles = $this->getAuthAssignments($userId);
            foreach ($roles as $role) {
                $authItem = $this->getAuthItem($role->itemname);
                if ($authItem && is_array($authItem->data)) {
                    $operations = array_merge($operations, $authItem->data);
                }
            }
            Yii::app()->user->setState('allowedOperations', $operations);
        }
        return Yii::app()->user->getState('allowedOperations');
    }

    public function getGroups()
    {
        if (null === $this->_groups) {
            $this->_groups = array();
            $accessLevels = $this->getAccessLevels();
            foreach ($accessLevels as $level) {
                $this->_groups[] = array(
                    'id' => $level->name,
                    'name' => $level->name,
                    'description' => $level->description,
                    'usersCount' => count(Yii::app()->authManager->getAssignsByItem($level->name)),
                );
            }
        }
        return $this->_groups;
    }
    
    public function getAccessLevels($userId = null)
    {
        $accessLevels = array();
        $roles = Yii::app()->authManager->getRoles();

        foreach ($roles as $role) {
            $flag = true;
            if (null != $userId) {
                $flag = $this->isAssigned($role->name, $userId);
            }
            ($flag) && $accessLevels[] = $role;
        }
        return $accessLevels;
    }

    public function getAccessLevelTree($item = null)
    {
        $tree = array();
        (null == $item) && $item = self::$_defaultRoleName;
        $authItems = Yii::app()->authManager->getItemChildren($item);
        foreach ($authItems as $authItem) {
            $tree[] = array(
                'item' => $authItem,
                'children' => (($authItem->type == CAuthItem::TYPE_OPERATION) ? null : $this->getAccessLevelTree($authItem->name)
                ),
            );
        }
        return $tree;
    }

    public function revokeAll($userId)
    {
        $roles = $this->getAccessLevels($userId);
        foreach ($roles as $role) {
            $this->revoke($role->name, $userId);
        }
    }

    public function grantAccess($userId, $accessLevel)
    {
        $this->assign($accessLevel, $userId);
    }

    public function getAssignsByItem($itemname)
    {
        $sql = "SELECT * FROM {$this->assignmentTable} WHERE itemname=:itemname";
        $command = $this->db->createCommand($sql);
        $command->bindValue(':itemname', $itemname);
        $assignments = array();
        foreach ($command->queryAll($sql) as $row) {
            if (($data = @unserialize($row['data'])) === false)
                $data = null;
            $assignments[] = new CAuthAssignment($this, $row['itemname'], $row['userid'], $row['bizrule'], $data);
        }
        return $assignments;
    }

    public function createAccessLevel($name, $description)
    {
        if (empty($name)) {
            throw new Exception('Access Level Name can\'t be empty');
        }
        $role = $this->createRole($name, $description);
        $role->addChild(self::$_defaultRoleName);
    }

}
