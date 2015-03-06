<?php
/**
 * 静态参数
 * 
 * 
 * 
 * 
 * Tools
 * 
 * 
 */

class XParams{
	static $adminiLoggerType = array('login'=>'登录','create'=>'录入','delete'=>'删除','update'=>'编辑');
	static $attrScope = array('post'=>'内容','config'=>'系统配置','page'=>'单页','area'=>'地域','special'=>'专题');
	static $attrItemType = array('input'=>'文本输入','select'=>'下拉选择','checkbox'=>'多选','textarea'=>'大段内容','radio'=>'单选','text'=>'富文本内容');
	/**
	 * 取参数值
	 */
	static public function get($val, $type){
		switch ($type) {
			case 'adminiLoggerType': return self::$adminiLoggerType[$val]; break;
			default: break;
		}
	}
}
