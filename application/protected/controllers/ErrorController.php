<?php
/**
 * 错误信息显示
 * 
 * 
 * 
 * 
 * Controller
 * 
 * 
 */

class ErrorController extends XController
{
    public $layout = false;
    /**
     * 错误信息显示页
     */
    public function actionIndex ()
    {  
        if ($error = Yii::app()->errorHandler->error) {
            var_dump($error);
        }
    }

}