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
        $type=0;
        $cityData=[
            'name'=>'',
        ];
        $this->renderPartial('index',['type'=>$type,'cityData'=>$cityData]);
    }
    //接收搜索词,展示基础信息
    public function actionSearch()
    {
        $city=Yii::app()->request->getParam('searchWord');
        if($city!=''){
            $cityData=TravelCityData::getCityBaseData($city);
            $this->renderPartial('index',['type'=>1,'cityName'=>$city,'cityData'=>$cityData]);
        }else{
            $type=0;
            $cityData=[
                'name'=>'',
            ];
            $this->renderPartial('index',['type'=>$type,'cityData'=>$cityData]);
        }
    }

    //展示美食信息
    public function actionFood()
    {
        $cityName=Yii::app()->request->getParam('cityName');
        if($cityName){
            $foodData=TravelCityData::getFoodData($cityName);
            $this->renderPartial('index',['type'=>2,'cityName'=>$cityName,'foodData'=>$foodData]);
        }
    }

}
