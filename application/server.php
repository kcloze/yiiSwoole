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
    public $response = null;

    public function __construct()
    {
        $http = new swoole_http_server("0.0.0.0", 9501);

        $http->set(
            array(
                'worker_num'    => 1,
                'daemonize'     => false,
                'max_request'   => 1,
                'dispatch_mode' => 1,
            )
        );

        $http->on('WorkerStart', array($this, 'onWorkerStart'));

        $http->on('request', function ($request, $response) {
            //捕获异常
            register_shutdown_function(array($this, 'handleFatal'));
            //请求过滤
            if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
                return $response->end();
            }
            $this->response = $response;
            if (isset($request->server)) {
                HttpServer::$server = $request->server;
                foreach ($request->server as $key => $value) {
                    $_SERVER[strtoupper($key)] = $value;
                }
            }
            if (isset($request->header)) {
                HttpServer::$header = $request->header;
            }
            if (isset($request->get)) {
                HttpServer::$get = $request->get;
                foreach ($request->get as $key => $value) {
                    $_GET[$key] = $value;
                }
            }
            if (isset($request->post)) {
                HttpServer::$post = $request->post;
                foreach ($request->post as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
            ob_start();
            //实例化yii对象
            try {
                $this->application    = Yii::createWebApplication(FRAMEWORK_CONFIG);
                Yii::$_swooleResponse = $response;
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
    /**
     * Fatal Error的捕获
     *
     */
    public function handleFatal()
    {
        $error = error_get_last();
        if (!isset($error['type'])) {
            return;
        }

        switch ($error['type']) {
            case E_ERROR:
            case E_PARSE:
            case E_DEPRECATED:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
                break;
            default:
                return;
        }
        $message = $error['message'];
        $file    = $error['file'];
        $line    = $error['line'];
        $log     = "\n异常提示：$message ($file:$line)\nStack trace:\n";
        $trace   = debug_backtrace(1);

        foreach ($trace as $i => $t) {
            if (!isset($t['file'])) {
                $t['file'] = 'unknown';
            }
            if (!isset($t['line'])) {
                $t['line'] = 0;
            }
            if (!isset($t['function'])) {
                $t['function'] = 'unknown';
            }
            $log .= "#$i {$t['file']}({$t['line']}): ";
            if (isset($t['object']) && is_object($t['object'])) {
                $log .= get_class($t['object']) . '->';
            }
            $log .= "{$t['function']}()\n";
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $log .= '[QUERY] ' . $_SERVER['REQUEST_URI'];
        }
        //YcfCore::$_log->log($log, 'fatal');
        Yii::log($log, CLogger::LEVEL_ERROR, 'application');
        //YcfCore::$_log->sendTask();
        if ($this->response) {
            $this->response->status(500);
            $this->response->end($log);
        }

        unset($this->response);
    }
    public function onWorkerStart()
    {
        define('YII_ENV', 'development');
        define('SWOOLE', true);
        define('DS', DIRECTORY_SEPARATOR);
        define('BASEPATH', dirname(__FILE__));
        echo BASEPATH . "\r\n";
        if (YII_ENV == 'development') {
            defined('YII_DEBUG') or define('YII_DEBUG', true);
            $config_file = 'main-dev.php';
        } else {
            $config_file = 'main.php';
        }
        define('FRAMEWORK_YII', BASEPATH . DS . DS . '..' . DS . 'framework' . DS . 'yii.php');
        define('FRAMEWORK_CONFIG', BASEPATH . DS . '..' . DS . 'application' . DS . 'protected' . DS . 'config' . DS . $config_file);
        require FRAMEWORK_YII;

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
    }

}

HttpServer::getInstance();
