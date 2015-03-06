<?php

// change the following paths if necessary
define('DS', DIRECTORY_SEPARATOR);
require_once(dirname(__FILE__).DS.'..'.DS.'yiiEnv.php');
if(defined('YII_ENV') && YII_ENV=='development'){
	$config=dirname(__FILE__).DS.'config'.DS.'console-dev.php';
}else{
	$config=dirname(__FILE__).DS.'config'.DS.'console.php';
}
$yiic=dirname(__FILE__).DS.'..'.DS.'..'.DS.'framework'.DS.'yiic.php';
require_once($yiic);
