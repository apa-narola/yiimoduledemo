<?php

ini_set('max_execution_time', 0);
set_time_limit(0);
ini_set('memory_limit', '-1');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yiitest2',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling' => false,
            'enableParamLogging' => false,
        ),
        'authManager' => array(
            'class' => 'application.components.AuthManager',
            'connectionID' => 'db',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);
