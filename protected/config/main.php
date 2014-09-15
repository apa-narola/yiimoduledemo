<?php

if (YII_DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'EuroMed',
    'preload' => array('log', 'domainManager'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.yii-debug-toolbar.YiiDebug',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123123',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'backoffice',
        'user',
        'entities',
    ),
    'components' => array(
        'format' => array(
            'class' => 'application.components.Formatter',
        ),
        'user' => array(
            'class' => 'application.components.WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => '/user/auth/login',
        ),
        'domainManager' => array(
            'class' => 'application.components.DomainManager',
            'domains' => array(
                'new.maroc-ferry.com, euromed.tfs, euromed.backoffice.tfs,new.maroc-ferry.dev,yiitest2.dev' => 'backoffice',
            ),
        ),
        'themeManaher' => array(
            'class' => 'application.components.ThemeManager',
        ),
        'authManager' => array(
            'class' => 'application.components.AuthManager',
            'connectionID' => 'db',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'emailManager' => array(
            'class' => 'ext.email.EmailManager',
            'IsSmtp' => true,
            'SMTPAuth' => true,
            'SMTPSecure' => 'ssl',
            'Port' => 465,
            'Username' => '80972210030@mail.ru',
            'Password' => 'skinnermail',
            'Host' => 'smtp.mail.ru',
            'From' => '80972210030@mail.ru',
            'Mailer' => 'smtp',
            'Subject' => 'Sample Subject',
            'CharSet' => 'UTF-8',
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yiitest2',
            'emulatePrepare' => true,
            'nullConversion' => PDO::NULL_NATURAL,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
//                array(
//                    'class' => 'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
//                ),
            ),
        ),
    ),
    'params' => array(
        'adminEmail' => 'webmaster@example.com',
        'companyName' => 'EuroMed',
        'deployKey' => 'Re$ist@nce4',
    ),
);
