<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 20:59
 */
class BaseDataController extends CController
{
    public function actionIndex()
    {
        $this->render('index');
    }
}
