<?php

class DeployController extends Controller 
{
    
    private static $_stepsPre = array(
        'cleanAssets',
    );
    
    private static $_stepsPost = array(
        'applyMigrations',
        'refreshModels',
        'refreshACL',
    );
    
    public function init()
    {
        $this->getDbConnection()->enableParamLogging = false;
        $this->getDbConnection()->enableProfiling = false;
        
        return parent::init();
    }

    protected function beforeAction($action) 
    {
        if (parent::beforeAction($action)) {
            $deployKey = Yii::app()->getParams()->itemAt('deployKey');
            return $deployKey !== null && $deployKey === Yii::app()->request->getParam('key');
        }
        return false;
    }

    public function actionPre()
    {
        foreach (self::$_stepsPre as $step) {
            $this->$step();
        }
    }
    
    private function cleanAssets()
    {
        $assets = glob(Yii::getPathOfAlias('webroot.assets') . '/*', GLOB_ONLYDIR);
        foreach ($assets as $dir) {
            self::deleteFolder($dir);
        }
    }
    
    public function actionPost()
    {
        foreach (self::$_stepsPost as $step) {
            $this->$step();
        }
    }
    
    private function applyMigrations()
    {
        $runner=new CConsoleCommandRunner();
        $runner->addCommands(Yii::getPathOfAlias('application.commands'));
        $runner->run(array('yiic', 'silentMigrate', 'up'));
    }
    
    private function refreshModels()
    {
        if (!YII_DEBUG) {
            return;
        }
        $runner=new CConsoleCommandRunner();
        $runner->addCommands(Yii::getPathOfAlias('application.commands'));
        $runner->run(array('yiic', 'model'));
    }
    
    private function refreshACL()
    {
        $runner=new CConsoleCommandRunner();
        $runner->addCommands(Yii::getPathOfAlias('application.commands'));
        $runner->run(array('yiic', 'acl'));
    }

    private static function deleteFolder($path) 
    { 
        $files = array_diff(scandir($path), array('.','..')); 
        foreach ($files as $file) { 
          if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
              self::deleteFolder($path . DIRECTORY_SEPARATOR . $file);
          } else {
              unlink($path . DIRECTORY_SEPARATOR . $file); 
          }
        } 
        return rmdir($path); 
    } 
    
    public function getDbConnection()
    {
        return Yii::app()->db;
    }
    
}
