<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderModel extends MY_Model {
    /*取用户收货地址*/
    public function getAddress($addressId){
        $sqlInfo = array(
            'table'     => 'user_address',
            'where'     => array('address_id = "'.$addressId.'"')
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list[0];
    }

    /*更改购物车的数量*/
    public function updateCartNum($cartId,$cartNum){
        $sqlInfo = array(
            'fields'   => array(
                'goods_num'     => $cartNum,
            ),
            'table'     => 'cart',
            'where'     => array('cart_id = "'.$cartId.'"')
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*获取快递列表*/
    public function getExpressList(){
        $sqlInfo = array(
            'fields'   => array(
                'express_id',
                'express_name',
            ),
            'table'     => 'express',
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据购物车ID取购物车列表*/
    public function getCartList($cartId,$userId){
        $sqlInfo                = array(
            'table'                 => 'cart',
            'where'                 => array(
                'cart_id in ('.$cartId.')',
                'user_id = "'.$userId.'"',
            ),
        );
        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list;
    }

    /*根据购物车ID取购物车数量*/
    public function getCartNum($userId){
        $sqlInfo                = array(
            'fields'   => array(
                'count(cart_id) as num',
            ),
            'table'                 => 'cart',
            'where'                 => array(
                'user_id = "'.$userId.'"',
            ),
        );
        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list[0])?0:$list[0]->num;
    }

    /*删除购物车*/
    public function delCart($cartId,$userId){
        $sqlInfo                = array(
            'table'                 => 'cart',
            'where'                 => array(
                'cart_id = "'.$cartId.'"',
                'user_id = "'.$userId.'"',
            ),
        );
        $this->CoreDelete($sqlInfo);
    }

    /*查询购物车内有没有相同商品*/
    public function getCartLikeThis($goodsId,$goodsSkuId,$userId){
        $sqlInfo                = array(
            'fields'                => array(
                'cart_id',
                'goods_num',
            ),
            'table'                 => 'cart',
            'where'                 => array(
                'goods_id = "'.$goodsId.'"',
                'goods_sku_id = "'.$goodsSkuId.'"',
                'user_id = "'.$userId.'"',
            ),
        );
        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list[0];
    }

    /*更新购物车商品数量*/
    public function updateCart($cartId,$goodsNum){
        $sqlInfo                = array(
            'fields'                => array(
                'goods_num'      => $goodsNum,
            ),
            'table'                 => 'cart',
            'where'                 => array(
                'cart_id = "'.$cartId.'"',
            ),
        );
        $this->CoreUpdate($sqlInfo);
        return $cartId;
    }

    /*加入购物车*/
    public function insertCart($sqlCartInfo){
        $sqlInfo                = array(
            'fields'                => $sqlCartInfo,
            'table'                 => 'cart',
        );
        $list       = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*根据用户ID取购物车商品*/
    public function getUserCart($userId){
        $sqlInfo                = array(
            'fields'                => array(
                '*',
            ),
            'table'                 => 'cart',
            'where'                 => array(
                'user_id = "'.$userId.'"',
            ),
            'order'                 => array(
                'add_time desc'
            ),
        );
        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list;
    }

    /*改变订单差异金额*/
    public function changeOrderDifference($orderId,$diff,$orderType){
        $sqlInfo                = array(
            'fields'                => array(
                'order_difference'      => $diff,
                'order_type'            => $orderType,
                'last_update'           => time(),
            ),
            'table'                 => 'order',
            'where'                 => array(
                'order_id = "'.$orderId.'"'
            ),
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*更新订单状态*/
    public function updateOrder($orderId,$data){
        $sqlInfo                = array(
            'fields'                => $data,
            'table'                 => 'order',
            'where'                 => array(
                'order_id = "'.$orderId.'"'
            ),
        );
        $list                   = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*根据订单ID取订单详细信息*/
    public function getOrderInfo($orderId){
        $sqlInfo                = array(
            'table'                 => 'order',
            'where'                 => array(
                'order_id = "'.$orderId.'"'
            ),
        );

        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list[0];
    }

    /*取当前页订单*/
    public function getOrderListFromPage($userId,$page,$perPage,$where){
        $where[]                = 'user_id = "'.$userId.'"';
        $sqlInfo                = array(
            'fields'                => array(
                'order_id',
                'order_sn',
                'goods_sn',
                'goods_name',
                'channel_name',
                'goods_color',
                'goods_size',
                'goods_weight',
                'goods_custom_sku',
                'goods_num',
                'goods_category_name',
                'goods_thumb',
                'goods_price',
                'shipping_price',
                'order_price',
                'order_type',
                'order_difference',
                'change_goods',
                'change_goods_intro',
                'exit_money',
                'remark',
                'add_time',
                'last_update',
            ),
            'table'                 => 'order',
            'where'                 => $where,
            'order'                 => array(
                'add_time desc'
            ),
            'limit'                 => ($page-1)*$perPage.','.$perPage,
        );

        $list                   = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据会员ID获取订单数量*/
    public function getOrderNum($userId,$where = ''){
        $where[]                = 'user_id = "'.$userId.'"';
        $sqlInfo                = array(
            'fields'                => array('count(order_id) as total'),
            'table'                 => 'order',
            'where'                 => $where,
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?0:$list[0]->total;
    }

    /*插入订单信息*/
    public function addOrder($fields){
        $sqlInfo                = array(
            'fields'                => $fields,
            'table'                 => 'order',
        );
        $list = $this->CoreInsert($sqlInfo);
        return empty($list)?'':$list;
    }

    /*插入订单商品信息*/
    public function addOrderGoods($fields){
        $sqlInfo                = array(
            'fields'                => $fields,
            'table'                 => 'order_goods',
        );
        $list = $this->CoreInsert($sqlInfo);
        return empty($list)?'':$list;
    }

    /*更新库存*/
    public function updateInventory($skuId,$skuNumberLock,$skuNumber){
        $sqlInfo                = array(
            'fields'                => array(
                'sku_number_lock'       => $skuNumberLock,
                'sku_number'            => $skuNumber,
            ),
            'table'                 => 'goods_sku',
            'where'                 => array(
                'goods_sku_id = "'. $skuId .'"',
            )
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*根据快递ID、出发城市、到达城市、重量获取运费信息*/
    public function getExpressCost($expressId,$startProvinceId,$endProvinceId,$channelId = ''){
        //2qi 按用户取运费信息 当前渠道ID为空
        $sqlInfo                = array(
            'fields'                => array(
                'cost_id',
//                'express_id',
//                'start_province_id',
//                'end_province_id',
//                'channel_id',
                'first_height',
                'last_height',
                'first_height_cost',
                'last_height_cost',
            ),
            'table'                 => 'express_cost',
            'where'                 => array(
                'express_id = "'.$expressId.'"',
                'start_province_id = "'.$startProvinceId.'"',
                'end_province_id = "'.$endProvinceId.'"',
//                'channelId = "'.$channelId.'"',
            ),
        );
        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list)?'':$list[0];
    }

    /*根据userId 获取快递出发城市*/
    public function getStartProvinceFromUserId($userId = ''){
        //2qi 按用户取所在城市 当前直接返回浙江
        return 33;
    }

    /*根据省份名 取得省份的ID*/
    public function getEndProvinceFromProvinceName($provinceName){
        $sqlInfo                = array(
            'fields'                => array(
                'province_id',
            ),
            'table'                 => 'china_province',
            'where'                 => array(
                'province_name = "'.$provinceName.'"',
            ),
        );
        $list                   = $this->CoreSelect($sqlInfo);
        return empty($list)?'':$list[0]->province_id;
    }
}

/* End of file ordermodel.php */
/* Location: ./application/controllers/ordermodel.php */