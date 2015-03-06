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
    'name' => 'YaochufaCMS',
    'language' => 'zh_cn',
    'preload' => array('log'),
    'timeZone' => 'Asia/Shanghai',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.service.*',
    ),
    //'defaultController' => 'default',
    'modules' => array(
        'admini' => array(
            'class' => 'application.modules.admini.AdminiModule',
        ),
    ),
    'components' => array(

        'errorHandler' => array(
            'errorAction' => 'error/index',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                /* array(
                  'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                  'ipFilters'=>array('127.0.0.1','192.168.1.215'),
                  ), */
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'categories' => 'orders.*',
                    'logFile' => 'orders.log',
                ),
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . DS . 'params.php'),
);
