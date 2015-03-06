<?php

class DefaultController extends XController {

    public function init() {
        parent::init();
    }


    public function filters() {
        if (Yii::app()->params['allowCache'] == 'Y') {

        }
    }

    public function actionIndex() {
        echo date('Y-m-d H:i:s');
    }
    public function actionMe() {
        echo 'me';
    }



}
