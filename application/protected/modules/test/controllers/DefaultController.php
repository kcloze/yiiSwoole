<?php

class DefaultController extends XController
{
	public function actionIndex()
	{
		echo 123;
		$this->render('index');
	}
}