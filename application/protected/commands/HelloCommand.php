<?php
class HelloCommand extends CConsoleCommand
{

   public function actionTest(){
        echo time().'<br>';
        echo dechex(time());exit;
        //var_dump($data);exit;
   }
   
}