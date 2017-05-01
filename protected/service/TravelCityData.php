<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 21:41.
 */
class TravelCityData
{
    public static function getCityBaseData($cityName)
    {
        $cityData = Common::getTableItem('viewdata', '*', "name like '%" . $cityName . "%'");

        return $cityData;
    }

    public static function getFoodData($cityName, $offset, $limit, $isCount = 0)
    {
        if ($isCount) {
            $count = Common::getTableItem('foods', 'count(id) as count', "location like '%" . $cityName . "%'");

            return $count['count'];
        }
        $foodData = Common::getTableList('foods', '*', "location like '%" . $cityName . "%'", [], '', $limit, $offset);

        //去除文字描述中的标签
        if ($foodData) {
            foreach ($foodData as $key => $v) {
                $foodData[$key]['content'] = substr($v['content'], 0, strpos($v['content'], '<'));
            }

            return $foodData[0];
        }
    }

    public static function getRemarkData($cityName, $offset, $limit, $isCount = 0)
    {
        if ($isCount) {
            $count = Common::getTableItem('remark', 'count(id) as count', "location like '%" . $cityName . "%'");

            return $count['count'];
        }
        $remarkData = Common::getTableList('remark', '*', "location like '%" . $cityName . "%'", [], 'highScore DESC', $limit, $offset);

        //去除评论内容中的超链接
        if ($remarkData) {
            foreach ($remarkData as $key => $v) {
                $remarkData[$key]['remarkText'] = strip_tags($v['remarkText']);
            }

            return $remarkData;
        }
    }

    public static function getPictureData($cityName, $offset, $limit, $isCount = 0)
    {
        if ($isCount) {
            $count = Common::getTableItem('picture', 'count(id) as count', "location like '%" . $cityName . "%'");

            return $count['count'];
        }
        $pictureData = Common::getTableList('picture', '*', "location like '%" . $cityName . "%'", [], '', $limit, $offset);

        return $pictureData;
    }
}
