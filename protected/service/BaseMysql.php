<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/16
 * Time: 21:40
 */
class BaseMysql
{
    /**
     * 列表数据
     */
    public static function getTableList($table = '', $select = '*', $condition = '', $params = array(), $order = '', $limit = '', $offset = '', $group = '', $join = array())
    {
        $command = Yii::app()->db->createCommand();
        $command->select($select);
        $command->from($table);
        if ($join) {
            $leftJoin = array();
            if (is_array($join[0])) {
                $leftJoin = $join;
            } else {
                $leftJoin[] = $join;
            }
            foreach ($leftJoin as $val) {
                $command->leftJoin($val[0], $val[1]);
            }
        }
        if ($condition) {
            if ($params) {
                $command->where($condition, $params);
            } else {
                $command->where($condition);
            }
        }
        if ($limit) {
            $command->limit($limit);
            if ($offset) {
                $command->offset($offset);
            }
        }
        if ($group) {
            $command->group($group);
        }
        if ($order) {
            $command->order = $order;
        }
        $result = $command->queryAll();
        return $result;
    }

    /**
     * 单条数据
     */
    public static function getTableItem($table = '', $select = '*', $condition = '', $params = array(), $order = '')
    {
        $command = Yii::app()->db->createCommand();
        $command->select($select);
        $command->from($table);
        if ($condition) {
            if ($params) {
                $command->where($condition, $params);
            } else {
                $command->where($condition);
            }
        }
        if ($order) {
            $command->order = $order;
        }
        $result = $command->queryRow();
        return $result;
    }
}
