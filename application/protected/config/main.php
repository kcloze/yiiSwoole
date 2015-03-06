<?php

/**
 * 系统配置
 * 
 * 
 * 
 * 
 * Config
 * 
 * 
 */
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'YiiCMS',
    'language' => 'zh_cn',
    'theme' => 'default',
    'preload' => array('log'),
    'timeZone' => 'Asia/Shanghai',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.service.*',
        'application.widget.*',
    ),
    'defaultController' => 'default',
    'modules' => array(
        'admini' => array(
            'class' => 'application.modules.admini.AdminiModule',
        ),
        'test' => array(
            'class' => 'application.modules.test.TestModule',
        ),
    ),
    'components' => array(
        'cache' => array(
            //'class'=>'CFileCache',
            'class' => 'CMemCache',
            'servers' => array(
                array(
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 50,
                ),
                array(
                    'host' => '127.0.0.1',
                    'port' => 11212,
                    'weight' => 50,
                ),
            ),
        ),
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=test',
            'emulatePrepare' => true,
            //'enableParamLogging' => true,
            //'enableProfiling'=>true,
            'schemaCachingDuration' => 3600,
            'username' => 'test',
            'password' => '123456',
            'charset' => 'utf8',
            'tablePrefix' => 'cms_',
        ),
        'errorHandler' => array(
            'errorAction' => 'error/index',
        ),
        'urlManager' => require(dirname(__FILE__) . DS . 'url.php'),
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
    'params' => require(dirname(__FILE__) . DS . 'params.php'),
);
