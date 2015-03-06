<?php
/**
 * 入口
 *
 * 
 * 
 * 
 * 
 * 
 * 
 */
require_once ('yiiEnv.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
define('DS', DIRECTORY_SEPARATOR);
define('WWWPATH', str_replace(array('\\', '\\\\'), '/', dirname(__FILE__)));

if(defined('YII_ENV') && YII_ENV=='development'){
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	$config_file='main-dev.php';
}else{
	$config_file='main.php';
}
$framework = dirname(__FILE__) . DS.'..'.DS.'framework'.DS.'yii.php';
$config = WWWPATH . DS .'protected'.DS.'config'.DS.$config_file;
require_once ($framework);
Yii::createWebApplication($config)->run();