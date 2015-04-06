<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orderAction extends MY_Controller {

    function __construct(){
        parent::__construct();
    }

    /*添加购物车*/
    public function addCart(){

    }

    /*订单列表*/
    public function orderList($page = '1'){
        $this->L('OrderModel');
        $this->L('SourceModel');
        $this->L('usermodel');
        $userId         = $this->session->userdata['admin_id'];

        /*搜索条件*/
        $searchType     = $this->input->get_post('searchType');             //订单状态
        $startTime      = $this->input->get_post('startTime');              //下单开始时间
        $endTime        = $this->input->get_post('endTime');                //下单结束时间
        $channelId      = $this->input->get_post('channelId');              //渠道ID
        $goodsSn        = $this->input->get_post('goodsSn');                //商品货号
        $orderSn        = $this->input->get_post('orderSn');                //订单号
        $receiveName    = $this->input->get_post('receiveName');            //收件人姓名
        $receiveTel     = $this->input->get_post('receiveTel');             //收件人手机号
        $receivePhone   = $this->input->get_post('receivePhone');           //收件人电话

        /*组合搜索条件*/
        $where          = array();
        if($searchType != 'threeMonthAgo'){//三个月之前的订单
            $where['time']  = 'add_time > '.(time()-30*3*24*3600);
        }
        switch($searchType){
            case '':
                $where[]        = '';
                break;
            case '0':
                $where[]        = '(order_type = 0 or order_type = 11)';
                break;

            case '1':
                $where[]        = 'order_type = 1';
                break;

            case '2':
                $where[]        = '(order_type = 2 or order_type = 7)';
                break;

            case '3':
                $where[]        = 'order_type = 3';
                break;

            case '4':
                $where[]        = '(order_type = 4 or order_type = 5)';
                break;

            case '8':
                $where[]        = 'order_type = 8';
                break;

            case '9':
                $where[]        = 'order_type = 9';
                break;
        }

        $where['time']  = ($startTime && $endTime)     ? 'add_time > '.strtotime($startTime).' and add_time <'.strtotime($endTime) : '';
        $where[]        .= ($channelId)                 ? 'channel_id               = "'.$channelId.'"' : '';
        $where[]        .= ($goodsSn)                   ? 'goods_sn                 = "'.$goodsSn.'"' : '';
        $where[]        .= ($orderSn)                   ? 'order_sn                 = "'.$orderSn.'"' : '';
        $where[]        .= ($receiveName)               ? 'receive_name             = "'.$receiveName.'"' : '';
        $where[]        .= ($receiveTel)                ? 'receive_tel              = "'.$receiveTel.'"' : '';
        $where[]        .= ($receivePhone)              ? 'receive_phone            = "'.$receivePhone.'"' : '';

        /*订单列表分页*/
        $orderNum       = $this->OrderModel->getOrderNum($userId,$where);
        $perPage        = 15;
        $pageArr        = array(
            'page'          => $page,
            'total'         => $orderNum,
            'url'           => base_url().'orderaction/orderList/',
            'perPage'       => $perPage,
            'maxSize'       => 5,
            'isFirst'       => 1,
            'isprev'        => 1,
            'prevClass'     => 'syy',
            'nextClass'     => 'xyy',
            'firstClass'    => 'sy',
            'endClass'      => 'my',
        );
        $this->load->library('page');
        $pageClass      = new page();
        $pageHtml       = $pageClass->data($pageArr);
        $orderList      = $this->OrderModel->getOrderListFromPage($userId,$page,$perPage,$where);

        $myConfig               = $this->config->config;
        foreach($orderList as $key => $value){
            $orderList[$key]->orderType    = $myConfig['myconfig']['order_type'][$value->order_type];
            $orderList[$key]->userNikeName = $this->usermodel->getUserNikeName($value->user_id);
        }

        //用户权限
        $userLevel      = $this->session->userdata('user_level');//当前用户权限

        //取渠道商
        $channelList    = $this->SourceModel->getChannelList();

        $data                   = array(
            'orderList'             => $orderList,
            'pageHtml'              => $pageHtml,
            'userLevel'             => $userLevel,
            'myConfig'              => $myConfig['myconfig'],
            'channelList'           => $channelList,
            'searchWhere'           => array(
                'startTime'             => $startTime,
                'endTime'               => $endTime,
                'channelId'             => $channelId,
                'goodsSn'               => $goodsSn,
                'orderSn'               => $orderSn,
                'receiveName'           => $receiveName,
                'receiveTel'            => $receiveTel,
                'receivePhone'          => $receivePhone,
                'searchType'            => $searchType,
            )
        );
        $this->load->view('order/orderlist',$data);
    }

    /*订单详细页*/
    public function orderDetail($orderId = ''){
        if(empty($orderId)){
            show_404();
        }

        $this->L('ordermodel');

        /*取订单详细信息*/
        $orderInfo          = $this->ordermodel->getOrderInfo($orderId);
        $myConfig               = $this->config->config;
        $orderInfo->orderType    = $myConfig['myconfig']['order_type'][$orderInfo->order_type];

        /*取订单商品*/
        $orderGoodsList     = $this->ordermodel->getOrderGoods($orderId);

        /*取收货人信息*/
        $consigneeInfo      = $this->ordermodel->getConsigneeInfo($orderInfo->end_address_id);

        $data               = array(
            'orderInfo'         => $orderInfo,
            'orderGoodsList'    => $orderGoodsList,
            'consigneeInfo'     => $consigneeInfo,
        );

        $this->load->view('order/orderdetail',$data);
    }

    /*创建订单*/
    public function addOrder(){
        $this->L('OrderModel');
        $this->L('SourceModel');
        $this->L('UserModel');
        $this->L('CategoryModel');

        $userId                 = $this->session->userdata['admin_id'];          //用户ID
        $goodsId                = $this->input->get_post('goods_id');           //商品ID
        $goods_sku_id           = $this->input->get_post('goods_sku_id');       //商品属性
        $express                = $this->input->get_post('express');            //快递
        $province               = $this->input->get_post('province');           //省份
        $city                   = $this->input->get_post('city');               //城市
        $area                   = $this->input->get_post('area');               //区域
        $address                = $this->input->get_post('address');            //地址
        $tel                    = $this->input->get_post('tel');                //手机号
        $phone                  = $this->input->get_post('phone');              //固定电话
        $name                   = $this->input->get_post('name');               //收件人姓名
        $zipCode                = $this->input->get_post('zip_code');           //邮政编码
        $payment                = $this->input->get_post('payment');            //支付方式
        $goodsNum               = $this->input->get_post('goods_num');          //商品数量
        $remark                 = $this->input->get_post('remark');             //商品备注
        $goodsNum               = empty($goodsNum)?1:$goodsNum;                 //商品数量 默认为1
        $userLevel              = $this->session->userdata['user_level'];       //用户级别

        $balanceEnough          = 0;                                            //余额状态，0-不够，1-充足
        $orderType              = 0;                                            //订单状态

        if($userId && $goodsId && $goods_sku_id){

            /*取用户余额*/
            $userInfo               = $this->UserModel->getUserInfoByUserId($userId);
            //查询无此用户
            if(empty($userInfo)){
                msg('用户不存在！',base_url('sourceaction/index/goods'),2,2000);
            }
            $userBalance            = $userInfo->user_money;

            /*取商品详细信息*/
            $goodInfo               = $this->SourceModel->getGoodsInfo($goodsId);
            //查询无此商品
            if(empty($goodInfo)){
                msg('商品已下架！',base_url('sourceaction/index/goods'),2,2000);
            }

            //查询商品分类信息
            $goodInfo->category     = $this->CategoryModel->getCatInfo($goodInfo->cat_id);

            /*取商品属性*/
            $goodsSku               = $this->SourceModel->getSkuFromSkuId($goods_sku_id);
            //查询无此商品属性 或此属性已无库存
            if(empty($goodsSku[0]) or ($goodsSku[0]->sku_number == 0)){
                msg('此商品已无库存！',base_url('sourceaction/index/goods'),2,2000);
            }
            $goodInfo->goodsSku     = $goodsSku[0];

            //判断商品库存是否足够
            $skuNumber              = $goodInfo->goodsSku->sku_number-$goodsNum;
            if($skuNumber < 0){//库存不足
                msg('库存不足！',base_url('sourceaction/index/goods'),2,2000);
            }
            $skuNumberLock          = $goodInfo->goodsSku->sku_number_lock+$goodsNum;

            /*取商品属性值*/
            //取商品的color属性
            if($goodInfo->goodsSku->sku_color_id){
                $temp                                       = $this->SourceModel->getGoodsSkuInfoValue($goodInfo->goodsSku->sku_color_id);
                $goodInfo->goodsSku->color_value            = (empty($temp))?'':$temp->goods_sku_value;
            }
            //取取商品的size属性
            if($goodInfo->goodsSku->sku_size_id){
                $temp                                       = $this->SourceModel->getGoodsSkuInfoValue($goodInfo->goodsSku->sku_size_id);
                $goodInfo->goodsSku->size_value      = (empty($temp))?'':$temp->goods_sku_value;
            }
            //取商品的自定义属性
            if($goodInfo->goodsSku->sku_key_id){
                $skuKeyIdArr                                = explode(',',$goodInfo->goodsSku->sku_key_id);
                $skuValueIdArr                              = explode(',',$goodInfo->goodsSku->sku_value_id);
                $goodInfo->goodsSku->customSku              = '';
                foreach($skuKeyIdArr as $k => $v){
                    $skuKey                                     = $this->SourceModel->getGoodsSkuInfoKey($v);
                    $skuValue                                   = $this->SourceModel->getGoodsSkuInfoValue($skuValueIdArr[$k]);
                    $customSku[]                                = $skuKey->sku_key .':'. $skuValue->goods_sku_value;
                    $goodInfo->goodsSku->customSku              = implode(',',$customSku);
                }
            }

            //根据渠道ID 取渠道名
            $classInfo                      = getChannelInfo($goodInfo->channel_id);

            /*取商家地址*/
            $companyInfo            = $this->SourceModel->getChannelInfo($userId);
            if(empty($companyInfo)){//该用户不是商家
                //msg('您没有权限！',base_url('sourceaction/index/goods'),2,2000);
                $companyInfo->channel_address = 33;//默认发货地址为杭州
            }
            $startProvince          = $this->SourceModel->getProvinceInfo($companyInfo->channel_address);

            /*计算商品的单价 （如果有商品价格 商品价格+属性价格 ，如果没有商品价格 商品市场价*出售折扣+属性价格）*/
            if($goodInfo->shop_price > 0){
                $goodsPrice             = $goodInfo->shop_price + $goodInfo->goodsSku->sku_price;
            }else{
                $goodsPrice             = $goodInfo->market_price * $goodInfo->discount + $goodInfo->goodsSku->sku_price;
            }

            /*计算需要付的余额*/
            $weight                     = ($goodInfo->goodsSku->sku_weight < 0.5)?1.5:$goodInfo->goodsSku->sku_weight;
            $expressCost                = $this->countExpressCost($express,$weight,$province,$goodsNum);
            $needPay                    = $goodsPrice * $goodsNum + $expressCost;

            /*支付方式*/
            switch($payment){
                case 1://余额支付
                    if(($userBalance > $needPay) or ($userLevel < 2)){//余额足够
                        $balanceEnough      = 1;
                        $orderType          = 1;
                    }
                    break;
                case 2://支付宝支付

                    break;
                case 3://银行卡支付

                    break;
            }

            //提醒用户是否支付成功
            $sqlInfo                = array(
                'order_sn'              => time().(microtime()*1000000),
                'user_id'               => $userId,
                'channel_id'            => $goodInfo->channel_id,
                'channel_name'          => $classInfo->channel_name,
                'goods_id'              => $goodsId,
                'goods_sn'              => $goodInfo->goods_sn,
                'goods_name'            => $goodInfo->goods_name,
                'goods_category_id'     => $goodInfo->cat_id,
                'goods_category_real_id'=> $goodInfo->category->cat_real_id,
                'goods_category_name'   => $goodInfo->category->cat_name,
                'goods_price'           => $goodsPrice,
                'goods_num'             => $goodsNum,
                'order_price'           => $needPay,
                'order_type'            => $orderType,
                'goods_thumb'           => $goodInfo->goods_thumb,
                'goods_sku_id'          => $goods_sku_id,
                'goods_color'           => $goodInfo->goodsSku->color_value,
                'goods_size'            => $goodInfo->goodsSku->size_value,
                'goods_weight'          => $goodInfo->goodsSku->sku_weight,
                'shipping_price'        => $expressCost,
                'goods_custom_sku'      => empty($goodInfo->goodsSku->customSku)?'':$goodInfo->goodsSku->customSku,
                'express_id'            => $express,
                'start_province'        => $startProvince,
                'end_province'          => $province,
                'end_city'              => $city,
                'end_area'              => $area,
                'end_address'           => $address,
                'order_difference'      => 0,
                'remark'                => $remark,
                'end_zip_code'          => $zipCode,
                'receive_tel'               => $tel,
                'receive_phone'             => $phone,
                'receive_name'              => $name,
                'add_time'              => time(),
                'last_update'           => time(),
            );
            if($payment == 1 && $balanceEnough == 1){//余额支付并且余额充足
                //扣除账户余额
                if($userLevel > 0){
                    $updateUserBalance      = $userBalance - $needPay;
                    $this->UserModel->updateUserBalance($userId,$updateUserBalance);
                }

                //存入订单表
                $this->OrderModel->addOrder($sqlInfo);

                //更新SKU库存
                $this->OrderModel->updateInventory($goodInfo->goodsSku->goods_sku_id,$skuNumberLock,$skuNumber);

                //2qi 记录日志

                msg('下单成功！',base_url('orderaction/orderList'),2,2000);

            }elseif($payment == 1){//余额支付 并且余额不足
                //存入订单表
                $this->OrderModel->addOrder($sqlInfo);
                msg('余额不足！',base_url('orderaction/orderList'),2,2000);
            }else{//未支付
                //存入订单表
                $this->OrderModel->addOrder($sqlInfo);
                msg('下单成功！',base_url('orderaction/orderList'),2,2000);
            }

        }

    }

    /*支付订单*/
    public function payOrder(){
        $this->L('OrderModel');
        $this->L('UserModel');
        $this->L('SourceModel');

        $userId                 = $this->session->userdata['admin_id'];          //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $payment                = $this->input->get_post('payment');            //支付方式
        $userLevel              = $this->session->userdata['user_level'];       //用户级别
        $balanceEnough          = 0;                                            //余额状态，0-不够，1-充足
        $orderType              = 0;                                            //订单状态

        if($userId && $orderId){

            /*取用户余额*/
            $userInfo               = $this->UserModel->getUserInfoByUserId($userId);
            //查询无此用户
            if(empty($userInfo)){
                msg('用户不存在！',base_url('sourceaction/index/goods'),2,2000);
            }
            $userBalance            = $userInfo->user_money;

            /*取订单金额*/
            $orderInfo              = $this->OrderModel->getOrderInfo($orderId);
            if(empty($orderInfo)){
                msg('订单不存在！',base_url('orderaction/orderList'),2,2000);
            }elseif($orderInfo->order_type > 0 && $orderInfo->order_type < 10){
                msg('订单已支付 请不要重新支付！',base_url('orderaction/orderList'),2,2000);
            }
            switch($orderInfo->order_type){
                case 0://订单未支付
                    $orderPrice             = $orderInfo->order_price;
                break;
                case 10://订单已支付，差异金额未支付
                    $orderPrice             = $orderInfo->order_difference;
                break;
                case 11://订单未支付，差异金额未支付
                    $orderPrice             = $orderInfo->order_price + $orderInfo->order_difference;
                break;
                default:
                    msg('订单已支付 请不要重新支付！',base_url('sourceaction/index/goods'),2,2000);
            }

            /*取商品详细信息*/
            $goodsList              = $this->OrderModel->getOrderGoodsList($orderInfo->order_id);

            foreach($goodsList as $key => $value){
                $goodInfo[$key]         = $this->SourceModel->getGoodsInfo($value->goods_id);
                //查询无此商品
                if(empty($goodInfo)){
                    msg('商品已下架！',base_url('orderaction/orderList'),2,2000);
                }
                /*取商品属性*/
                $goodsSku               = $this->SourceModel->getSkuFromSkuId($value->goods_sku_id);
                //查询无此商品属性 或此属性已无库存
                if(empty($goodsSku[0]) or ($goodsSku[0]->sku_number == 0)){
                    msg('商品已无库存！',base_url('orderaction/orderList'),2,2000);
                }
                $goodInfo[$key]->goodsSku     = $goodsSku[0];

                //判断商品库存是否足够
                $goodsNum               = $value->goods_num;
                $skuNumber              = $goodsSku[0]->sku_number-$goodsNum;

                if($skuNumber < 0){//库存不足
                    msg('库存不足！',base_url('orderaction/orderList'),2,2000);
                }
                $goodInfo[$key]->skuNumberLock          = $goodsSku[0]->sku_number_lock+$goodsNum;
            }

            /*支付方式*/
            switch($payment){
                case 1://余额支付
                    if(($userBalance > $orderPrice) or ($userLevel < 2)){//余额足够
                        $balanceEnough      = 1;
                        $orderType          = 1;
                    }
                    break;
                case 2://支付宝支付

                    break;
                case 3://银行卡支付

                    break;
            }
            $sqlInfo                = array(
                'order_type'            => $orderType,
            );

            if($payment == 1 && $balanceEnough == 1){//余额支付并且余额充足
                //扣除账户余额
                if($userLevel > 1){
                    $updateUserBalance      = $userBalance - $orderPrice;
                    $this->UserModel->updateUserBalance($userId,$updateUserBalance);
                }

                //更新订单状态
                $this->OrderModel->updateOrderGoods($orderId,$sqlInfo);

                //更新SKU库存
                foreach($goodInfo as $value){
                    $this->OrderModel->updateInventory($value->goodsSku->goods_sku_id,$value->skuNumberLock,$skuNumber);
                }


                //2qi 记录日志

                msg('支付成功！',base_url('orderaction/orderList'),2,2000);

            }elseif($payment == 1){//余额支付 并且余额不足
                msg('余额不足！',base_url('orderaction/orderList'),2,2000);
            }else{//其他支付方式
                //2qi
            }

        }
    }

    /*修改订单差异金额*/
    public function changeOrderDifference(){
        $this->L('OrderModel');

        $orderId                = $this->input->get_post('orderId');            //订单号
        $diff                   = $this->input->get_post('diff');               //订单差异金额

        /*取订单详细信息*/
        $orderInfo              = $this->OrderModel->getOrderInfo($orderId);
        if(empty($orderInfo)){
            msg('订单不存在！',base_url('orderaction/orderList'),2,2000);
        }
        $orderType              = ($orderInfo->order_type > 9)?$orderInfo->order_type:(($orderInfo->order_type > 0)?10:11);//订单状态如果大于9 则不变，否则氛围已支付和未支付两种情况

        /*更新差异金额数和订单状态*/
        $this->OrderModel->changeOrderDifference($orderId,$diff,$orderType);


    }

    /*配送物品 -- 包括重新配送*/
    public function sendGoods(){
        $this->L('OrderModel');

        $userId                 = $this->session->userdata['admin_id'];          //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $shippingSn             = $this->input->get_post('shipping_sn');        //物流编号
        $orderType              = $this->input->get_post('order_type');         //订单状态
        $orderType              = empty($orderType)?2:$orderType;               //订单状态(默认已配送)

        if($userId && $orderId && $shippingSn){
            $sqlInfo                = array(
                'order_type'            => $orderType,
                'shipping_sn'           => $shippingSn,
            );

            //更新订单状态
            $this->OrderModel->updateOrder($orderId,$sqlInfo);

            //2qi 记录日志

            msg('配送成功！',base_url('orderaction/orderList'),2,2000);
        }
    }

    /*确认收货 -- 包括重新发货的商品*/
    public function receiveGoods(){
        $this->L('OrderModel');

        $userId                 = $this->session->userdata['admin_id'];          //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $orderType              = $this->input->get_post('order_type');         //订单状态
        $orderType              = empty($orderType)?3:$orderType;               //订单状态(默认 已确认收货)

        if($userId && $orderId){
            $sqlInfo                = array(
                'order_type'            => $orderType,
            );

            //更新订单状态
            $this->OrderModel->updateOrder($orderId,$sqlInfo);

            //2qi 记录日志

        }
    }

    /*退换货*/
    public function changeGoods(){
        $this->L('OrderModel');

        $userId                 = $this->session->userdata['admin_id'];          //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $changeType             = $this->input->get_post('change_type');        //0:退货，1:换货
        $question               = $this->input->get_post('question');           //退换货理由
        $intro                  = $this->input->get_post('intro');              //退换货说明
        $orderType              = ($changeType==1)?4:5;                         //换货中：退货中

        if($userId && $orderId){
            $sqlInfo                = array(
                'order_type'            => $orderType,
                'change_goods'          => $question,
                'change_goods_intro'    => $intro,
            );

            //更新订单状态
            $this->OrderModel->updateOrder($orderId,$sqlInfo);

            //恢复库存


            //2qi 记录日志

            msg('操作成功！',base_url('orderaction/orderList'),2,2000);
        }
    }

    /*退款*/
    public function exitMoney(){
        $this->L('OrderModel');
        $this->L('UserModel');

        $userId                 = $this->session->userdata['admin_id'];          //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $exitMoney              = $this->input->get_post('exit_money');         //退款数
        $orderType              = 6;                                            //退款完成

        /*查询退款金额是否大于订单金额*/
        $orderInfo              = $this->OrderModel->getOrderInfo($orderId);
        if(empty($orderInfo)){
            msg('订单不存在！',base_url('orderaction/orderList'),2,2000);
        }
        $orderMoney             = $orderInfo->order_price + $orderInfo->order_difference;
        if($exitMoney > $orderMoney){//退款金额大于订单总金额
            msg('退款金额不能大于订单金额！',base_url('orderaction/orderList'),2,2000);
        }

        /*更新订单表数据*/
        if($userId && $orderId){
            $sqlInfo                = array(
                'order_type'            => $orderType,
                'exit_money'            => $exitMoney,
            );

            //更新订单状态
            $this->OrderModel->updateOrder($orderId,$sqlInfo);

            //2qi 记录日志




            /*取用户余额*/
            $userInfo               = $this->UserModel->getUserInfoByUserId($userId);
            //查询无此用户
            if(empty($userInfo)){
                msg('用户不存在！',base_url('sourceaction/index/goods'),2,2000);
            }
            $userBalance            = $userInfo->user_money;

            /*增加用户余额*/
            $updateUserBalance      = $userBalance + $exitMoney;
            $this->UserModel->updateUserBalance($userId,$updateUserBalance);

            //2qi 记录日志

            msg('退款成功！',base_url('orderaction/orderList'),2,2000);
        }
    }

    /*ajax获取快递费用*/
    public function getExpressCost(){
        $expressId              = $this->input->get_post('expressId');
        $num                    = $this->input->get_post('num');
        $weight                 = $this->input->get_post('weight');
        $weight                 = empty($weight)?0:$weight;
        $endProvinceId          = $this->input->get_post('endProvince');

        $expressCost            = $this->countExpressCost($expressId,$weight,$endProvinceId,$num);
        echo $expressCost;exit;
    }

    /**
     * 计算快递费用
     * parm $expressId:快递ID
     *      $weight：重量
     *      $endProvinceName：到达城市
     */
    private function countExpressCost($expressId,$weight,$endProvinceName,$num){
        $this->L('OrderModel');
        $weight                 = $weight * $num;//总重量
        $defaultCost            = 10;//默认运费
        $startProvinceId        = $this->OrderModel->getStartProvinceFromUserId($this->session->userdata['admin_id']);
        if(!empty($expressId) && !empty($endProvinceName)){
            $endProvinceId          = $this->OrderModel->getEndProvinceFromProvinceName($endProvinceName);

            /*根据快递、出发省份、结束省份、重量计算所需运费*/
            $expressCost            = $this->OrderModel->getExpressCost($expressId,$startProvinceId,$endProvinceId);
            if(empty($expressCost)){//如果没有该信息，返回默认运费
                return $defaultCost;
            }else{
                if($weight <= $expressCost->first_height){//如果没有超重，返回基本运费
                    return $expressCost->first_height_cost;
                }else{//超重 计算费用
                    $realCost           = @$expressCost->first_height_cost + ceil(($weight - $expressCost->first_height) / $expressCost->last_height)*$expressCost->last_height_cost;
                    return $realCost;
                }
            }
        }

    }
}

/* End of file orderaction.php */
/* Location: ./application/controllers/orderaction.php */