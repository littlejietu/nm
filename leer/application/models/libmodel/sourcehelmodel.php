<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SourceHelModel extends MY_Model {
    /*通过分类的ID取得子分类ID的集合*/
    public function getChildClassModel($classId){
        $sqlInfo = array(
            'fields'    => array(
                'cat_id',
            ),
            'table'     => 'category',
            'where'     => array('cat_real_id like "'.$classId.'%"'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*通过分类的ID取得分类的详细信息*/
    public function getClassInfoModel($classId){
        $sqlInfo = array(
            'fields'    => array(
                '*',
            ),
            'table'     => 'category',
            'where'     => array('cat_id="'.$classId.'"'),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*通过分类的ID取得分类的详细信息*/
    public function getBrandInfoModel($classId){
        $sqlInfo = array(
            'fields'    => array(
                '*',
            ),
            'table'     => 'brand',
            'where'     => array('brand_id="'.$classId.'"'),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*通过分类的ID取得分类的详细信息*/
    public function getChannelInfoModel($classId){
        $sqlInfo = array(
            'fields'    => array(
                '*',
            ),
            'table'     => 'channel',
            'where'     => array('channel_id="'.$classId.'"'),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }
}

/**
 * Created by PhpStorm.
 * User: yc
 * Date: 14-10-27
 * Time: 下午11:34
 */ 