<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends MY_Model
{
    /*更新订单商品的状态*/
    public function updateOrderGoods($sql, $orderGoodsId)
    {
        $sqlInfo = array(
            'fields' => $sql,
            'table' => 'order_goods',
            'where' => array(
                'order_goods_id = "' . $orderGoodsId . '"'
            ),
        );

        $this->CoreUpdate($sqlInfo);
    }

    /*提交商品评论*/
    public function submitGoodsReview($sql)
    {
        $sqlInfo = array(
            'fields' => $sql,
            'table' => 'goods_review',
        );

        $this->CoreInsert($sqlInfo);
    }

    /*删除订单*/
    public function delUserOrder($userId, $orderId)
    {
        $sqlInfo = array(
            'fields' => array(
                'is_delete' => 1,
            ),
            'table' => 'order',
            'where' => array(
                'user_id = "' . $userId . '"',
                'order_id = "' . $orderId . '"',
            ),
        );

        $this->CoreUpdate($sqlInfo);
    }

    /*取订单商品*/
    public function getOrderGoods($userId, $orderId)
    {
        $sqlInfo = array(
            'table' => 'order_goods',
            'where' => array(
                'user_id = "' . $userId . '"',
                'order_id = "' . $orderId . '"',
            ),
            'order' => array(
                'add_time desc,order_goods_id desc'
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
    }

    /*取用户所有订单*/
    public function getOrderList($userId)
    {
        $where[] = 'user_id = "' . $userId . '"';
        $where[] = 'is_delete = 0';
        $sqlInfo = array(
            'fields' => array(
                'order_type',
            ),
            'table' => 'order',
            'where' => $where,
            'order' => array(
                'add_time desc'
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*取当前页订单*/
    public function getOrderListFromPage($userId, $page, $perPage, $where = array())
    {
        $where[] = 'user_id = "' . $userId . '"';
        $where[] = 'is_delete = 0';
        $sqlInfo = array(
            'fields' => array(
                'order_id',
                'order_sn',
                'user_id',
                'order_price',
                'order_type',
                'shipping_price',
                'express_id',
                'remark',
                'invoice',
                'add_time',
                'last_update',
            ),
            'table' => 'order',
            'where' => $where,
            'order' => array(
                'add_time desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据会员ID获取订单数量*/
    public function getOrderNum($userId, $where = array())
    {
        $where[] = 'user_id = "' . $userId . '"';
        $where[] = 'is_delete = 0';
        $sqlInfo = array(
            'fields' => array('count(order_id) as total'),
            'table' => 'order',
            'where' => $where,
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? 0 : $list[0]->total;
    }

    /*查询用户默认收货地址*/
    public function getUserDefaultAddress($userId)
    {
        $sqlInfo = array(
            'fields' => array(
                'address_id',
                'user_id',
                'province',
                'city',
                'area',
                'address',
                'user_real_name',
                'email_code',
                'user_tel',
                'user_phone',
                'is_default',
            ),
            'table' => 'user_address',
            'where' => array(
                'user_id = "' . $userId . '"',
                'is_default = 1',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /*注册时查询用户名是否存在*/
    public function getUserInfoFromUserName($userName)
    {
        $sqlInfo = array(
            'fields' => array(
                'user_id',
                'user_name',
                'user_nikename',
                'user_real_name', //真实姓名
                'user_password',
                'user_login_num',
                'user_mail',
                'is_lock',
                'is_lock',
            ),
            'table' => 'user',
            'where' => array(
                'user_name = "' . $userName . '"'
            )
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0];
    }

    /*用户注册*/
    public function register($sqlDate)
    {
        $sqlInfo = array(
            'fields' => $sqlDate,
            'table' => 'user',
        );
        $insertId = $this->CoreInsert($sqlInfo);
        return $insertId;
    }

    /*根据ID取用户信息*/
    public function getUserInfoFromUserId($userId)
    {
        $sqlInfo = array(
            'fields' => array(
                '*',
            ),
            'table' => 'user',
            'where' => array(
                'user_id = "' . $userId . '"',
                'is_lock = 0'
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0];
    }

    /*编辑用户资料*/
    public function updateUserInfo($userSqlInfo, $userId)
    {
        $sqlInfo = array(
            'fields' => $userSqlInfo,
            'table' => 'user',
            'where' => array(
                'user_id = "' . $userId . '"',
            ),
        );

        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*获取用户收货地址列表*/
    public function getUserAddressList($userId)
    {
        $sqlInfo = array(
            'fields' => array(
                'address_id',
                'user_id',
                'province',
                'city',
                'area',
                'address',
                'user_real_name',
                'email_code',
                'user_tel',
                'user_phone',
                'is_default',
            ),
            'table' => 'user_address',
            'where' => array(
                'user_id = "' . $userId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*获取用户收货地址详情*/
    public function getUserAddressInfo($userAddressId)
    {
        $sqlInfo = array(
            'fields' => array(
                'address_id',
                'user_id',
                'province',
                'city',
                'area',
                'address',
                'user_real_name',
                'email_code',
                'user_tel',
                'user_phone',
                'is_default',
            ),
            'table' => 'user_address',
            'where' => array(
                'address_id = "' . $userAddressId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /*根据收货信息ID获取详细收货信息*/
    public function getAddressInfo($addressId)
    {
        $sqlInfo = array(
            'fields' => array(
                'address_id',
                'user_id',
                'province',
                'city',
                'area',
                'address',
                'user_real_name',
                'email_code',
                'user_tel',
                'user_phone',
                'is_default',
            ),
            'table' => 'user_address',
            'where' => array(
                'address_id = "' . $addressId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list[0];
    }

    /*新增用户收货地址*/
    public function insertUserAddress($sql)
    {
        $sqlInfo = array(
            'fields' => $sql,
            'table' => 'user_address',
        );

        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*更新用户收货地址*/
    public function updateAddress($sql, $addressId)
    {
        $sqlInfo = array(
            'fields' => $sql,
            'table' => 'user_address',
            'where' => array(
                'address_id = "' . $addressId . '"',
            ),
        );

        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*更新用户收货地址*/
    public function updateUserAddress($sql, $userId)
    {
        $sqlInfo = array(
            'fields' => $sql,
            'table' => 'user_address',
            'where' => array(
                'user_id = "' . $userId . '"',
            ),
        );

        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /**
     *更新用户最后登录时间和登录IP
     */
    public function updateUserLastLoginTimeAndIp($filter)
    {
        $sqlInfo = array(
            'fields' => array(
                'last_login' => $filter['nowTime'],
                'last_ip' => $filter['userIp'],
                'user_login_num' => ($filter['user_login_num'] + 1),
            ),
            'table' => 'user',
            'where' => array(
                'user_id  = "' . $filter['userId'] . '"',
            ),
        );

        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }


    /*
* 根据 优惠码规则ID获得详细信息
* */
    public function getDiscountCodeRuleId($dc_id = 0)
    {
        $sqlInfo = array(
            'table' => 'discount_code_rule',
            'where' => array(),
        );
        if ($dc_id != 0) {
            $sqlInfo['where'] = array(
                'dc_id="' . $dc_id . '"',
            );
        }

        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /**
     * 读取优惠码赠送数量--分页
     * */
    public function getActivityDiscountCodesNum($where = array())
    {
        $sqlInfo = array(
            'fields' => array(
                'count(adc_id) as num',
            ),
            'table' => 'activity_discount_codes',
            'where' => $where,
            'order' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     * 读取优惠码赠送信息--分页
     * */
    public function ActivityDiscountCodesList($page, $perPage, $where)
    {
        $sqlInfo = array(
            'fields' => array(
                'adc_id',
                'dc_id',
                'dc_coding',
                'dc_pws',
                'user_id',
                'user_name',
                'is_show',
                'istatus',
                'adc_details_content',
                'adc_start_time',
                'adc_end_time',
                'add_time',
                'last_time',
            ),
            'table' => 'activity_discount_codes',
            'where' => $where,
            'order' => array(
                'istatus asc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     *添加收藏
     */
    public function addCollect($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'collect',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;

    }

    /**
     *根据条件读取收藏信息
     */
    public function getCollect($wehre)
    {
        $sqlInfo = array(
            'table' => 'collect',
            'where' => $wehre,
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     * 根据收藏ID删除收藏信息
     * */
    public function deleteCollect($ct_id)
    {
        $sqlInfo = array(
            'table' => 'collect',
            'where' => array(
                'ct_id= "' . $ct_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /**
     *读取收藏数量--分页
     */
    public function getCollectNum($where)
    {
        $sqlInfo = array(
            'fields' => array(
                'count(ct_id) as num',
            ),
            'table' => 'collect',
            'where' => $where,
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?0:$list[0]->num;
    }

    /**
     *读取收藏信息--分页
     */
    public function getCollectList($page, $perPage, $where)
    {
        $sqlInfo = array(
            'fields' => array(
                'ct_id',
                'user_id',
                'goods_id',
                'goods_title',
                'goods_thumb',
                'type',
                'goods_money',
                'add_time',
            ),
            'table' => 'collect',
            'where' => $where,
            'order' => array(
                'add_time desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;

    }

    /**
     *添加秀空间方法
     */
    public  function  addPersonalShow($model)
    {
        $sqlInfo = array(
            'fields'=>$model,
            'table' =>'personal_show',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

     /**
     *修改秀空间方法
     */
    public  function  editPersonalShow($model)
    {
        $sqlInfo = array(
            'fields'=>$model,
            'table' =>'personal_show,',
            'where' =>array(
                'per_id ="'.$model->per_id.'"'
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /**
     *根据ID取秀空间信息方法
     */
    public function getPerShowId($pre_id = 0)
    {
        $sqlInfo = array(
            'table' => 'personal_show',
            'where' => array(),
        );
        if ($pre_id != 0) {
            $sqlInfo['where'] = array(
                'pre_id = "' . $pre_id . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /**
     * 取个人秀信息条数--分页
     * */
    public function getPerShowNum($userId='')
    {
        $sqlInfo = array(
            'fields' => array(
                'count(pre_id) as num',
            ),
            'table' => 'personal_show',
            'where'=>array(),
            'order' => array(),
            'limit' => '',
        );
        if(!empty($userId))
        {
            $sqlInfo['where']=array(
                'user_id = "'.$userId.'"',
            );
         }
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     * 取个人秀信息--分页
     **/
    public function getPerShowList($page, $perPage,$hottype='',$userId='')
    {
        $sqlInfo = array(
            'table' => 'personal_show',
            'order' => array(
                'add_time desc'
            ),
            'where'=>array(),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );
        if(!empty($userId))
        {
            $sqlInfo['where']=array(
                'user_id = "'.$userId.'"',
            );
        }

        if(!empty($hottype))
        {
            $sqlInfo['order']=array(
                'pre_likes desc',
            );
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     * 根据收藏ID删除收藏信息
     * */
    public function delMyShow($id)
    {
        $sqlInfo = array(
            'table' => 'personal_show',
            'where' => array(
                'pre_id= "' . $id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /*获取评论赞数*/
    public function getMyShowZanNum($preid)
    {
        $sqlInfo = array(
            'fields' => array(
                'pre_likes',
            ),
            'table' => 'personal_show',
            'where' => array(
                'pre_id="' . $preid . '"',
            )
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? 0 : $list[0]->pre_likes;
    }

    /*获取评论赞数*/
    public function addMyShowZanNum($preLikes, $preid)
    {
        $sqlInfo = array(
            'fields' => array(
                'pre_likes' => $preLikes,
            ),
            'table' => 'personal_show',
            'where' => array(
                'pre_id="' . $preid . '"',
            )
        );

        $this->CoreUpdate($sqlInfo);
    }


    /*添加个人秀浏览记录*/
    public function addPersonalShowBrowse($model){
        $sqlInfo = array(
            'fields'=>$model,
            'table' =>'personal_show_browse',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /**
     *根据个人秀ID取浏览记录
     */
    public function getPersonalShowBrowse($per_id = 0)
    {
        $sqlInfo = array(
            'table' => 'personal_show_browse',
            'where' => array(),
        );
        if ($per_id != 0) {
            $sqlInfo['where'] = array(
                'per_id = "' . $per_id . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
    }

    /**
     * 根据个人秀浏览ID删除浏览记录
     * */
    public function delPersonalShowBrowse($psdid)
    {
        $sqlInfo = array(
            'table' => 'personal_show_browse',
            'where' => array(
                'psd_id= "' . $psdid . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }


    /*添加个人秀评论*/
    public  function  addPersonalShowGuestbook($model){
        $sqlInfo = array(
            'fields'=>$model,
            'table' =>'personal_show_guestbook',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*修改个人秀评论*/
    public  function  editPersonalShowGuestbook($model,$psgid){
        $sqlInfo = array(
            'fields'=>$model,
            'table' =>'personal_show_guestbook',
            'where' =>array(
            'psg_id ="'.$psgid.'"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /**
     *根据ID评论信息
     */
    public function getPersonalShowGuestbookId($preId ='',$userid='',$psgid='')
    {
        $sqlInfo = array(
            'table' => 'personal_show_guestbook',
            'where' => array(),
        );
        if (!empty($preId)) { //个人秀主键
            $sqlInfo['where'][] =  'per_id = "' . $preId . '"';
        }

        if (!empty($userid)) { //用户ID
            $sqlInfo['where'][] =  'user_id = "' . $userid . '"';
        }

        if (!empty($psgid)) { //用户ID
            $sqlInfo['where'][] =  'psg_id = "' . $psgid . '"';
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
    }
}

/* End of file usermodel.php */
/* Location: ./application/model/usermodel.php */