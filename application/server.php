<?php

class HttpServer
{
	public static $instance;

	public $http;
	public static $get;
	public static $post;
	public static $header;
	public static $server;
	private $application;

	public function __construct() {
		$http = new swoole_http_server("0.0.0.0", 9501);

		$http->set(
			array(
				'worker_num' => 4,
				'daemonize' => false,
	            'max_request' => 1,
	            'dispatch_mode' => 1
			)
		);

		$http->on('WorkerStart' , array( $this , 'onWorkerStart'));

		$http->on('request', function ($request, $response) {
			if( isset($request->server) ) {
				HttpServer::$server = $request->server;
				foreach ($request->server as $key => $value) {
					$_SERVER[ strtoupper($key) ] = $value;
				}
			}
			if( isset($request->header) ) {
				HttpServer::$header = $request->header;
			}
			if( isset($request->get) ) {
				HttpServer::$get = $request->get;
				foreach ($request->get as $key => $value) {
					$_GET[ $key ] = $value;
				}
			}
			if( isset($request->post) ) {
				HttpServer::$post = $request->post;
				foreach ($request->post as $key => $value) {
					$_POST[ $key ] = $value;
				}
			}
			ob_start();
			//实例化yii对象
			try {
				$this->application=Yii::createWebApplication(FRAMEWORK_CONFIG);
				$this->application->run();
			} catch (Exception $e) {
				var_dump($e);
			}
		    $result = ob_get_contents();
		  	ob_end_clean();
		  	$response->end($result);
		  	unset($result);
		  	unset($this->application);
		});

		$http->start();
	}

	public function onWorkerStart() {
		define('YII_ENV', 'development');
		define('DS', DIRECTORY_SEPARATOR);
		define('BASEPATH',dirname(__FILE__));
		echo BASEPATH."\r\n";
		if(YII_ENV=='development'){
			defined('YII_DEBUG') or define('YII_DEBUG',true);
			$config_file='main-dev.php';
		}else{
			$config_file='main.php';
		}
		define('FRAMEWORK_YII',BASEPATH.DS.DS.'..'.DS.'framework'.DS.'yii.php');
		define('FRAMEWORK_CONFIG',BASEPATH.DS.'..'.DS.'application'. DS .'protected'.DS.'config'.DS.$config_file);
		require(FRAMEWORK_YII);
		/*ob_start();
		require_once(FRAMEWORK_YII);
		$this->application=Yii::createWebApplication(FRAMEWORK_CONFIG);
		ob_end_clean();*/

	}

	public static function getInstance() {
		if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
	}
}

HttpServer::getInstance();