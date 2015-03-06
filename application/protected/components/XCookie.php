<?php
/**
 * Cookies工具
 * 
 * 
 * 
 * 
 * Tools
 * 
 * 
 */

class XCookie
{
    /**
	 * 设置cookie
	 * name 名称
	 * value 值
	 * expire 保存时间
	 * path 路径
	 * domain 域
	 */
    public static function set ($name = '', $value = '', $expire = 3600, $path = '', $domain = '', $secure = false,$httpOnly=false)
    {
        $cookieSet = new CHttpCookie($name, $value);
        //echo date('Y-m-d H:i:s');
        //echo $expire;
        $expire && $cookieSet->expire = $expire;
        $path && $cookieSet->path = $path;
        $domain && $cookieSet->domain = $domain;
        $secure && $cookieSet->secure = $secure;
        $httpOnly && $cookieSet->httpOnly = $httpOnly;
        Yii::app()->request->cookies[$name] = $cookieSet;
    }

    /**
	 * 获取cookie
	 * once 只取一次后删除值
	 */
    public static function get ($name, $once = false)
    {
        $cookie = Yii::app()->request->getCookies();
        $data = $cookie[$name]->value;
        if ($once)
            unset($cookie[$name]);
        return $data;
    }

    /**
     * 清理cookie
     * @param unknown_type $name
     */
    public static function remove ($name)
    {
        $cookie = Yii::app()->request->getCookies();
        unset($cookie[$name]);  
    }

}

?>