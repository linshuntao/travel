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
    public static $color = [
        0 => 'red',
        1 => 'yellow',
        2 => "blue",
        3 => 'green',
        4 => 'black',
    ];
    public static function getCityBaseData($cityName)
    {
        $cityData = Common::getTableItem('viewdata', '*', "name like '%" . $cityName . "%'");
        $data     = Common::getTableItem('view', '*', "name like '%" . $cityName . "%'");
        Yii::app()->db->createCommand()->update('view', ['searchCount' => (int) $data['searchCount'] + 1], 'id=:id', [':id' => $data['id']]);

        //标签转成数组
        $cityData['tags'] = explode(",", $cityData['tags']);

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

    public static function getRemarkData($data, $offset, $limit, $isCount = 0)
    {
        if ($isCount) {
            if ($data['searchWord']) {
                $count = Common::getTableItem('remark', 'count(id) as count', "location like '%" . $data['cityName'] . "%' AND remarkText like '%" . $data['searchWord'] . "%'");
            } else {
                $count = Common::getTableItem('remark', 'count(id) as count', "location like '%" . $data['cityName'] . "%'");
            }

            return $count['count'];
        }
        if ($data['searchWord']) {
            $remarkData = Common::getTableList('remark', '*', "location like '%" . $data['cityName'] . "%' AND remarkText like '%" . $data['searchWord'] . "%'", [], 'highScore DESC', $limit, $offset);
        } else {
            $remarkData = Common::getTableList('remark', '*', "location like '%" . $data['cityName'] . "%'", [], 'highScore DESC', $limit, $offset);
        }

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

    public static function getSignData($cityName)
    {
        $signData = Common::getTableList('userpic', 'count(id) as count,title', "name like '%" . $cityName . "%' AND picDesc!='' AND title!=''", [], '', '', '', 'title');
        $finData  = [];
        arsort($signData);
        foreach ($signData as $v) {
            if ($v['count'] >= 50) {
                $finData[] = [
                    'title' => $v['title'],
                    'count' => $v['count'],
                ];
            }
        }
        return $finData;
    }

    public static function getSignPicData($data, $offset, $limit, $isCount = 0)
    {
        if ($isCount) {
            $count = Common::getTableItem('userpic', 'count(id) as count', "name like '%" . $data['cityName'] . "%' AND title like '%" . $data['searchTitle'] . "%'");
            return $count['count'];
        }
        $picData = Common::getTableList('userpic', '*', "name like '%" . $data['cityName'] . "%' AND title like '%" . $data['searchTitle'] . "%'", [], '', $limit, $offset);
        foreach ($picData as $key => $v) {
            $picData[$key]['picUrl'] = stripslashes($v['picUrl']);
        }

        return $picData;
    }

    public static function getContentPicData($data, $offset, $limit, $isCount = 0)
    {
        if ($isCount) {
            $count = Common::getTableItem('userpic', 'count(id) as count', "name like '%" . $data['cityName'] . "%' AND picDesc like '%" . $data['searchContent'] . "%'");
            return $count['count'];
        }
        $picData = Common::getTableList('userpic', '*', "name like '%" . $data['cityName'] . "%' AND picDesc like '%" . $data['searchContent'] . "%'", [], '', $limit, $offset);
        foreach ($picData as $key => $v) {
            $picData[$key]['picUrl'] = stripslashes($v['picUrl']);
        }

        return $picData;
    }

    public static function updateCityTag()
    {
        ini_set('memory_limit', '512M');
        $cityName = Common::getTableList('view', 'id,name');
        foreach ($cityName as $key => $v) {
            $remarkText = Common::getTableList('remark', 'remarkText', "location like '%" . $v['name'] . "%'");
            $content    = '';
            foreach ($remarkText as $value) {
                $content .= strip_tags($value['remarkText']);
            }

            PhpAnalysis::$loadInit = false;
            $pa                    = new PhpAnalysis('utf-8', 'utf-8', false);
            $pa->LoadDict();
            $pa->SetSource($content);
            $pa->StartAnalysis(true);

            $tags = $pa->GetFinallyKeywords(20);

            Yii::app()->db->createCommand()->update('viewdata', ['tags' => $tags], 'id=' . $v['id']);
            echo $key . ' ';
        }
    }

    public static function updateCityMonth()
    {
        ini_set('memory_limit', '512M');
        $cityName = Common::getTableList('view', 'id,name');

        $month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        foreach ($cityName as $key => $value) {
            $cityData = [
                'month'    => [],
                'aveMonth' => [],
            ];
            foreach ($month as $v) {
                $count                  = Common::getTableItem('remark', 'count(id) as count', 'location=\'' . $value['name'] . '\' AND remarkTime like \'%-' . $v . '-%\'');
                $aveCount               = Common::getTableItem('remark', 'count(id) as count', 'remarkTime like \'%-' . $v . '-%\'');
                $cityData['month'][]    = $count['count'];
                $cityData['aveMonth'][] = (int) ($aveCount['count'] / 12);
            }

            $cityData['month']    = implode(',', $cityData['month']);
            $cityData['aveMonth'] = implode(',', $cityData['aveMonth']);

            Yii::app()->db->createCommand()->update('viewdata', ['month' => $cityData['month']], 'id=' . $value['id']);
            Yii::app()->db->createCommand()->update('viewdata', ['aveMonth' => $cityData['aveMonth']], 'id=' . $value['id']);
            echo $key . ' ';
        }

    }
}
