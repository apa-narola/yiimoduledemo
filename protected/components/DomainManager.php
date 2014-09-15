<?php

class DomainManager extends CApplicationComponent {
    
    private $_domains;
    private $_domain;
    
    public function init() {
        
        $modules = glob(Yii::getPathOfAlias('application.modules') . '/*', GLOB_ONLYDIR);
        foreach ($modules as $dir) {
            Yii::setPathOfAlias(basename($dir), $dir);
        }
        
        if (isset($this->_domains[Yii::app()->request->serverName])) {
            $config = $this->_domains[Yii::app()->request->serverName];
            if (is_string($config)) {
                $configFile = Yii::getPathOfAlias('application.config.domains.' . $config) . '.php';
                if (is_file($configFile)) {
                    $config = include $configFile;
                } else {
                    $config = array();
                }
            }
            
            Yii::app()->configure($config);
            
            $this->loadDomain();
            
            $domainTheme = Yii::app()->getParams()->offsetGet('theme');
            if (!empty($domainTheme)) {
                Yii::app()->configure(array(
                    'theme' => $domainTheme,
                ));
            }
            
            if (null !== Yii::app()->theme) {
                $config = Yii::app()->theme->basePath . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'config.php';
                if (is_file($config)) {
                    $config = include $config;
                    Yii::app()->configure($config);
                }
            }
        }
    }
    
    protected function loadDomain()
    {
        if (null !== ($model = Domain::model()->findByAttributes(array(
            'name' => Yii::app()->request->serverName,
        )))) {
            Yii::app()->getParams()->mergeWith($model->attributes);
        } else {
            $model = new Domain;
            Yii::app()->getParams()->mergeWith($model->attributes);
        }
    }
    
    public function setDomains($config) {
        if (null === $this->_domains) {
            $this->_domains = array();
        }
        
        foreach ($config AS $domain=>$configName) {
            $aliases = array_filter(preg_split('/[;, \n]+/', $domain));
            foreach ($aliases as $alias) {
                $this->_domains[$alias] = $configName;
            }
        }
    }
    
}
