<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orderAction extends MY_Controller {

    function __construct(){
        parent::__construct();
        //验证登录
        $this->checkLogin();
    }

    /*显示购物车页面*/
    public function cart(){
        $this->L('ordermodel');
        $this->L('goodsmodel');

        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        $myConfig           = $this->config->config;


        /*取用户购物车商品*/
        $userCartList       = $this->ordermodel->getUserCart($userId);

        foreach($userCartList as $key => $value){
            $userCartList[$key]->goods_sku_key      = explode(',',$value->goods_sku_key);
            $userCartList[$key]->goods_sku_value    = explode(',',$value->goods_sku_value);
            if($value->goods_color){
                $userCartList[$key]->goods_color    = isset($myConfig['myconfig']['color'][$value->goods_color])?$myConfig['myconfig']['color'][$value->goods_color]:'其他';
            }
        }

        /*取推荐商品*/
        $hotGoods           = getHotGoods();

        $data               = array(
            'userCartList'      => $userCartList,
            'hotGoods'          => $hotGoods,
        );
        $this->load->view('goods/cart',$data);
    }

    /*ajax增加购物车数量*/
    public function addCartNum(){
        $this->L('ordermodel');
        $cartId             = $this->input->get_post('cartId');
        $cartNum            = $this->input->get_post('num');
        $this->ordermodel->updateCartNum($cartId,$cartNum);
    }

    /*删除购物车内商品*/
    public function delCart(){
        $this->L('OrderModel');
        $cartId             = $this->input->get_post('cartId');
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        if(!empty($cartId)){
            $cartIdArr          = explode(',',$cartId);
            foreach($cartIdArr as $value){
                $this->OrderModel->delCart($value,$userId);
            }
        }
    }

    /*加载订单页面*/
    public function orderPage($cartId = '', $addressId = ''){
        $this->L('ordermodel');
        $this->L('usermodel');
        $cartId             = empty($cartId)?$this->input->get_post('goOrder_cartId'):$cartId;//购物车ID
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID

        /*取用户收货地址*/
        $addressList        = $this->usermodel->getUserAddressList($userId);
        foreach($addressList as $key => $value){
            //根据省份获取省份ID
            $addressList[$key]->provinceId      = $this->ordermodel->getEndProvinceFromProvinceName($value->province);
        }

        /*取单条信息*/
        $addressInfo        = array();
        if($addressId){
            $addressInfo        = $this->usermodel->getAddressInfo($addressId);
            if(!empty($addressInfo->user_phone)){
                $userPhoneArr               = explode('-',$addressInfo->user_phone);
                $addressInfo->user_phone1   = $userPhoneArr[0];
                $addressInfo->user_phone2   = $userPhoneArr[1];
                $addressInfo->user_phone3   = $userPhoneArr[2];
            }
        }

        /*取购物车内容*/
        if(empty($cartId)){
            show_404();
        }
        $cartIdArr          = str_replace('-',',',$cartId);
        $cartList           = $this->ordermodel->getCartList($cartIdArr,$userId);
        //判断购物车是否为空
        if(empty($cartList))
        {
            msg('购物车不存在此产品！',base_url('/orderaction/cart'),2,2000);
        }
        $myConfig           = $this->config->config;
        foreach($cartList as $key => $value){
            $cartList[$key]->goods_price     = $value->goods_price;
            $cartList[$key]->all_price       = ($value->goods_price * $value->goods_num);
            //价格转换成金钱格式
            $cartList[$key]->goods_price_money     = number_format($value->goods_price,2);
            $cartList[$key]->all_price_money       = number_format(($value->goods_price * $value->goods_num),2);
            //转换颜色为文字
            if($value->goods_color){
                $cartList[$key]->goods_color    = isset($myConfig['myconfig']['color'][$value->goods_color])?$myConfig['myconfig']['color'][$value->goods_color]:'其他';
            }
        }
        /*取推荐商品*/
        $hotGoods           = getHotGoods();

        /*取快递*/
        $expressList       = $this->ordermodel->getExpressList();//运费列表

        $data               = array(
            'cartId'            => $cartId,
            'addressList'       => $addressList,
            'addressInfo'       => $addressInfo,
            'addressId'         => $addressId,
            'cartList'          => $cartList,
            'expressList'       => $expressList,
            'hotGoods'          => $hotGoods,
        );
        $this->load->view('goods/order',$data);
    }

    /*创建订单*/
    public function addOrder(){
        $this->L('ordermodel');
        $this->L('goodsmodel');
        $this->L('usermodel');

        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        $goodsRemark            = $this->input->get_post('goods_remark');           //商品备注
        $cartIds                = $this->input->get_post('order_goods');            //购物车ID
        $orderInvoice           = $this->input->get_post('orderInvoice');           //订单发票抬头
        $orderRemarks           = $this->input->get_post('orderRemarks');           //订单备注
        $expressId              = $this->input->get_post('express_id');             //快递ID
        $userAddressId          = $this->input->get_post('user_address_id');        //用户收货地址ID

        if($orderInvoice == '发票抬头名称'){
            $orderInvoice           = '';
        }
        if($orderRemarks == '声明：填写有关收货人信息以及配送方式'){
            $orderRemarks           = '';
        }

        /*取用户详细收货地址*/
        $userAddress            = $this->usermodel->getUserAddressInfo($userAddressId);

        /*获取商品总价和运费价格*/
        if(empty($cartIds) or empty($userAddressId) or empty($expressId) or empty($userId)){
            show_404();
        }

        $cartList               = $this->ordermodel->getCartList($cartIds,$userId);     //购物车信息
        //判断购物车是否为空
        if(empty($cartList))
        {
            msg('购物车不存在此产品！',base_url('/orderaction/cart'),2,2000);
        }


        $allGoodsPrice          = '';                                                   //商品总价
        $allGoodsWeight         = 0;                                                   //商品重量
        foreach($cartList as $key => $value){
            $allGoodsPrice          += ((float)$value->goods_price * $value->goods_num);
            $allGoodsWeight         += (float)$value->goods_weight;
            foreach($goodsRemark as $k => $v){
                if($k == $value->cart_id){
                    $cartList[$key]->goods_remark   = $v;
                }
            }
        }
        $expressCost            = $this->countExpressCost($expressId,$allGoodsWeight,$userAddress->province);//运费价格

        if(!empty($cartList[0])){
            /*生成订单*/
            $sqlInfo                = array(
                'order_sn'              => time().(microtime()*1000000),
                'user_id'               => $userId,
                'end_address_id'        => $userAddressId,
                'order_price'           => sprintf("%0.2f", ((float)$allGoodsPrice + (float)$expressCost)),
                'order_type'            => 0,
                'shipping_price'        => $expressCost,
                'express_id'            => $expressId,
                'remark'                => $orderRemarks,
                'invoice'               => $orderInvoice,
                'add_time'              => time(),
                'last_update'           => time(),
            );
            $orderId                = $this->ordermodel->addOrder($sqlInfo);

            /*生成订单商品*/
            foreach($cartList as $key => $value){
                //生成订单商品
                $sqlInfo                = array(
                    'order_id'              => $orderId,
                    'user_id'               => $value->user_id,
                    'goods_id'              => $value->goods_id,
                    'goods_sn'              => $value->goods_sn,
                    'goods_name'            => $value->goods_name,
                    'goods_thumb'           => $value->goods_thumb,
                    'goods_num'             => $value->goods_num,
                    'goods_price'           => $value->goods_price,
                    'goods_sku_id'          => $value->goods_sku_id,
                    'goods_color'           => $value->goods_color,
                    'goods_size'            => $value->goods_size,
                    'goods_sku_key'         => $value->goods_sku_key,
                    'goods_sku_value'       => $value->goods_sku_value,
                    'goods_weight'          => $value->goods_weight,
                    'goods_type'            => 0,
                    'remark'                => $value->goods_id,
                    'add_time'              => time(),
                    'last_update'           => time(),
                );
                $this->ordermodel->addOrderGoods($sqlInfo);

                //删除对应购物车
                $this->ordermodel->delCart($value->cart_id,$userId);
            }
            redirect(base_url('/orderaction/payPage/'.$orderId.'/'));
        }
    }

    /*加载支付页面*/
    public function payPage($orderId = ''){
        if(empty($orderId)){
            show_404();
        }

        $this->L('goodsmodel');
        $this->L('ordermodel');
        $this->load->add_package_path(APPPATH.'third_party/alipay/');

        /*取订单详细信息*/
        $orderInfo          = $this->ordermodel->getOrderInfo($orderId);
        //取用户收货信息
        $orderInfo->userAddressInfo            = $this->ordermodel->getAddress($orderInfo->end_address_id);

        /*取推荐商品*/
        $hotGoods           = getHotGoods();

        $data               = array(
            'hotGoods'          => $hotGoods,
            'orderInfo'         => $orderInfo,
        );
        $this->load->view('goods/payment',$data);
    }

    /*支付订单*/
    public function payOrder(){
        $this->L('OrderModel');
        $this->L('UserModel');
        $this->L('SourceModel');

        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $payment                = $this->input->get_post('payment');            //支付方式
        $userLevel = empty($_SESSION['user_level']) ? '' : $_SESSION['user_level']; //用户级别

        $balanceEnough          = 0;                                            //余额状态，0-不够，1-充足
        $orderType              = 0;                                            //订单状态

        if($userId && $orderId){

            /*取用户余额*/
            $userInfo               = $this->UserModel->getUserInfoByUserId($userId);
            //查询无此用户
            if(empty($userInfo)){
                msg('用户不存在！',base_url('/sourceaction/index/goods'),2,2000);
            }
            $userBalance            = $userInfo->user_money;

            /*取订单金额*/
            $orderInfo              = $this->OrderModel->getOrderInfo($orderId);
            if(empty($orderInfo)){
                msg('订单不存在！',base_url('/orderaction/orderList'),2,2000);
            }elseif($orderInfo->order_type > 0 && $orderInfo->order_type < 10){
                msg('订单已支付 请不要重新支付！',base_url('/orderaction/orderList'),2,2000);
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
                    msg('订单已支付 请不要重新支付！',base_url('/sourceaction/index/goods'),2,2000);
            }

            /*取商品详细信息*/
            $goodInfo               = $this->SourceModel->getGoodsInfo($orderInfo->goods_id);
            //查询无此商品
            if(empty($goodInfo)){
                msg('商品已下架！',base_url('/orderaction/orderList'),2,2000);
            }

            /*取商品属性*/
            $goodsSku               = $this->SourceModel->getSkuFromSkuId($orderInfo->goods_sku_id);
            //查询无此商品属性 或此属性已无库存
            if(empty($goodsSku[0]) or ($goodsSku[0]->sku_number == 0)){
                msg('此商品已无库存！',base_url('/orderaction/orderList'),2,2000);
            }
            $goodInfo->goodsSku     = $goodsSku[0];

            //判断商品库存是否足够
            $goodsNum               = $orderInfo->goods_num;
            $skuNumber              = $goodInfo->goodsSku->sku_number-$goodsNum;

            if($skuNumber < 0){//库存不足
                msg('库存不足！',base_url('/orderaction/orderList'),2,2000);
            }
            $skuNumberLock          = $goodInfo->goodsSku->sku_number_lock+$goodsNum;

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
                $this->OrderModel->updateOrder($orderId,$sqlInfo);

                //更新SKU库存
                $this->OrderModel->updateInventory($goodInfo->goodsSku->goods_sku_id,$skuNumberLock,$skuNumber);

                //2qi 记录日志

                msg('支付成功！',base_url('/orderaction/orderList'),2,2000);

            }elseif($payment == 1){//余额支付 并且余额不足
                msg('余额不足！',base_url('/orderaction/orderList'),2,2000);
            }else{//其他支付方式
                //2qi
            }

        }
    }

    /*确认收货 -- 包括重新发货的商品*/
    public function receiveGoods(){
        $this->L('OrderModel');

        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
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
        redirect(base_url('/useraction/userOrder/3/1'));
    }

    /*退换货*/
    public function changeGoods(){
        $this->L('OrderModel');

        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
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

            msg('操作成功！',base_url('/orderaction/orderList'),2,2000);
        }
    }

    /*退款*/
    public function exitMoney(){
        $this->L('OrderModel');
        $this->L('UserModel');

        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        $orderId                = $this->input->get_post('order_id');           //订单ID
        $exitMoney              = $this->input->get_post('exit_money');         //退款数
        $orderType              = 6;                                            //退款完成

        /*查询退款金额是否大于订单金额*/
        $orderInfo              = $this->OrderModel->getOrderInfo($orderId);
        if(empty($orderInfo)){
            msg('订单不存在！',base_url('/orderaction/orderList'),2,2000);
        }
        $orderMoney             = $orderInfo->order_price + $orderInfo->order_difference;
        if($exitMoney > $orderMoney){//退款金额大于订单总金额
            msg('退款金额不能大于订单金额！',base_url('/orderaction/orderList'),2,2000);
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
                msg('用户不存在！',base_url('/sourceaction/index/goods'),2,2000);
            }
            $userBalance            = $userInfo->user_money;

            /*增加用户余额*/
            $updateUserBalance      = $userBalance + $exitMoney;
            $this->UserModel->updateUserBalance($userId,$updateUserBalance);

            //2qi 记录日志

            msg('退款成功！',base_url('/orderaction/orderList'),2,2000);
        }
    }

    /*ajax获取快递费用 商品订单页运费获取*/
    public function getExpressCostOrder(){
        $expressId              = $this->input->get_post('expressId');
        $weight                 = $this->input->get_post('weight');
        $weight                 = empty($weight)?0:$weight;
        $endProvinceId          = $this->input->get_post('endProvince');

        $expressCost            = $this->countExpressCost($expressId,$weight,$endProvinceId);
        echo $expressCost;exit;
    }

    /*ajax获取快递费用 商品详细页运费获取*/
    public function getExpressCost(){
        $expressId              = $this->input->get_post('expressId');
        $num                    = $this->input->get_post('num');
        $weight                 = $this->input->get_post('weight');
        $weight                 = empty($weight)?0:$weight;
        $weight                 = $weight * $num;
        $endProvinceId          = $this->input->get_post('endProvince');

        $expressCost            = $this->countExpressCost($expressId,$weight,$endProvinceId);
        echo $expressCost;exit;
    }

    /**
     * 计算快递费用
     * parm $expressId:快递ID
     *      $weight：重量
     *      $endProvinceName：到达城市
     */
    private function countExpressCost($expressId,$weight,$endProvinceName){
        $this->L('OrderModel');
        $defaultCost            = 10;//默认运费
        $startProvinceId        = 33;
        if(!empty($expressId) && !empty($endProvinceName)){
            $endProvinceId          = (is_numeric($endProvinceName))?$endProvinceName:$this->OrderModel->getEndProvinceFromProvinceName($endProvinceName);

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