<?php
/**
 * 入口
 *
 */
define('YII_ENV', 'development');
define('DS', DIRECTORY_SEPARATOR);
define('BASEPATH',dirname(__FILE__));
if(YII_ENV=='development'){
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	$config_file='main-dev.php';
}else{
	$config_file='main.php';
}
define('FRAMEWORK_YII',BASEPATH.DS.'framework'.DS.'yii.php');
define('FRAMEWORK_CONFIG',BASEPATH.DS.'application'. DS .'protected'.DS.'config'.DS.$config_file);
require_once (FRAMEWORK_YII);
Yii::createWebApplication(FRAMEWORK_CONFIG)->run();