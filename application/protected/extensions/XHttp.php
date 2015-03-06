<?php
/**
 * Http工具类
 * 
 * 
 * 
 * 
 * Tools
 * 
 * 
 */
class XHttp{

	/**
	 * 文件下载
	 */
	static function download ($filename, $showname='', $content='',$expire=180){
		Yii::import( 'application.vendors.*' );
        require_once 'Tp/Http.class.php';
        Http::download($filename, $showname, $content,$expire);
	}
	static function post ($url_mixed, $data = array()){
		Yii::import( 'application.vendors.*' );
        require_once 'Tp/Curl.class.php';
        $curl = new Curl();
		$curl->post($url_mixed,$data);
		return $curl->response;
	}
	static function post_json($url_mixed, $data = array()){
		Yii::import( 'application.vendors.*' );
        require_once 'Tp/Curl.class.php';
        $curl = new Curl();
		$curl->post($url_mixed,$data);
		return $curl->response;
	}

	static function get ($url_mixed, $data = array()){
		Yii::import( 'application.vendors.*' );
        require_once 'Tp/Curl.class.php';
        $curl = new Curl();
		$curl->get($url_mixed,$data);
		return $curl->response;
	}

	static function api_get ($url_mixed, $data = array(),$debug=false,$over_time=15){
		Yii::import( 'application.vendors.*' );
        require_once 'Tp/Curl.class.php';
        $curl = new Curl();
        if(YII_ENV=='development'){
        	$curl->setHeader('Apihandshake', 'yaochufa');
            $curl->setHeader('Referer', 'http://m.yaochufa.com');
        }else{
        	$curl->setHeader('Apihandshake', 'yaochufaapi');
            $curl->setHeader('Referer', 'http://m.yaochufa.com');
        }
        $curl->setOpt(CURLOPT_TIMEOUT, $over_time);
		$curl->get($url_mixed,$data);
		if($debug==true){
			XUtils::dump($curl->request_headers);
		}
		return $curl->response;
	}

	static function mapi_get ($url_mixed, $data = array(),$debug=false){
		//$debug=true;
		Yii::import( 'application.vendors.*' );
		require_once 'Tp/Curl.class.php';
		$curl = new Curl();
		if(YII_ENV=='development'){
			$curl->setHeader('Apihandshake', 'yaochufa');
			$curl->setHeader('Referer', 'http://m.yaochufa.com');
		}else{
			$curl->setHeader('Apihandshake', 'yaochufaapi');
			$curl->setHeader('Referer', 'http://m.yaochufa.com');
		}
		$curl->setOpt(CURLOPT_TIMEOUT, 15);
		$data['system']=Yii::app()->params['mmm_api']['system'];
		$curl->get($url_mixed,$data);
		if($debug==true){
			XUtils::dump($curl->request_headers);
		}
		return $curl->response;
	}

}


