<?php
require_once './protected/extension/phpanalysis/phpanalysis.class.php';
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
        ini_set('memory_limit', '512M');
        $cityData = Common::getTableItem('viewdata', '*', "name like '%" . $cityName . "%'");
        $data     = Common::getTableItem('view', '*', "name like '%" . $cityName . "%'");
        Yii::app()->db->createCommand()->update('view', ['searchCount' => (int) $data['searchCount'] + 1], 'id=:id', [':id' => $data['id']]);

//        $month=['01','02','03','04','05','06','07','08','09','10','11','12'];
        //        foreach($month as $v){
        //            $count=Common::getTableItem('remark','count(id) as count','location=\''.$cityName.'\' AND remarkTime like \'%-'.$v.'-%\'');
        //            $data['month'][]=$count['count'];
        //        }
        //        arsort($data['month']);

//        $remarkText = Common::getTableList('remark', 'remarkText', "location like '%" . $cityName . "%'");
        //
        //        $data = '';
        //        foreach ($remarkText as $v) {
        //            $data .= strip_tags($v['remarkText']);
        //        }
        //
        //        PhpAnalysis::$loadInit = false;
        //        $pa                    = new PhpAnalysis('utf-8', 'utf-8', false);
        //        $pa->LoadDict();
        //        $pa->SetSource($data);
        //        $pa->StartAnalysis(true);
        //
        //        $tags = $pa->GetFinallyKeywords(20);
        //        $arr  = $pa->GetFinallyIndex();
        //
        //        $tagsArr = explode(",", $tags);
        //        echo '<pre>';
        //        echo strlen($data);
        //        var_dump($tagsArr);
        //        var_dump($arr);die;
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

    public static function getMaxSerachCity()
    {
        $data = Common::getTableList('view', '*', '', [], 'searchCount DESC', 5, 0);

        return $data;
    }
}
