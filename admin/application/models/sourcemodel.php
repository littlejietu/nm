<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SourceModel extends MY_Model
{
    /*根据商品ID或者属性ID查询商品相册*/
    public function getGoodsPhoto($goodsId = '', $goodsSkuId = '')
    {
        $sqlInfo = array(
            'fields' => array(
                'photo_id',
                'goods_id',
                'goods_sku_id',
                'photo_thumb',
                'photo_image',
                'sort',
            ),
            'table' => 'goods_photo',
            'where' => array(
                'goods_id="' . $goodsId . '"'
            ),
            'order' => array('sort desc'),
        );
        if (empty($goodsId)) { //如果商品ID为空 则取属性相册
            $sqlInfo['where'] = array(
                'goods_sku_id="' . $goodsSkuId . '"'
            );
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据会员ID 取该会员的快递方式*/
    public function getExpressFromUserId($userId)
    {
        /*2qi 按会员ID取值 一期取所有值*/
        $sqlInfo = array(
            'fields' => array(
                'express_id',
                'express_name',
            ),
            'table' => 'express',
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*删除运费信息*/
    public function delExpressCost($costId)
    {
        $sqlInfo = array(
            'table' => 'express_cost',
            'where' => array('cost_id = "' . $costId . '"',)
        );
        $this->CoreDelete($sqlInfo);
    }

    /*新增运费信息*/
    public function addExpressCost($expressId, $startProvinceId, $endProvinceId, $channelId)
    {
        $sqlInfo = array(
            'fields' => array(
                'express_id' => $expressId,
                'start_province_id' => $startProvinceId,
                'end_province_id' => $endProvinceId,
                'channel_id' => $channelId,
                'add_time' => time(),
                'last_update' => time(),
            ),
            'table' => 'express_cost',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*删除快递公司*/
    public function delExpress($id)
    {
        //删除所有用户关于该快递公司的运费记录
        $sqlInfo = array(
            'table' => 'express_cost',
            'where' => array('express_id = "' . $id . '"',)
        );
        $this->CoreDelete($sqlInfo);

        //删除快递公司
        $sqlInfo = array(
            'table' => 'express',
            'where' => array('express_id = "' . $id . '"',)
        );
        $this->CoreDelete($sqlInfo);
    }

    /*更新运费信息*/
    public function changeExpress($costId, $value, $act)
    {
        $sqlInfo = array(
            'fields' => array(
                'is_delete' => 1,
            ),
            'table' => 'express_cost',
            'where' => array(
                'cost_id = "' . $costId . '"',
            )
        );

        switch ($act) {
            case 'changeStartProvince': //修改出发省份信息
                $sqlInfo['fields'] = array('start_province_id' => $value);
                break;
            case 'changeEndProvince': //修改到达省份信息
                $sqlInfo['fields'] = array('end_province_id' => $value);
                break;
            case 'changeFirstHeightProvince': //修改首重重量信息
                $sqlInfo['fields'] = array('first_height' => $value);
                break;
            case 'changeLastHeightProvince': //修改续重重量信息
                $sqlInfo['fields'] = array('last_height' => $value);
                break;
            case 'changeFirstHeightCostProvince': //修改首重费用信息
                $sqlInfo['fields'] = array('first_height_cost' => $value);
                break;
            case 'changeLastHeightCostProvince': //修改续重费用信息
                $sqlInfo['fields'] = array('last_height_cost' => $value);
                break;
        }
        $this->CoreUpdate($sqlInfo);
    }

    /*根据商品Skuid查询商品的SKU信息*/
    public function getSkuFromSkuId($skuId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_id',
                'goods_id',
                'sku_key_id',
                'sku_value_id',
                'sku_color_id',
                'sku_size_id',
                'sku_weight',
                'sku_price',
                'sku_status',
                'goods_thumb',
                'sku_number',
                'sku_number_lock',
            ),
            'table' => 'goods_sku',
            'where' => array(
                'goods_sku_id="' . $skuId . '"'
            )
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据商品ID查询所有该商品的属性*/
    public function getSkuListFromGoodsId($goodsId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_id',
                'goods_id',
                'sku_key_id',
                'sku_value_id',
                'sku_color_id',
                'sku_size_id',
                'sku_weight',
                'sku_price',
                'sku_status',
                'goods_thumb',
                'sku_number',
            ),
            'table' => 'goods_sku',
            'where' => array(
                'goods_id="' . $goodsId . '"'
            ),
            'order' => array('add_time asc'),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*删除商品*/
    public function delGoods($goodsId)
    {
        //删除商品
        $sqlInfo = array(
            'fields' => array(
                'is_delete' => 1,
            ),
            'table' => 'goods',
            'where' => array(
                'goods_id = "' . $goodsId . '"',
            )
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*删除商品属性*/
    public function delGoodsSku($id)
    {
        //删除商品属性
        $sqlInfo = array(
            'table' => 'goods_sku_key',
            'where' => array('goods_sku_key_id = "' . $id . '"',)
        );
        $this->CoreDelete($sqlInfo);

        //删除属性下的属性值
        $sqlInfo = array(
            'table' => 'goods_sku_value',
            'where' => array('goods_sku_key_id = "' . $id . '"',)
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /*删除固定商品属性值*/
    public function delGoodsSkuValue($id)
    {
        //删除属性值
        $sqlInfo = array(
            'table' => 'goods_sku_value',
            'where' => array('goods_sku_value_id = "' . $id . '"',)
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /*添加编辑商品属性*/
    public function addGoodsSkuValue($arr, $type)
    {
        $sqlInfo = array(
            'fields' => $arr,
            'table' => 'goods_sku_value',
        );
        if ($type) {
            $sqlInfo['where'] = array('goods_sku_value_id = ' . $type);
            $list = $this->CoreUpdate($sqlInfo);
        } else {
            $list = $this->CoreInsert($sqlInfo);
        }
        return $list;
    }

    /*根据ID获取商品属性*/
    public function getGoodsSkuInfoKey($id)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_key_id',
                'sku_key',
                'add_time',
                'last_update',
                'is_show',
            ),
            'table' => 'goods_sku_key',
            'where' => array(
                'goods_sku_key_id = "' . $id . '"'
            )
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? $list : $list[0];
    }

    /*根据商品ID获取商品属性*/
    public function getGoodsSkuListOutOfDate($goodsId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_id',
                'goods_thumb',
            ),
            'table' => 'goods_sku',
            'where' => array(
                'goods_id = "' . $goodsId . '"'
            )
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
    }

    /*删除过期商品的属性*/
    public function delGoodsSkuOutOfDate($goodsSkuId)
    {
        $sqlInfo = array(
            'fields' => array(),
            'table' => 'goods_sku',
            'where' => array(
                'goods_sku_id = "' . $goodsSkuId . '"'
            )
        );
        $this->CoreDelete($sqlInfo);
    }

    /*根据ID获取商品属性值*/
    public function getGoodsSkuInfoValue($id)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_value_id',
                'goods_sku_key_id',
                'goods_sku_value',
                'add_time',
                'last_update',
                'is_show',
            ),
            'table' => 'goods_sku_value',
            'where' => array(
                'goods_sku_value_id = "' . $id . '"'
            )
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? $list : $list[0];

    }

    /*添加编辑商品属性*/
    public function addGoodsSku($arr, $type)
    {
        $sqlInfo = array(
            'fields' => $arr,
            'table' => 'goods_sku_key',
        );
        if ($type) {
            $sqlInfo['where'] = array('goods_sku_key_id = ' . $type);
            $list = $this->CoreUpdate($sqlInfo);
        } else {
            $list = $this->CoreInsert($sqlInfo);
        }
        return $list;
    }

    /*根据ID获取商品属性*/
    public function getGoodsSkuInfo($id)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_key_id',
                'sku_key',
                'sku_state',
                'add_time',
                'last_update',
                'is_show',
            ),
            'table' => 'goods_sku_key',
            'where' => array(
                'goods_sku_key_id = "' . $id . '"'
            )
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? $list : $list[0];

    }

    /*
     * 取当前页商品
       *$classId-分类ID、$goodsName-产品名称、$goodssn-货号、$isonsale-是否在售：1-正常、0停售、isdelete-是否删除：1-删除、0、正常、isrmd-是否推荐：0-正常、1推荐、brandid-品牌ID、brandauthorizeid-授权品牌ID
     * */
    public function getGoodsListFromPage($classId, $page, $perPage, $userLevel, $userChannelId = '', $goodsName = '',$goodssn='',$isonsale='',$isdelete='',$isrmd='',$brandid='',$brandauthorizeid='')
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'cat_id',
                'goods_sn',
                'goods_name',
                'market_price',
                'goods_thumb',
                'is_on_sale',
                'is_delete',
                'brand_id',
                'brand_authorize_id',
                'channel_id',
                'goods_sell_num', //产品销售数量
                'last_update',
            ),
            'table' => 'goods',
            'where' => array(),
            'groupby' => '',
            'order' => array(
                'goods_sn desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        /*根据用户权限取不同商品*/
        switch ($userLevel) {
            case 2:
                $sqlInfo['where'][] = 'is_delete = 0'; //普通管理员，不显示已删除的商品
                break;
            case 3:
                $sqlInfo['where'][] = 'is_delete = 0'; //渠道商，不显示已删除的商品
                if (!empty($userChannelId)) {
                    $sqlInfo['where'][] = 'channel_id = "' . $userChannelId . '"'; //渠道商，只显示自己的商品
                }
                break;
        }

        if (empty($goodsName)) { //判断关键字查询是否有值
            $sqlInfo['where'][] = 'cat_id in (' . $classId . ')';
        } else {
            $sqlInfo['where'][] = 'cat_id in (' . $classId . ') ';
            $sqlInfo['where'][] = ' goods_name like "%'.  $goodsName . '%"';
        }


        //货号查询
        if (!empty($goodssn)) {
            $sqlInfo['where'][] ='goods_sn like "%'.$goodssn.'%"';
        }

        //是否在售
        if (!empty($isonsale)) {
            $sqlInfo['where'][] = 'is_on_sale = "'.$isonsale.'"';
        }

        //是否删除
        if (!empty($isdelete)) {
            $sqlInfo['where'][] = 'is_delete= "'.$isdelete.'"';
        }else
        {
            $sqlInfo['where'][] = 'is_delete=0';
        }

        //是否推荐
        if (!empty($isrmd)) {
            $sqlInfo['where'][] ='is_rmd ="'.$isrmd.'"';
        }

        //品牌ID
        if (!empty($brandid)) {
            $sqlInfo['where'][] = 'brand_id = "'.$brandid.'"';
        }

        //授权品牌ID
        if (!empty($brandauthorizeid)) {
            $sqlInfo['where'][] ='brand_authorize_id = "'.$brandauthorizeid.'"';
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*
     * 取分类下的商品数量
     *$classId-分类ID、$goodsName-产品名称、$goodssn-货号、$isonsale-是否在售：1-正常、0停售、isdelete-是否删除：1-删除、0、正常、isrmd-是否推荐：0-正常、1推荐、brandid-品牌ID、brandauthorizeid-授权品牌ID
     * */
    public function getGoodsNum($classId, $goodsName = '',$goodssn='',$isonsale='',$isdelete='',$isrmd='',$brandid='',$brandauthorizeid='')
    {
        $sqlInfo = array(
            'fields' => array('count(goods_id) as num'),
            'table' => 'goods',
            'where'=>array(),

        );
        if (empty($goodsName)) { //判断关键字查询是否有值
            $sqlInfo['where'][] = 'cat_id in (' . $classId . ')';
        } else {
            $sqlInfo['where'][]='cat_id in (' . $classId . ')';
            $sqlInfo['where'][]='goods_name like "%'.  $goodsName . '%"';
        }

        //货号查询
        if (!empty($goodssn)) {
            $sqlInfo['where'][]='goods_sn like "%'.$goodssn.'%"';
        }

        //是否在售
        if (!empty($isonsale)) {
            $sqlInfo['where'][] ='is_on_sale = "'.$isonsale.'"';
        }

          //是否删除
        if (!empty($isdelete)) {
            $sqlInfo['where'][] = 'is_delete = "'.$isdelete.'"';
        }else
        {
            $sqlInfo['where'][] = 'is_delete = 0';
        }

        //是否推荐
        if (!empty($isrmd)) {
            $sqlInfo['where'][] = 'is_rmd = "'.$isrmd.'"';
        }

        //品牌ID
        if (!empty($brandid)) {
            $sqlInfo['where'][] = 'brand_id = "'.$brandid.'"';
        }

        //授权品牌ID
        if (!empty($brandauthorizeid)) {
            $sqlInfo['where'][] = 'brand_authorize_id = "'.$brandauthorizeid.'"';
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list[0]->num;
    }

    /*插入属性信息*/
    public function insertSku($arr, $type = '0', $skuId = '')
    {
        $sqlInfo = array(
            'fields' => $arr,
            'table' => 'goods_sku',
        );

        if ($type) {
            $sqlInfo['where'] = array('goods_sku_id="' . $skuId . '"');
            $this->CoreUpdate($sqlInfo);
            $list = $skuId;
        } else {
            $list = $this->CoreInsert($sqlInfo);
        }
        return $list;
    }

    /*插入或者更新商品信息*/
    public function insertGoods($arr, $type = '0', $id = '')
    {
        $sqlInfo = array(
            'fields' => $arr,
            'table' => 'goods',
        );
        if ($type) {
            $sqlInfo['where'] = array('goods_id="' . $id . '"');
            $this->CoreUpdate($sqlInfo);
            $list = $id;
        } else {
            $list = $this->CoreInsert($sqlInfo);
        }
        return $list;
    }

    /*删除品牌*/
    public function delBrand($brandId)
    {
        $sqlInfo = array(
            'table' => 'brand',
            'where' => array('brand_id="' . $brandId . '"')
        );

        $this->CoreDelete($sqlInfo);
    }

    /*添加品牌*/
    public function addBrand($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'brand',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*修改品牌*/
    public function updateBrand($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'brand',
            'where' => array(
                'brand_id = "' . $model['brand_id'] . '"',
            )
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*获取品牌列表*/
    public function getBrandList($type = 1)
    {
        $sqlInfo = array(
            'fields' => array(
                'brand_id',
                'brand_name',
                'brand_img',
                'is_rmd',
                'brand_type',
                'add_time',
            ),
            'table' => 'brand',
            'where' => array(
                'brand_type = "' . $type . '"'
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取供应商列表*/
    public function getSupplierList()
    {
        $sqlInfo = array(
            'fields' => array(
                'supplier_id',
                'supplier_name',
                'add_time',
            ),
            'table' => 'supplier',
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取渠道商列表*/
    public function getChannelList()
    {
        $sqlInfo = array(
            'fields' => array(
                'channel_id',
                'user_id',
                'channel_short_name',
                'channel_name',
                'channel_intro',
                'channel_type',
                'channel_end_order_time',
                'channel_feedback_time',
                'channel_allocation_time',
                'channel_inventory_update_type',
                'channel_more_intro',
                'express_id',
                'channel_update_time',
                'channel_create_time',
            ),
            'table' => 'channel',
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据用户ID获取渠道商详细信息*/
    public function getChannelInfo($userId)
    {
        $sqlInfo = array(
            'fields' => array(
                'channel_id',
                'user_id',
                'channel_short_name',
                'channel_name',
                'channel_intro',
                'channel_address',
                'channel_type',
                'channel_end_order_time',
                'channel_feedback_time',
                'channel_allocation_time',
                'channel_inventory_update_type',
                'channel_more_intro',
                'express_id',
                'channel_update_time',
                'channel_create_time',
            ),
            'table' => 'channel',
            'where' => array('user_id = "' . $userId . '"'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0];
    }

    /*获取快递列表*/
    public function getExpressList()
    {
        $sqlInfo = array(
            'fields' => array(
                'express_id',
                'express_name',
            ),
            'table' => 'express',
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取省份列表*/
    public function getProvinceList()
    {
        $sqlInfo = array(
            'fields' => array(
                'province_id',
                'province_name',
            ),
            'table' => 'china_province',
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*插入快递信息*/
    public function insertExpress($expressName)
    {
        $sql = array(
            'fields' => array(
                'express_id',
            ),
            'table' => 'express',
            'where' => array(
                'express_name = "' . $expressName . '"',
            ),
        );
        $isHava = $this->CoreSelect($sql);
        if (empty($isHava)) {
            $sqlInfo = array(
                'fields' => array(
                    'express_name' => $expressName,
                    'add_time' => time(),
                    'last_update' => time(),
                ),
                'table' => 'express',
            );
            $list = $this->CoreInsert($sqlInfo);
        } else {
            $list = '已经存在的快递名！';
        }
        return $list;
    }

    /*获取运费列表*/
    public function getExpressCostList($id)
    {
        $sqlInfo = array(
            'fields' => array(
                'cost_id',
                'express_id',
                'start_province_id',
                'end_province_id',
                'channel_id',
                'first_height',
                'last_height',
                'first_height_cost',
                'last_height_cost',
                'express_id',
                'express_id',
            ),
            'table' => 'express_cost',
            'where' => array(
                'express_id = ' . $id,
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取省份信息*/
    public function getProvinceInfo($id)
    {
        $sqlInfo = array(
            'fields' => array(
                'province_name',
            ),
            'table' => 'china_province',
            'where' => array(
                'province_id = ' . $id,
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list[0]->province_name;
    }

    /*获取过期商品列表*/
    public function getGoodsListOutOfDate($date)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'goods_thumb',
            ),
            'table' => 'goods',
            'where' => array('last_update < "' . $date . '"'),
            'order' => array('goods_id desc'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*根据商品ID删除商品*/
    public function delGoodsOutOfDate($goodsId)
    {
        $sqlInfo = array(
            'fields' => array(),
            'table' => 'goods',
            'where' => array(
                'goods_id = "' . $goodsId . '"',
            )
        );
        $this->CoreDelete($sqlInfo);
    }

    /*根据ID取商品详细信息*/
    public function getGoodsInfo($id)
    {
        $sqlInfo = array(
            'table' => 'goods',
            'where' => array(
                'goods_id = "' . $id . '"',
            )
        );

        $list = $this->CoreSelect($sqlInfo);

        return (empty($list[0])) ? $list : $list[0];
    }

    /*根据ID取商品详细信息*/
    public function getGoodsInfoFromGoodsSn($goodsSn)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_id',
                'cat_id',
                'goods_sn',
                'goods_name',
                'shop_price',
                'market_price',
                'discount',
                'in_discount',
                'goods_thumb',
                'is_on_sale',
                'add_time',
                'last_update',
                'brand_id',
                'brand_authorize_id',
                'channel_id',
                'goods_year',
                'goods_spring',
                'goods_sex',
                'goods_detail',
                'goods_sell_num', //产品销售数量
                'goods_two_dimensional_code_img', //产品二维码
                'goods_micro_channel', //微信端显示产品图文

            ),
            'table' => 'goods',
            'where' => array(
                'goods_sn = "' . $goodsSn . '"',
            )
        );

        $list = $this->CoreSelect($sqlInfo);

        return (empty($list[0])) ? array() : $list[0];
    }

    /*获取商品SKU列表*/
    public function getGoodsSkuList()
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_key_id',
                'sku_key',
                'sku_state',
                'is_show',
            ),
            'table' => 'goods_sku_key',
            'where' => array("sku_state = 1", 'is_show = 1')
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取商品SKU列表*/
    public function getGoodsSkuIdList($goods_sku_key_id)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_key_id',
                'sku_key',
                'sku_state',
                'is_show',
            ),
            'table' => 'goods_sku_key',
            'where' => array("sku_state = 1", 'is_show = 1', 'goods_sku_key_id in(' . $goods_sku_key_id . ')')
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据sku_key获取所有的sku_value*/
    public function getGoodsSkuValue($skuKeyId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_value_id',
                'goods_sku_value',
            ),
            'table' => 'goods_sku_value',
            'where' => array("goods_sku_key_id = '" . $skuKeyId . "'", 'is_show = 1')
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取商品分类列表*/
    public function getcateList()
    {
        $sqlInfo = array(
            'fields' => array(
                'cat_id',
                'goods_sku_key_id',
                'cat_real_id',
                'cat_name',
                'cat_type',
            ),
            'table' => 'category',
            'where' => array('cat_type = 1'),
            'order' => array('cat_real_id asc'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据分类名取得分类ID*/
    public function getClassIdFromClassName($catName)
    {
        $sqlInfo = array(
            'fields' => array(
                'cat_id',
                'cat_real_id',
            ),
            'table' => 'category',
            'where' => array("cat_name = '" . $catName . "'")
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据品牌名取得品牌ID*/
    public function getBrandIdFromBrandName($brandName)
    {
        $sqlInfo = array(
            'fields' => array(
                'brand_id',
            ),
            'table' => 'brand',
            'where' => array("brand_name = '" . $brandName . "'")
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? false : $list[0];
    }

    /*添加品牌*/
    public function insertBrand($brandName)
    {
        $sqlInfo = array(
            'fields' => array(
                'brand_name' => $brandName,
                'add_time' => time(),
                'last_update' => time(),
            ),
            'table' => 'brand'
        );

        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*根据sku_key的值查出ID*/
    public function getSkuKey($str)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_key_id',
            ),
            'table' => 'goods_sku_key',
            'where' => array("sku_key = '" . $str . "'")
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]->goods_sku_key_id) ? false : $list[0]->goods_sku_key_id;
    }

    /*插入新的sku_key*/
    public function insertSkuKey($str)
    {
        $sqlInfo = array(
            'fields' => array(
                'sku_key' => $str,
                'sku_state' => 1,
                'add_time' => time(),
                'last_update' => time(),
            ),
            'table' => 'goods_sku_key'
        );

        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*根据sku_value的值查出ID*/
    public function getSkuValue($str)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_value_id',
            ),
            'table' => 'goods_sku_value',
            'where' => array("goods_sku_value = '" . $str . "'")
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]->goods_sku_value_id) ? false : $list[0]->goods_sku_value_id;
    }

    /*插入新的sku_value*/
    public function insertSkuValue($str, $skuKeyId)
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_value' => $str,
                'goods_sku_key_id' => $skuKeyId,
                'add_time' => time(),
                'last_update' => time(),
            ),
            'table' => 'goods_sku_value'
        );

        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*插入库存优化----取所有sku_value列表*/
    public function getSkuValueList()
    {
        $sqlInfo = array(
            'fields' => array(
                'goods_sku_value_id',
                'goods_sku_key_id',
                'goods_sku_value',
            ),
            'table' => 'goods_sku_value'
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /*
     * 添加产品图片
     * */
    public function addGoodsPhoto($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'goods_photo'
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;

    }

    /*
     * 修改产品图片
     * $goodsid-产品ID、$photo_id-相册主键ID
     * */
    public function editGoodsPhoto($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'goods_photo',
            'where'  =>array( 'photo_id="' . $model['photo_id'] . '"'),
        );

        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*
     * 根据条件获取信息
     * $goodsid-产品ID、$photo_id-相册主键ID
     * */
    public function getGoodPhoto($goodsid = '', $photoid = '')
    {
        $sqlInfo = array(
            'fields' => array(
                'photo_id',
                'goods_id',
                'photo_image',
                'sort',
            ),
            'table' => 'goods_photo',
            'where' => array(),
            'order' =>array(
                'sort desc',
                'last_update desc',
            ),
        );

        //产品ID
        if (!empty($goodsid)) {
            $sqlInfo['where'] = array(
                'goods_id="' . $goodsid . '"',
            );
        }

        //图像主键ID
        if (!empty($photoid)) {
            $sqlInfo['where'] = array(
                'photo_id="' . $photoid . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*
     * 删除产品图片
     * $goodsid-产品ID、$photo_id-相册主键ID
     * */
    public function delGoodsPhoto($goodsid = '', $photoid = '')
    {
        $sqlInfo = array(
            'table' => 'goods_photo',
            'where' => array(),
        );

        //产品ID
        if (!empty($goodsid)) {
            $sqlInfo['where'] = array(
                'goods_id="' . $goodsid . '"',
            );
        }

        //图像主键ID
        if (!empty($photoid)) {
            $sqlInfo['where'] = array(
                'photo_id="' . $photoid . '"',
            );
        }
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }


    /**
     * 取产品预约信息--分页
     * */
    public function getGoodsSaleNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(gs_id) as num',
            ),
            'table' => 'goods_sale',
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     * 取产品预约信息--分页
     **/
    public function getGoodsSaleList($page, $perPage)
    {
        $sqlInfo = array(

            'table' => 'goods_sale',
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*
        * 删除预约产品信息
        * */
    public function delGoodsSaleId($gsid = 0)
    {
        $sqlInfo = array(
            'table' => 'goods_sale',
            'where' => array(
                'gs_id ="'.$gsid.'"'
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */