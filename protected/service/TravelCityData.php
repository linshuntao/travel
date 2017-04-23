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
}