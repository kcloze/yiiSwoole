<?php

class DefaultController extends XController
{

    public function init()
    {
        parent::init();
    }

    public function filters()
    {
        if (Yii::app()->params['allowCache'] == 'Y') {

        }
    }

    public function actionIndex()
    {
        echo date('Y-m-d H:i:s');
        exitYiiSwoole("Greet, kcloze!");
    }
    public function actionMe()
    {
        echo 'me';
    }

}
