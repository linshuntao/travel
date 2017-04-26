<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 20:59
 */
class BaseDataController extends CController
{
    //加载界面
    public function actionIndex()
    {
        $type='';
        $cityData=[
            'name'=>'',
        ];
        $this->renderPartial('index',['type'=>$type,'cityData'=>$cityData]);
    }
    //接收搜索词
    public function actionSearch()
    {
        $city=Yii::app()->request->getParam('searchWord');
        if($city!=''){
            $cityData=TravelCityData::getCityBaseData($city);
            $this->renderPartial('index',['type'=>1,'cityData'=>$cityData]);
        }else{
            $type='';
            $cityData=[
                'name'=>'',
            ];
            $this->renderPartial('index',['type'=>$type,'cityData'=>$cityData]);
        }
    }
}
