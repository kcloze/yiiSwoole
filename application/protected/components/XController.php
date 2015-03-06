<?php
/**
 * 控制器基类，前端，后端均需继承此类
 * 
 * 
 * 
 * 
 * Controller
 * 
 * 
 */

class XController extends CController
{
    protected $_gets;
    protected $_baseUrl;
    protected $_user_info;
    protected $_static_version;

    /**
	 * 初始化
	 * @see CController::init()
	 */
    public function init ()
    {
        
        $this->_gets = Yii::app()->request;
        $this->_baseUrl = Yii::app()->baseUrl;
        $this->_static_version= '1.887';
    }

}