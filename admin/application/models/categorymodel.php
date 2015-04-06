<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categoryModel extends MY_Model {
    /*取商品分类列表*/
    public function getGoodsCategoryList(){
        $sqlInfo = array(
            'fields'    => array(
                'cat_id',
                'cat_real_id',
                'cat_name',
                'cat_id',
                'sort',
            ),
            'table'     => 'category',
            'where'     => array('cat_type = 1'),
            'order'     => array('cat_real_id asc'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*取分类列表*/
    public function getList($type = ''){
        //00002 是信息的总类目ID 00001是商品的总类目ID
        $type = ($type == 2)?'00001':'00002';
        $sqlInfo = array(
            'fields'    => array(
                'cat_id',
                'cat_real_id',
                'cat_name',
                'cat_id',
                'sort',
            ),
            'table'     => 'category',
            'where'     => array('cat_real_id like "'.$type.'%"'),
            'order'     => array('cat_real_id asc'),
        );

        //如果type为空，取所有分类
        $sqlInfo['where']       = (empty($type))?array():$sqlInfo['where'];

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreSelect();
        return $list;

    }

    /*根据partId获得最大子类的真实ID值*/
    public function bigistRealId($partId=0){
        $sqlInfo = array(
            'fields'    => array(
                'cat_real_id',
            ),
            'table'     => 'category',
            'where'     => array(),
            'order'     => array('cat_real_id desc'),
            'limit'     => '0,1',
        );
        if($partId != 0){
            $sqlInfo['where'] = array(
                'cat_real_id like "'.$partId.'%"',
            );
        }

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreSelect();
        if(empty($list[0])){
            return array();
        }else{
            return $list[0];
        }
    }

    /*根据partId获得真实ID值*/
    public function getRealId($partId=0){
        $sqlInfo = array(
            'fields'    => array(
                'cat_real_id',
            ),
            'table'     => 'category',
            'where'     => array(),
        );
        if($partId != 0){
            $sqlInfo['where'] = array(
                'cat_id="'.$partId.'"',
            );
        }

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreSelect();
        return $list[0];
    }

    /*获取分类的详细信息*/
    public function getCatInfo($cat_id=0){
        $sqlInfo = array(
            'fields'    => array(
                'cat_id',
                'cat_real_id',
                'cat_name',
                'cat_name_en',
                'goods_sku_key_id',
                'cat_type',
                'is_rmd',
                'is_show',
                'sort',
            ),
            'table'     => 'category',
            'where'     => array(
                'cat_id = "'.$cat_id.'"',
            ),
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreSelect();
        return $list[0];
    }

    /*分类插入数据库*/
    public function insertCategory($inData){
        $sqlInfo = array(
            'fields'    => $inData,
            'table'     => 'category',
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreInsert();
        return $list;
    }

    /*更新数据库*/
    public function updateCategory($inData,$cat_id){
        $sqlInfo = array(
            'fields'    => $inData,
            'table'     => 'category',
            'where'     => array(
                'cat_id = "'.$cat_id.'"',
            ),
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreUpdate();
        return $list;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */