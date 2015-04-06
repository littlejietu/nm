<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GoodsModel extends MY_Model
{
    /*获取评论赞数*/
    public function addReviewZanNum($reviewZanNum, $reviewId)
    {
        $sqlInfo = array(
            'fields' => array(
                'review_zan_num' => $reviewZanNum,
            ),
            'table' => 'goods_review',
            'where' => array(
                'review_id="' . $reviewId . '"',
            )
        );

        $this->CoreUpdate($sqlInfo);
    }

    /*获取评论赞数*/
    public function getReviewZanNum($reviewId)
    {
        $sqlInfo = array(
            'fields' => array(
                'review_zan_num',
            ),
            'table' => 'goods_review',
            'where' => array(
                'review_id="' . $reviewId . '"',
            )
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? 0 : $list[0]->review_zan_num;
    }

    /*取商品评论总数*/
    public function getGoodsReviewNum($goodsId)
    {
        $sqlInfo = array(
            'fields' => array(
                'count(review_id) as num',
            ),
            'table' => 'goods_review',
            'where' => array(
                'goods_id="' . $goodsId . '"',
            )
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? 0 : $list[0]->num;
    }

    /*取全部商品评论*/
    public function getGoodsReviewListAll($goodsId)
    {
        $sqlInfo = array(
            'table' => 'goods_review',
            'where' => array(
                'goods_id="' . $goodsId . '"',
            ),
            'order' => array(
                'is_cream desc,last_update desc'
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*分页取商品评论*/
    public function getGoodsReviewList($goodsId, $page, $perPage)
    {
        $sqlInfo = array(
            'table' => 'goods_review',
            'where' => array(
                'goods_id="' . $goodsId . '"',
            ),
            'order' => array(
                'is_cream desc,last_update desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*取热卖商品*/
    public function getHotGoodsList()
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'cat_id',
                'goods_sn',
                'goods_name',
                'shop_price',
                'goods_thumb',
                'goods_intro',
                'goods_num',
            ),
            'table' => 'goods',
            'where' => array(
                'is_hot=1',
                'is_delete=0',
                'is_on_sale=1',
            ),
            'order' => array(
                'last_update desc'
            ),
            'limit' => '0,100',
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*取推荐商品*/
    public function getRmdGoodsList()
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'cat_id',
                'goods_sn',
                'goods_name',
                'shop_price',
                'goods_thumb',
                'goods_intro',
                'goods_num',
                'goods_sell_num',
            ),
            'table' => 'goods',
            'where' => array(
                'is_rmd=1',
                'is_delete=0',
                'is_on_sale=1',
            ),
            'order' => array(
                'last_update desc'
            ),
            'limit' => '0,100',
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*取新品商品*/
    public function getNewGoodsList()
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'cat_id',
                'goods_sn',
                'goods_name',
                'shop_price',
                'goods_thumb',
                'goods_intro',
                'goods_num',
            ),
            'table' => 'goods',
            'where' => array(
                'is_new=1',
                'is_delete=0',
                'is_on_sale=1',
            ),
            'order' => array(
                'last_update desc'
            ),
            'limit' => '0,100',
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*根据条件取值
     * $where  条件 数组
     * $limit  条数
    */
    public function getList($where, $limit = 6)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'goods_name',
                'shop_price',
                'goods_thumb',
                'goods_intro',
            ),
            'table' => 'goods',
            'where' => $where,
            'order' => array(
                'last_update desc'
            ),
            'limit' => $limit,
        );
        $list = $this->CoreSelect($sqlInfo);

        if (!empty($list)) //判断数组是否为空
        {
            foreach ($list as $key => $value) {
                $list[$key]->goods_short_name = mb_substr($value->goods_name, 0, 12, 'utf-8'); //截取标题
                $list[$key]->goods_short_intro = mb_substr($value->goods_intro, 0, 12, 'utf-8'); //截取说明
                $list[$key]->shop_price_money = number_format($value->shop_price, 2); //价格转换成金钱格式
            }
        } else {
            return array();
        }

        return $list;
    }

    /*取商品详细信息*/
    public function getGoodsInfo($goodsId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'goods_name',
                'cat_id',
                'shop_price',
                'goods_sn',
                'goods_thumb',
                'goods_intro',
                'goods_num',
                'goods_parm',
                'goods_detail',
            ),
            'table' => 'goods',
            'where' => array(
                'goods_id="' . $goodsId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0];
    }

    /*取商品详细信息*/
    public function getGoodsInfoIn($goodsId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',     //主键ID
                'goods_name',   //产品名称
                'cat_id',       //分类ID
                'shop_price',   //产品金额
                'goods_sn',     //货号
                'goods_thumb',  //商品缩略图
                'goods_intro',  //商品简介
                'cat_id',
            ),
            'table' => 'goods',
            'where' => array(
                'goods_id in(' . $goodsId . ')',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list;
    }

    /*根据属性值的ID取得属性值*/
    public function getSearchSkuValue($skuValueId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_value',
            ),
            'table' => 'goods_sku_value',
            'where' => array(
                'goods_sku_value_id="' . $skuValueId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0]->goods_sku_value;
    }

    /*根据属性的ID取得属性的名称*/
    public function getSearchSkuKey($skuId)
    {
        $sqlInfo = array(
            'fields' => array(
                'sku_key',
            ),
            'table' => 'goods_sku_key',
            'where' => array(
                'goods_sku_key_id="' . $skuId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0]->sku_key;
    }

    /*根据属性的ID取得属性的名称*/
    public function getSkuKey($skuId)
    {
        $sqlInfo = array(
            'fields' => array(
                'sku_key',
            ),
            'table' => 'goods_sku_key',
            'where' => array(
                'goods_sku_key_id="' . $skuId . '"',
                'is_show=1',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0]->sku_key;
    }

    /*获取分类的详细信息*/
    public function getCatInfo($cat_id=0){
        $sqlInfo = array(
            'fields'    => array(
                'goods_sku_key_id',
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

    /*根据goods_id\color\size\skuvalue 取商品SKU*/
    public function getGoodsSkuInfo($goodsId, $skuColorId, $skuSizeId, $skuValueId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_id',
                'goods_id',
                'goods_thumb',
                'sku_key_id',
                'sku_value_id',
                'sku_color_id',
                'sku_size_id',
                'sku_weight',
                'sku_price',
            ),
            'table' => 'goods_sku',
            'where' => array(
                'goods_id = "' . $goodsId . '"',
                'sku_color_id = "' . $skuColorId . '"',
                'sku_size_id = "' . $skuSizeId . '"',
                'sku_value_id = "' . $skuValueId . '"',
                'sku_number > 0',
            ),
            'order' => array(
                'sort desc'
            )
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list[0];
    }

    /*根据商品ID数组 取所有属性集合*/
    public function getGoodsSkuListFromGoodsIdArr($goodsIdArr = array())
    {
        $goodsIds = implode(',', $goodsIdArr);
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_id',
                'goods_id',
                'goods_thumb',
                'sku_key_id',
                'sku_value_id',
                'sku_color_id',
                'sku_size_id',
                'sku_number',
            ),
            'table' => 'goods_sku',
            'where' => array(
                'goods_id in (' . $goodsIds . ')',
                'sku_number > 0',
            ),
            'order' => array(
                'sort desc'
            )
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*获取品牌列表*/
    public function getBrandList($brandIdArr = array(), $type = '', $is_rmd = '', $limit = '')
    {
        $sqlInfo = array(
            'fields' => array(
                'brand_id',
                'brand_name',
                'brand_img',
                'add_time',
            ),
            'table' => 'brand',
            'where' => array(),
            'limit' => $limit,
        );

        if (!empty($brandIdArr)) { //主键ID
            $brandIds = implode(',', $brandIdArr);
            $sqlInfo['where'] = array(
                'brand_id in (' . $brandIds . ')',
            );
        }
        if (!empty($is_rmd)) { //推荐
            $sqlInfo['where'][] = 'is_rmd = ' . $is_rmd . '';
        }
        if (!empty($type)) { //类型
            $sqlInfo['where'][] = 'brand_type = ' . $type . '';
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*取热门类别*/
    public function getHotCategory()
    {
        $sqlInfo = array(
            'fields' => array(
                'cat_id',
                'cat_real_id',
                'cat_name',
                'cat_name_en',
            ),
            'table' => 'category',
            'where' => array(
                'cat_type = "1"',
                'is_rmd = "1"',
                'is_show = "1"',
            ),
            'order' => array(
                'sort desc'
            )
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*按条件取指定分类下的商品数量*/
    public function getGoodsNum($classId, $search = array())
    {
        $sqlInfo = array(
            'fields' => array('count(goods_id) as num'),
            'table' => 'goods',
        );
        if (empty($search)) {
            $sqlInfo['where'] = array('cat_id in (' . $classId . ')');
        } else {
            array_push($search, 'cat_id in (' . $classId . ')');
            $sqlInfo['where'] = $search;
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list[0]->num;
    }

    /*取当前页商品*/
    public function getGoodsListFromPage($classId, $page, $perPage, $search = array())
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'cat_id',
                'goods_sn',
                'goods_name',
                'shop_price',
                'goods_thumb',
                'goods_intro',
                'goods_num',
            ),
            'table' => 'goods',
            'where' => array(
                'cat_id in (' . $classId . ')',
                'is_on_sale = 1',
                'is_delete = 0'
            ),
            'groupby' => '',
            'order' => array(
                'sort desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        /*搜索商品添加搜索条件*/
        if (!empty($search)) {
            array_push($search, 'cat_id in (' . $classId . ')');
            array_push($search, 'is_on_sale = 1');
            array_push($search, 'is_delete = 0');
            $sqlInfo['where'] = $search;
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据产品分类ID获取分类信息*/
    public function getgoodsbrandid($catid = 1)
    {
        $sqlInfo = array(
            'fields' => array(
                'brand_id',
            ),
            'table' => 'goods',
            'where' => array(
                'cat_id = "' . $catid . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*根据分类ID去品牌信息*/
    public function getbrandinfo($brandid)
    {
        $sqlInfo = array(
            'fields' => array(
                'brand_id',
                'brand_name',
                'brand_img',
            ),
            'table' => 'brand',
            'where' => array(
                'brand_id in(' . $brandid . ')',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*
 * 根据条件获取信息
 * $goodsid-产品ID
 * */
    public function getGoodPhoto($goodsid = '')
    {
        $sqlInfo = array(
            'fields' => array(
                'photo_id',
                'goods_id',
                'photo_image',
                'sort',
            ),
            'table' => 'goods_photo',
            'where' => array(
                'goods_id="' . $goodsid . '"',
            ),
            'order' => array(
                'sort asc',
                'last_update desc',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*产品预售记录*/
    public  function addGoodsSale($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'goods_sale',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

}

/* End of file goodsmodel.php */
/* Location: ./application/model/goodsmodel.php */