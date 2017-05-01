<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 21:41
 */
class TravelCityData
{
	public static function getCityBaseData($cityName)
	{
		$cityData=Common::getTableItem('viewdata','*',"name like '%".$cityName."%'");
		return $cityData;
	}

	public static function getFoodData($cityName)
	{
		$foodData=Common::getTableList('foods','*',"location like '%".$cityName."%'");

		//去除文字描述中的标签
		foreach($foodData as $key=>$v){

			$foodData[$key]['content']=substr($v['content'],0,strpos($v['content'],'<'));
		}

		return $foodData;
	}
}