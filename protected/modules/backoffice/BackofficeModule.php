<?php

class BackofficeModule extends CWebModule
{

    public $theme = 'backoffice';

    public function init()
    {
		$this->setImport(array(
            'backoffice.models.*',
            'backoffice.components.*',
            'backoffice.widgets.*',
        ));

        $this->registerComponents();
        $this->registerClientScript();
    }
    
    public function getConfigMenuActive()
    {
        static $controllersIds = null;
        
        if (!$controllersIds) {
            $controllers = glob($this->getControllerPath() . '/*Controller.php');
            $controllersIds = array_map('strtolower', array_map('basename', $controllers, array_fill(0, count($controllers), 'Controller.php')));
        }
        
        return Yii::app()->controller->module 
                && Yii::app()->controller->module->id === $this->id
                && Yii::app()->controller->id !== 'default'
                && in_array(Yii::app()->controller->id, $controllersIds);
    }

    public function beforeControllerAction($controller, $action)
    {
        return parent::beforeControllerAction($controller, $action);
    }

    protected function registerComponents()
    {
        Yii::app()->setComponents(array(
            'user' => array(
                'class' => 'application.components.WebUser',
                'allowAutoLogin' => true,
                'loginUrl' => '/backoffice/user/auth/login',
            ),
        ));

        $this->modules = array_diff_key(Yii::app()->modules, array_flip(array(
            'backoffice',
            'gii',
        )));
    }

    protected function registerClientScript()
    {
        Yii::app()->theme = $this->theme;
        $baseUrl = Yii::app()->theme->baseUrl;

        Yii::app()->clientScript
                ->registerCoreScript('jquery')
                ->registerScriptFile('/lib/bootstrap/js/bootstrap.min.js', CClientScript::POS_END, array())
                ->registerCssFile('/lib/bootstrap/css/bootstrap.min.css');

        Yii::app()->clientScript
                ->registerScriptFile($baseUrl . '/assets/js/apps.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/mask/jquery.mask.min.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/nicescroll/jquery.nicescroll.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/backstretch/jquery.backstretch.min.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/magnific-popup/jquery.magnific-popup.min.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/slimscroll/jquery.slimscroll.min.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/chosen/chosen.jquery.min.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/chosen//ajax-chosen.min.js', CClientScript::POS_END, array())
                ->registerScriptFile($baseUrl . '/assets/plugins/icheck/icheck.min.js', CClientScript::POS_END, array())
                ->registerCssFile($baseUrl . '/assets/plugins/chosen/chosen.min.css')
                ->registerCssFile($baseUrl . '/assets/plugins/icheck/skins/all.css')
                ->registerCssFile($baseUrl . '/assets/plugins/font-awesome/css/font-awesome.min.css')
                ->registerCssFile($baseUrl . '/assets/css/style.css')
                ->registerCssFile($baseUrl . '/assets/css/style-responsive.css');
    }

    public static function createAccessRules($authManager, $defaultRole)
    {
        /* {{{ Create Societe management rules */
        $authManager->createOperation('Backoffice.Societe.View', 'View');
        $authManager->createOperation('Backoffice.Societe.Update', 'Update');
        $authManager->createOperation('Backoffice.Societe.Create', 'Create');
        $authManager->createOperation('Backoffice.Societe.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.Societe', 'Societes Management');
        $task->addChild('Backoffice.Societe.View');
        $task->addChild('Backoffice.Societe.Update');
        $task->addChild('Backoffice.Societe.Create');
        $task->addChild('Backoffice.Societe.Delete');
        /* }}} */

        /* {{{ Create Bank management rules */
        $authManager->createOperation('Backoffice.Bank.View', 'View');
        $authManager->createOperation('Backoffice.Bank.Update', 'Update');
        $authManager->createOperation('Backoffice.Bank.Create', 'Create');
        $authManager->createOperation('Backoffice.Bank.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.Bank', 'Bank Management');
        $task->addChild('Backoffice.Bank.View');
        $task->addChild('Backoffice.Bank.Update');
        $task->addChild('Backoffice.Bank.Create');
        $task->addChild('Backoffice.Bank.Delete');
        /* }}} */

        /* {{{ Create Domain management rules */
        $authManager->createOperation('Backoffice.Domain.View', 'View');
        $authManager->createOperation('Backoffice.Domain.Update', 'Update');
        $authManager->createOperation('Backoffice.Domain.Create', 'Create');
        $authManager->createOperation('Backoffice.Domain.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.Domain', 'Domain Management');
        $task->addChild('Backoffice.Domain.View');
        $task->addChild('Backoffice.Domain.Update');
        $task->addChild('Backoffice.Domain.Create');
        $task->addChild('Backoffice.Domain.Delete');
        /* }}} */
        
        /* {{{ Create ApplicationType management rules */
        $authManager->createOperation('Backoffice.ApplicationType.View', 'View');
        $authManager->createOperation('Backoffice.ApplicationType.Update', 'Update');
        $authManager->createOperation('Backoffice.ApplicationType.Create', 'Create');
        $authManager->createOperation('Backoffice.ApplicationType.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.ApplicationType', 'Application Type Management');
        $task->addChild('Backoffice.ApplicationType.View');
        $task->addChild('Backoffice.ApplicationType.Update');
        $task->addChild('Backoffice.ApplicationType.Create');
        $task->addChild('Backoffice.ApplicationType.Delete');
        /* }}} */
        
        /* {{{ Create CountryList management rules */
        $authManager->createOperation('Backoffice.Country.View', 'View');
        $authManager->createOperation('Backoffice.Country.Update', 'Update');
        $authManager->createOperation('Backoffice.Country.Create', 'Create');
        $authManager->createOperation('Backoffice.Country.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.Country', 'Country Management');
        $task->addChild('Backoffice.Country.View');
        $task->addChild('Backoffice.Country.Update');
        $task->addChild('Backoffice.Country.Create');
        $task->addChild('Backoffice.Country.Delete');
        /* }}} */
        
        /* {{{ Create Language management rules */
        $authManager->createOperation('Backoffice.Language.View', 'View');
        $authManager->createOperation('Backoffice.Language.Update', 'Update');
        $authManager->createOperation('Backoffice.Language.Create', 'Create');
        $authManager->createOperation('Backoffice.Language.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.Language', 'Language Management');
        $task->addChild('Backoffice.Language.View');
        $task->addChild('Backoffice.Language.Update');
        $task->addChild('Backoffice.Language.Create');
        $task->addChild('Backoffice.Language.Delete');
        /* }}} */
        
        /* {{{ Create Service management rules */
        $authManager->createOperation('Backoffice.Service.View', 'View');
        $authManager->createOperation('Backoffice.Service.Update', 'Update');
        $authManager->createOperation('Backoffice.Service.Create', 'Create');
        $authManager->createOperation('Backoffice.Service.Delete', 'Delete');

        $task = $authManager->createTask('Backoffice.Service', 'Service Management');
        $task->addChild('Backoffice.Service.View');
        $task->addChild('Backoffice.Service.Update');
        $task->addChild('Backoffice.Service.Create');
        $task->addChild('Backoffice.Service.Delete');
        /* }}} */

        $task = $authManager->createTask('Backoffice', 'Backoffice');
        $task->addChild('Backoffice.Societe');
        $task->addChild('Backoffice.Bank');
        $task->addChild('Backoffice.Domain');
        $task->addChild('Backoffice.ApplicationType');
        $task->addChild('Backoffice.Country');
        $task->addChild('Backoffice.Language');
        $task->addChild('Backoffice.Service');

        $defaultRole->addChild('Backoffice');
    }

}
