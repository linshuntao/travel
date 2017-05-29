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
        $searchCity = TravelCityData::getMaxSerachCity();
        $type       = 0;
        $cityName   = '';
        $cityData   = [
            'name' => '',
        ];
        $this->renderPartial('index', ['type' => $type, 'cityName' => $cityName, 'cityData' => $cityData, 'searchCity' => $searchCity]);
    }
    //接收搜索词,展示基础信息
    public function actionSearch()
    {
        $city = Yii::app()->request->getParam('searchWord');
        if ($city != '') {
            $cityData   = TravelCityData::getCityBaseData($city);
            $searchCity = TravelCityData::getMaxSerachCity();

            if (isset($cityData['id'])) {
                $this->renderPartial('index', ['type' => 1, 'cityName' => $city, 'cityData' => $cityData, 'searchCity' => $searchCity]);
            } else {
                $this->redirect(['baseData/index']);
            }

        } else {
            $this->redirect(['baseData/index']);
        }
    }

    //展示美食信息
    public function actionFood()
    {
        $cityName = Yii::app()->request->getParam('cityName');
        if ($cityName) {
            $count = TravelCityData::getFoodData($cityName, '', '', 1);
            //翻页
            $pages           = new CPagination($count);
            $pages->pageSize = 1;
            $limit           = $pages->pageSize;
            $offset          = $pages->currentPage * $pages->pageSize;

            $foodData   = TravelCityData::getFoodData($cityName, $offset, $limit, 0);
            $searchCity = TravelCityData::getMaxSerachCity();

            $this->renderPartial('index', ['type' => 2, 'cityName' => $cityName, 'foodData' => $foodData, 'pages' => $pages, 'searchCity' => $searchCity]);
        } else {
            $this->redirect(['baseData/index']);
        }

    }

    //展示游客评论
    public function actionRemark()
    {
        $data['cityName']   = Yii::app()->request->getParam('cityName');
        $data['searchWord'] = Yii::app()->request->getParam('searchWord');

        if ($data) {
            $count = TravelCityData::getRemarkData($data, '', '', 1);

            //翻页
            $pages           = new CPagination($count);
            $pages->pageSize = 5;
            $limit           = $pages->pageSize;
            $offset          = $pages->currentPage * $pages->pageSize;

            $remarkData = TravelCityData::getRemarkData($data, $offset, $limit, 0);
            $searchCity = TravelCityData::getMaxSerachCity();

            $this->renderPartial('index', ['type' => 3, 'cityName' => $data['cityName'], 'searchWord' => $data['searchWord'], 'remarkData' => $remarkData, 'pages' => $pages, 'searchCity' => $searchCity]);
        } else {
            $this->redirect(['baseData/index']);
        }
    }

    //展示精选图片
    public function actionPicture()
    {
        $cityName = Yii::app()->request->getParam('cityName');
        if ($cityName) {
            $count = TravelCityData::getPictureData($cityName, '', '', 1);
            //翻页
            $pages           = new CPagination($count);
            $pages->pageSize = 20;
            $limit           = $pages->pageSize;
            $offset          = $pages->currentPage * $pages->pageSize;

            $pictureData = TravelCityData::getPictureData($cityName, $offset, $limit, 0);
            $searchCity  = TravelCityData::getMaxSerachCity();

            $this->renderPartial('index', ['type' => 4, 'cityName' => $cityName, 'pictureData' => $pictureData, 'pages' => $pages, 'searchCity' => $searchCity]);
        } else {
            $this->redirect(['baseData/index']);
        }
    }

    //著名景点
    public function actionSign()
    {
        $data['cityName']      = Yii::app()->request->getParam('cityName');
        $data['searchTitle']   = Yii::app()->request->getParam('searchTitle');
        $data['searchContent'] = Yii::app()->request->getParam('searchContent');

        if ($data) {
            $signData    = TravelCityData::getSignData($data['cityName']);
            $pages       = '';
            $singPicData = '';
            if ($data['searchTitle'] != '') {
                $count = TravelCityData::getSignPicData($data, '', '', 1);

                //翻页
                $pages           = new CPagination($count);
                $pages->pageSize = 5;
                $limit           = $pages->pageSize;
                $offset          = $pages->currentPage * $pages->pageSize;

                $singPicData = TravelCityData::getSignPicData($data, $offset, $limit, 0);
            }
            if ($data['searchContent'] != '') {
                $count = TravelCityData::getContentPicData($data, '', '', 1);

                //翻页
                $pages           = new CPagination($count);
                $pages->pageSize = 5;
                $limit           = $pages->pageSize;
                $offset          = $pages->currentPage * $pages->pageSize;

                $singPicData = TravelCityData::getContentPicData($data, $offset, $limit, 0);
            }
            $searchCity = TravelCityData::getMaxSerachCity();

            $this->renderPartial('index', ['type' => 5, 'cityName' => $data['cityName'], 'searchTitle' => $data['searchTitle'], 'searchContent' => $data['searchContent'], 'signData' => $signData, 'signPicData' => $singPicData, 'pages' => $pages, 'searchCity' => $searchCity]);
        } else {
            $this->redirect(['baseData/index']);
        }
    }

}
