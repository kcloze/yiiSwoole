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
        'application.widget.*', //将widgets类导入
    ),
    'defaultController' => 'default',
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123123',
        // 'ipFilters'=>array(...IP 列表...),
        // 'newFileMode'=>0666,
        // 'newDirMode'=>0777,
        ),
        'test' => array(
            'class' => 'application.modules.test.TestModule',
        ),
    ),
    'components' => array(

        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=127.0.0.1;dbname=test',
            'emulatePrepare' => true,
            'enableParamLogging' => true,
            'enableProfiling' => true,
            'username' => 'test',
            'password' => '123456',
            'charset' => 'utf8',
            'tablePrefix' => 'cms_',
        ),
        /* 'errorHandler'=>array(
          'errorAction'=>'error/index',
          ), */
        'urlManager' => require(dirname(__FILE__) . DS . 'url.php'),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace,info,error,warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'categories' => 'weixin.*',
                    'logFile' => 'weixin.log',
                ),
            ),
        /* 'routes'=>array(
          array(
          'class'=>'CProfileLogRoute',
          'levels'=>' trace, info, error, warning',
          'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
          'ipFilters'=>array('127.0.0.1','192.168.1.215'),
          ),
          ), */
        ),
    ),
    'params' => require(dirname(__FILE__) . DS . 'params-dev.php'),
);
