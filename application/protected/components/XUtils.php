<?php
/**
 * 系统助手类
 * 
 * 
 * 
 * 
 * Tools
 * 
 * 
 */

class XUtils {

    /**
     * 友好显示var_dump
     */
    static public function dump( $var, $echo = true, $label = null, $strict = true ) {
        $label = ( $label === null ) ? '' : rtrim( $label ) . ' ';
        if ( ! $strict ) {
            if ( ini_get( 'html_errors' ) ) {
                $output = print_r( $var, true );
                $output = "<pre>" . $label . htmlspecialchars( $output, ENT_QUOTES ) . "</pre>";
            } else {
                $output = $label . print_r( $var, true );
            }
        } else {
            ob_start();
            var_dump( $var );
            $output = ob_get_clean();
            if ( ! extension_loaded( 'xdebug' ) ) {
                $output = preg_replace( "/\]\=\>\n(\s+)/m", "] => ", $output );
                $output = '<pre>' . $label . htmlspecialchars( $output, ENT_QUOTES ) . '</pre>';
            }
        }
        if ( $echo ) {
            echo $output;
            return null;
        } else
            return $output;
    }

    /**
     * 获取客户端IP地址
     */
    static public function getClientIP() {
        static $ip = NULL;
        if ( $ip !== NULL )
            return $ip;
        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $arr = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
            $pos = array_search( 'unknown', $arr );
            if ( false !== $pos )
                unset( $arr[$pos] );
            $ip = trim( $arr[0] );
        } elseif ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $ip = ( false !== ip2long( $ip ) ) ? $ip : '0.0.0.0';
        return $ip;
    }
    
    /**
     * 获取客户端城市IP地址
     */
    static public function getCityIP($value) {
	    Yii::import( 'application.extensions.17mon.*');
	    require_once 'IP.class.php';
	    //IP::init();
	    $ip = IP::find($value);//'106.185.24.112'
        return $ip;
    }
    /**
     * 循环创建目录
     */
    static public function mkdir( $dir, $mode = 0777 ) {
        if ( is_dir( $dir ) || @mkdir( $dir, $mode ) )
            return true;
        if ( ! mk_dir( dirname( $dir ), $mode ) )
            return false;
        return @mkdir( $dir, $mode );
    }

    /**
     * 格式化单位
     */
    static public function byteFormat( $size, $dec = 2 ) {
        $a = array ( "B" , "KB" , "MB" , "GB" , "TB" , "PB" );
        $pos = 0;
        while ( $size >= 1024 ) {
            $size /= 1024;
            $pos ++;
        }
        return round( $size, $dec ) . " " . $a[$pos];
    }

    /**
     * 下拉框，单选按钮 自动选择
     *
     * @param $string 输入字符
     * @param $param  条件
     * @param $type   类型
     *            selected checked
     * @return string
     */
    static public function selected( $string, $param = 1, $type = 'select' ) {

        if ( is_array( $param ) ) {
            $true = in_array( $string, $param );
        }elseif ( $string == $param ) {
            $true = true;
        }
        if ( $true )
            $return = $type == 'select' ? 'selected="selected"' : 'checked="checked"';

        echo $return;
    }

    /**
     * 获得来源类型 post get
     *
     * @return unknown
     */
    static public function method() {
        return strtoupper( isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : 'GET' );
    }

    /**
     * 提示信息
     */
    static public function message( $action = 'success', $content = '', $redirect = 'javascript:history.back(-1);', $timeout = 4 ) {

        switch ( $action ) {
        case 'success':
            $titler = '操作完成';
            $class = 'message_success';
            $images = 'message_success.png';
            break;
        case 'error':
            $titler = '操作未完成';
            $class = 'message_error';
            $images = 'message_error.png';
            break;
        case 'errorBack':
            $titler = '操作未完成';
            $class = 'message_error';
            $images = 'message_error.png';
            break;
        case 'redirect':
            header( "Location:$redirect" );
            break;
        case 'script':
            if ( empty( $redirect ) ) {
                exit( '<script language="javascript">alert("' . $content . '");window.history.back(-1)</script>' );
            } else {
                exit( '<script language="javascript">alert("' . $content . '");window.location=" ' . $redirect . '   "</script>' );
            }
            break;
        }

        // 信息头部
        $header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>操作提示</title>
<style type="text/css">
body{font:12px/1.7 "\5b8b\4f53",Tahoma;}
html,body,div,p,a,h3{margin:0;padding:0;}
.tips_wrap{ background:#F7FBFE;border:1px solid #DEEDF6;width:780px;padding:50px;margin:50px auto 0;}
.tips_inner{zoom:1;}
.tips_inner:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
.tips_inner .tips_img{width:80px;float:left;}
.tips_info{float:left;line-height:35px;width:650px}
.tips_info h3{font-weight:bold;color:#1A90C1;font-size:16px;}
.tips_info p{font-size:14px;color:#999;}
.tips_info p.message_error{font-weight:bold;color:#F00;font-size:16px; line-height:22px}
.tips_info p.message_success{font-weight:bold;color:#1a90c1;font-size:16px; line-height:22px}
.tips_info p.return{font-size:12px}
.tips_info .time{color:#f00; font-size:14px; font-weight:bold}
.tips_info p a{color:#1A90C1;text-decoration:none;}
</style>
</head>

<body>';
        // 信息底部
        $footer = '</body></html>';

        $body = '<script type="text/javascript">
        function delayURL(url) {
        var delay = document.getElementById("time").innerHTML;
        //alert(delay);
        if(delay > 0){
        delay--;
        document.getElementById("time").innerHTML = delay;
    } else {
    window.location.href = url;
    }
    setTimeout("delayURL(\'" + url + "\')", 1000);
    }
    </script><div class="tips_wrap">
    <div class="tips_inner">
        <div class="tips_img">
            <img src="' . Yii::app()->baseUrl . '/static/images/' . $images . '"/>
        </div>
        <div class="tips_info">

            <p class="' . $class . '">[' .Yii::app()->controller->id.']'. $content . '</p>
            <p class="return">系统自动跳转在  <span class="time" id="time">' . $timeout . ' </span>  秒后，如果不想等待，<a href="' . $redirect . '">点击这里跳转</a></p>
        </div>
    </div>
</div><script type="text/javascript">
    delayURL("' . $redirect . '");
    </script>';

        exit( $header . $body . $footer );
    }

    /**
     * 查询字符生成
     */
    static public function buildCondition( array $getArray, array $keys = array() ) {
        if ( $getArray ) {
            foreach ( $getArray as $key => $value ) {
                if ( in_array( $key, $keys ) && $value ) {
                    $arr[$key] = CHtml::encode(strip_tags($value));
                }
            }
            return $arr;
        }
    }

    /**
     * base64_encode
     */
    static function b64encode( $string ) {
        $data = base64_encode( $string );
        $data = str_replace( array ( '+' , '/' , '=' ), array ( '-' , '_' , '' ), $data );
        return $data;
    }

    /**
     * base64_decode
     */
    static function b64decode( $string ) {
        $data = str_replace( array ( '-' , '_' ), array ( '+' , '/' ), $string );
        $mod4 = strlen( $data ) % 4;
        if ( $mod4 ) {
            $data .= substr( '====', $mod4 );
        }
        return base64_decode( $data );
    }

    /**
     * 验证邮箱
     */
    public static function email( $str ) {
        if ( empty( $str ) )
            return true;
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if ( strpos( $str, '@' ) !== false && strpos( $str, '.' ) !== false ) {
            if ( preg_match( $chars, $str ) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    /**
     * 验证手机号码
     */
    public static function mobile( $str ) {
        if ( empty( $str ) ) {
            return true;
        }

        return preg_match( '#^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$#', $str );
    }
    
    /**
     * 验证固定电话
     */
    public static function tel( $str ) {
        if ( empty( $str ) ) {
            return true;
        }
        return preg_match( '/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', trim( $str ) );

    }
    
    /**
     * 验证qq号码
     */
    public static function qq( $str ) {
        if ( empty( $str ) ) {
            return true;
        }

        return preg_match( '/^[1-9]\d{4,12}$/', trim( $str ) );
    }

    /**
     * 验证邮政编码
     */
    public static function zipCode( $str ) {
        if ( empty( $str ) ) {
            return true;
        }

        return preg_match( '/^[1-9]\d{5}$/', trim( $str ) );
    }
    
    /**
     * 验证ip
     */
    public static function ip( $str ) {
        if ( empty( $str ) )
            return true;

        if ( ! preg_match( '#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$#', $str ) ) {
            return false;
        }

        $ip_array = explode( '.', $str );

        //真实的ip地址每个数字不能大于255（0-255）
        return ( $ip_array[0] <= 255 && $ip_array[1] <= 255 && $ip_array[2] <= 255 && $ip_array[3] <= 255 ) ? true : false;
    }

    /**
     * 验证身份证(中国)
     */
    public static function idCard( $str ) {
        $str = trim( $str );
        if ( empty( $str ) )
            return true;

        if ( preg_match( "/^([0-9]{15}|[0-9]{17}[0-9a-z])$/i", $str ) )
            return true;
        else
            return false;
    }

    /**
     * 验证网址
     */
    public static function url( $str ) {
        if ( empty( $str ) )
            return true;

        return preg_match( '#(http|https|ftp|ftps)://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?#i', $str ) ? true : false;
    }

    /**
     * 根据ip获取地理位置
     * @param $ip
     * return :ip,beginip,endip,country,area
     */
    public static function getlocation( $ip = '' ) {
        $ip = new XIp();
        $ipArr = $ip->getlocation( $ip );
        return $ipArr;
    }

    /**
     * 中文转换为拼音
     */
    public static function pinyin( $str ) {
        $ip = new XPinyin();
        return $ip->output( $str );
    }

    /**
     * 拆分sql
     *
     * @param $sql
     */
    public static function splitsql( $sql ) {
         $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=" . Yii::app()->db->charset, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array ();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num ++;
        }
        return ($ret);
    }

    /**
     * 字符截取
     *
     * @param $string
     * @param $length
     * @param $dot
     */
    public static function cutstr( $string, $length, $dot = '...', $charset = 'utf-8' ) {
        if ( strlen( $string ) <= $length )
            return $string;

        $pre = chr( 1 );
        $end = chr( 1 );
        $string = str_replace( array ( '&amp;' , '&quot;' , '&lt;' , '&gt;' ), array ( $pre . '&' . $end , $pre . '"' . $end , $pre . '<' . $end , $pre . '>' . $end ), $string );

        $strcut = '';
        if ( strtolower( $charset ) == 'utf-8' ) {

            $n = $tn = $noc = 0;
            while ( $n < strlen( $string ) ) {

                $t = ord( $string[$n] );
                if ( $t == 9 || $t == 10 || ( 32 <= $t && $t <= 126 ) ) {
                    $tn = 1;
                    $n ++;
                    $noc ++;
                } elseif ( 194 <= $t && $t <= 223 ) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif ( 224 <= $t && $t <= 239 ) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif ( 240 <= $t && $t <= 247 ) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif ( 248 <= $t && $t <= 251 ) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ( $t == 252 || $t == 253 ) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n ++;
                }

                if ( $noc >= $length ) {
                    break;
                }

            }
            if ( $noc > $length ) {
                $n -= $tn;
            }

            $strcut = substr( $string, 0, $n );

        } else {
            for ( $i = 0; $i < $length; $i ++ ) {
                $strcut .= ord( $string[$i] ) > 127 ? $string[$i] . $string[++ $i] : $string[$i];
            }
        }

        $strcut = str_replace( array ( $pre . '&' . $end , $pre . '"' . $end , $pre . '<' . $end , $pre . '>' . $end ), array ( '&amp;' , '&quot;' , '&lt;' , '&gt;' ), $strcut );

        $pos = strrpos( $strcut, chr( 1 ) );
        if ( $pos !== false ) {
            $strcut = substr( $strcut, 0, $pos );
        }
        return $strcut . $dot;
    }

    /**
     * 描述格式化
     * @param  $subject
     */
    public static function clearCutstr ($subject, $length = 0, $dot = '...', $charset = 'utf-8')
    {
        if ($length) {
            return XUtils::cutstr(strip_tags(str_replace(array ("\r\n" ), '', $subject)), $length, $dot, $charset);
        } else {
            return strip_tags(str_replace(array ("\r\n" ), '', $subject));
        }
    }

    /**
     * 检测是否为英文或英文数字的组合
     *
     * @return unknown
     */
    public static function isEnglist( $param ) {
        if ( ! eregi( "^[A-Z0-9]{1,26}$", $param ) ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 将自动判断网址是否加http://
     *
     * @param $http
     * @return  string
     */
    public static function convertHttp( $url ) {
        if ( $url == 'http://' || $url == '' )
            return '';

        if ( substr( $url, 0, 7 ) != 'http://' && substr( $url, 0, 8 ) != 'https://' )
            $str = 'http://' . $url;
        else
            $str = $url;
        return $str;

    }

    /*
        标题样式格式化
    */
    public static function titleStyle( $style ) {
        $text = '';
        if ( $style['bold'] == 'Y' ) {
            $text .='font-weight:bold;';
            $serialize['bold'] = 'Y';
        }

        if ( $style['underline'] == 'Y' ) {
            $text .='text-decoration:underline;';
            $serialize['underline'] = 'Y';
        }

        if ( !empty( $style['color'] ) ) {
            $text .='color:#'.$style['color'].';';
            $serialize['color'] = $style['color'];
        }

        return array( 'text' => $text, 'serialize'=>empty( $serialize )? '': serialize( $serialize ) );

    }

     // 自动转换字符集 支持数组转换
    static public function autoCharset ($string, $from = 'gbk', $to = 'utf-8')
    {
        $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
        $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
        if (strtoupper($from) === strtoupper($to) || empty($string) || (is_scalar($string) && ! is_string($string))) {
            //如果编码相同或者非字符串标量则不转换
            return $string;
        }
        if (is_string($string)) {
            if (function_exists('mb_convert_encoding')) {
                return mb_convert_encoding($string, $to, $from);
            } elseif (function_exists('iconv')) {
                return iconv($from, $to, $string);
            } else {
                return $string;
            }
        } elseif (is_array($string)) {
            foreach ($string as $key => $val) {
                $_key = self::autoCharset($key, $from, $to);
                $string[$_key] = self::autoCharset($val, $from, $to);
                if ($key != $_key)
                    unset($string[$key]);
            }
            return $string;
        } else {
            return $string;
        }
    }

    /*
        标题样式恢复
    */
    public static function titleStyleRestore( $serialize, $scope = 'bold' ) {
        $unserialize = unserialize( $serialize );
        if ( $unserialize['bold'] =='Y' && $scope == 'bold' )
            return 'Y';
        if ( $unserialize['underline'] =='Y' && $scope == 'underline' )
            return 'Y';
        if ( $unserialize['color'] && $scope == 'color' )
            return $unserialize['color'];

    }

    /**
     * 列出文件夹列表
     *
     * @param $dirname
     * @return unknown
     */
    public static function getDir( $dirname ) {
        $files = array();
        if ( is_dir( $dirname ) ) {
            $fileHander = opendir( $dirname );
            while ( ( $file = readdir( $fileHander ) ) !== false ) {
                $filepath = $dirname . '/' . $file;
                if ( strcmp( $file, '.' ) == 0 || strcmp( $file, '..' ) == 0 || is_file( $filepath ) ) {
                    continue;
                }
                $files[] =  self::autoCharset( $file, 'GBK', 'UTF8' );
            }
            closedir( $fileHander );
        }
        else {
            $files = false;
        }
        return $files;
    }

    /**
     * 列出文件列表
     *
     * @param $dirname
     * @return unknown
     */
    public static function getFile( $dirname ) {
        $files = array();
        if ( is_dir( $dirname ) ) {
            $fileHander = opendir( $dirname );
            while ( ( $file = readdir( $fileHander ) ) !== false ) {
                $filepath = $dirname . '/' . $file;

                if ( strcmp( $file, '.' ) == 0 || strcmp( $file, '..' ) == 0 || is_dir( $filepath ) ) {
                    continue;
                }
                $files[] = self::autoCharset( $file, 'GBK', 'UTF8' );;
            }
            closedir( $fileHander );
        }
        else {
            $files = false;
        }
        return $files;
    }
    
    public static function traverse($path = '.') {
                static $files=array();
                $current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
                while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
                    $sub_dir = $path . $file;    //构建子目录路径
                    if($file == '.' || $file == '..') {
                        continue;
                    } else if(is_dir($sub_dir)) {    //如果是目录,进行递归
                        //echo 'Directory ' . $file . ':<br>';
                        self::traverse($sub_dir);
                    } else {    //如果是文件,直接输出
                        if(preg_match('/(\.jpg$)|(\.png$)|(\.gif$)/i', $path.'/'.$file)){
                            if(strpos($path.'/'.$file, 'thumb_')===false){
                                $files[]=substr($path.'/'.$file,strpos($path.'/'.$file,'uploads/'));
                            }
                            
                        }                        
                    }
                }
                return $files;
    }

    /**
     * [格式化图片列表数据]
     *
     * @return [type] [description]
     */
    public static function imageListSerialize( $data ) {

        foreach ( (array)$data['file'] as $key => $row ) {
            if ( $row ) {
                $var[$key]['fileId'] = $data['fileId'][$key];
                $var[$key]['file'] = $row;
            }

        }
        return array( 'data'=>$var, 'dataSerialize'=>empty( $var )? '': serialize( $var ) );

    }

    /**
     * 反引用一个引用字符串
     * @param  $string
     * @return string
     */
    static function stripslashes($string) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = self::stripslashes($val);
            }
        } else {
            $string = stripslashes($string);
        }
        return $string;
    }
    
    /**
     * 引用字符串
     * @param  $string
     * @param  $force
     * @return string
     */
   static function addslashes($string, $force = 1) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = self::addslashes($val, $force);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }

    /**
     * 格式化内容
     */
    static function formatHtml($content, $options = ''){
        $purifier = new CHtmlPurifier();
        if($options != false)
            $purifier->options = $options;
        return $purifier->purify($content);
    }

    /**
     * 压缩html : 清除换行符,清除制表符,去掉注释标记  
     * @param $string  
     * @return  压缩后的$string 
     * */
    static function compress_html($string) {  
        $string = str_replace("\r\n", '', $string); //清除换行符  
        $string = str_replace("\n", '', $string); //清除换行符  
        $string = str_replace("\t", '', $string); //清除制表符  
        $pattern = array (  
                        "/> *([^ ]*) *</", //去掉注释标记  
                        "/[\s]+/",  
                        "/<!--[^!]*-->/",  
                        "/\" /",  
                        "/ \"/",  
                        "'/\*[^*]*\*/'"  
                        );  
        $replace = array (  
                        ">\\1<",  
                        "  ",  
                        "",  
                        "\"",  
                        "\"",  
                        ""  
                        );  
        return preg_replace($pattern, $replace, $string);  
    }


    
    /**
     *打印函数
     *$arr 需要输出的数组
     */
    static public function p($arr){
    	echo '<pre>';
    	print_r($arr);
    	echo '</pre>';
    
    }

    static public function log($errmsg,$fileName){
        $path = yii::app()->basePath.'/runtime/';
        $filename=$path.$fileName.'.log';
        $fp2=@fopen($filename, "a");
        fwrite($fp2,date('Y-m-d H:i:s').'  '.$errmsg."\r\n");
        fclose($fp2);
    }

    static public function is_mobile_request(){   
      $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';   
      $mobile_browser = '0';   
      if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))   
        $mobile_browser++;   
      if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))   
        $mobile_browser++;   
      if(isset($_SERVER['HTTP_X_WAP_PROFILE']))   
        $mobile_browser++;   
      if(isset($_SERVER['HTTP_PROFILE']))   
        $mobile_browser++;   
      $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));   
      $mobile_agents = array(   
            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',   
            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',   
            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',   
            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',   
            'newt','noki','oper','palm','pana','pant','phil','play','port','prox',   
            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',   
            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',   
            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',   
            'wapr','webc','winw','winw','xda','xda-'   
            );   
      if(in_array($mobile_ua, $mobile_agents))   
        $mobile_browser++;   
      if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)   
        $mobile_browser++;   
      // Pre-final check to reset everything if the user is on Windows   
      if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)   
        $mobile_browser=0;   
      // But WP7 is also Windows, with a slightly different characteristic   
      if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)   
        $mobile_browser++;   
      if($mobile_browser>0)   
        return true;   
      else  
        return false;   
    }

    /**
     * 
     * html内容分页
     * @param $content html内容
     * @param $number 每页的字符数
     */
	public static function cutHtmlContent($content,$number){
		$result = array();
//		$content = str_replace(array('<div>','</div>'), '', $content);
		$totalWords = mb_strlen($content,'utf8');//总字数 中文3个，英文1个
		if($totalWords < 0 || $number < 0) return $result;
		$start = 0;
		while ($start < $totalWords){
			$strl = XUtils::_checkHtmlContent($content, $start, $number);
			$result[] = $strl;
			$start += mb_strlen($strl,'utf8');
		}
		return $result;
	}

	/**
	 * 
	 * html字符切割
	 * @param $content 内容
	 * @param $start 开始位置
	 * @param $number 字数
	 */
	private function _checkHtmlContent($content, $start, $number){

		$total = mb_strlen($content,'utf8');
		if($total <= $number) return $content;
		$label = array(array('<','>'), array('<p','</p>'));//防止被切割的标签，文章内容暂时使用这俩个
	    $str = mb_substr($content, $start, $number,'utf8');
		foreach ($label as $value){
		    $leftCount = mb_substr_count($str, $value[0],'utf8');//单个标签
		    $rightCount = mb_substr_count($str, $value[1],'utf8');
		    //标签数量不一致时，清除多余标签
		    if($leftCount > $rightCount){
		    	$lastLeftCount = mb_strripos($str, $value[0], 0,'utf8');//往前获取
		    	$str = mb_substr($content, $start, $lastLeftCount,'utf8');
		    }
		}
		//往后获取
//		if(!$str) $str = XUtils::_checkHtmlContent($content, $start, $number+1000);
		if(!$str){
			$number = $total - $start;
			return mb_substr($content, $start, $number,'utf8');;
		}
		return $str;
	}
        
}

?>