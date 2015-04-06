<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class userAction extends MY_Controller
{
    private $userId = ''; //用户ID
    private $userInfo = array(); //用户信息

    function __construct()
    {
        parent::__construct();
        //验证登录
        $this->checkLogin();

        /*取用户详细信息*/
        $this->L('usermodel');
        $this->userId = empty($_SESSION['user_id'])?'':$_SESSION['user_id'];
        $this->userInfo = $this->usermodel->getUserInfoFromUserId($this->userId);
    }

    public function index()
    {

        $this->L('usermodel');
        $this->L('ordermodel');
        /*用户默认收货地址*/
        $userDefaultAddress = $this->usermodel->getUserDefaultAddress($this->userId);
        if (empty($userDefaultAddress)) {
            //取用户地址的第一条
            $addressList = $this->usermodel->getUserAddressList($this->userId);
            $userDefaultAddress = empty($addressList[0]) ? array() : $addressList[0];
        }

        /*取用户购物车商品*/
        $userCartList = $this->ordermodel->getUserCart($this->userId);

        foreach ($userCartList as $key => $value) {
            $userCartList[$key]->goods_sku_key = explode(',', $value->goods_sku_key);
            $userCartList[$key]->goods_sku_value = explode(',', $value->goods_sku_value);
            if ($value->goods_color) {
                $userCartList[$key]->goods_color = isset($myConfig['myconfig']['color'][$value->goods_color]) ? $myConfig['myconfig']['color'][$value->goods_color] : '其他';
            }
        }

        /*取用户未付款商品数量*/
        $allOrderList = $this->usermodel->getOrderList($this->userId);
        $orderTypeNum1 = 0;
        foreach ($allOrderList as $value) {
            //取订单状态
            switch ($value->order_type) {
                case 0:
                    $orderTypeNum1++;
                    break;
            }
        }

        /*取推荐商品*/
        $hotGoods = getHotGoods();

        //我的收藏

        $collectOrderNum = $this->usermodel->getCollectNum(array('user_id="' . $this->userId . '"', 'type=1'));

        $data = array(
            'userInfo' => $this->userInfo,
            'userDefaultAddress' => $userDefaultAddress,
            'userCartList' => $userCartList,
            'userCartListNum' => count($userCartList),
            'hotGoods' => $hotGoods,
            'orderTypeNum1' => $orderTypeNum1,
            'collectOrderNum' => $collectOrderNum,
        );
        $this->load->view('user/center', $data);
    }

    /*加载注册页面*/
    public function register($error = '')
    {
        $str = ($error == 'error_user_name_isset') ? '用户名已存在！' : '';
        $data = array(
            'tips' => $str
        );
        $this->load->view('register', $data);
    }

    /*注册*/
    public function registerFuc()
    {
        $this->L('usermodel');
        $userName = $this->input->get_post('user_name'); //用户名
        $userEmail = $this->input->get_post('user_email'); //用户邮箱
        $userPassword = $this->input->get_post('user_password'); //用户密码
        $userPasswordConfirm = $this->input->get_post('user_password_confirm'); //用户密码确认

        if ($userName && $userEmail && $userPassword && $userPasswordConfirm && ($userPassword == $userPasswordConfirm)) {
            /*查询用户名是否存在*/
            $userInfo = $this->usermodel->getUserInfoFromUserName($userName);
            if (!empty($userInfo)) {
                redirect(base_url('useraction/register/error_user_name_isset'));
                exit;
            }

            $nikeName = 'leer_' . time() . substr(microtime(), 2, 6); //随机生成昵称
            $userIp = $this->get_real_ip(); //获取注册IP
            $sqlDate = array(
                'user_name' => $userName,
                'user_password' => self::setMd5($userPassword),
                'user_mail' => $userEmail,
                'user_nikename' => $nikeName,
                'add_time' => time(),
                'last_update' => time(),
                'last_login' => time(),
                'last_ip' => $userIp,
            );
            $userId = $this->usermodel->register($sqlDate); //插入数据库

            //新注册免登陆
            /*ie8兼容问题*/
//            $loginSuccessSession = array(
//                'user_id' => $userId,
//                'user_name' => $userName,
//                'user_email' => $userEmail,
//                'user_nikename' => $nikeName,
//            );
//            $this->session->set_userdata($loginSuccessSession);
            $_SESSION['user_id']        = $userId;
            $_SESSION['user_name']      = $userName;
            $_SESSION['user_email']     = $userEmail;
            $_SESSION['user_nikename']  = $nikeName;
            msg('注册成功！', base_url('index.php'), 2, 2000);
        } else {
            redirect(base_url('useraction/register/error_user_name_isset'));
        }
    }

    /*登录页面*/
    public function login($error = '')
    {
        /*如果已经登录 跳转到用户中心*/
        $userId = $this->userId;
        if (!empty($userId)) {
            redirect(base_url('/useraction/index'));
        }

        $str_user = '';
        $str_lock = '';
        $str_word = '';
        switch ($error) {
            case 'no_user':
                $str_user = '不存在的用户名！';
                break;
            case 'is_lock':
                $str_lock = '用户已被锁定！';
                break;
            case 'password_error':
                $str_word = '密码错误！';
                break;
        }
        $data = array(
            'tips_user' => $str_user,
            'tips_lock' => $str_lock,
            'tips_work' => $str_word,
        );
        $this->load->view('login', $data);
    }

    /**
     * ajax登录
     */
    public function ajaxLogin()
    {
        $this->L('UserModel');

        $userName = $this->input->get_post('username');
        $password = self::setMd5($this->input->get_post('password'));
        $isRemember = $this->input->get_post('is_remember');

        $userInfo = $this->UserModel->getUserInfoFromUserName($userName);

        if (!$this->UserModel->isNotEmpty($userInfo)) { //没有该用户
            echo 'user_not_exist';
            exit;
        }

        if ($userInfo->is_lock == 1) { //是否锁定
            echo 'user_is_lock';
            exit;
        }
        if ($password != $userInfo->user_password) { //密码错误
            echo 'pwd_not_proper';
            exit;
        }

        /*登录通过*/
        $loginSuccessSession = array(
            'user_id' => $userInfo->user_id,
            'user_nikename' => $userInfo->user_nikename,
            'user_name' => $userInfo->user_name,
        );
        $this->session->set_userdata($loginSuccessSession);
        /*ie8兼容问题*/
//            $loginSuccessSession = array(
//                'user_id' => $userId,
//                'user_name' => $userName,
//                'user_email' => $userEmail,
//                'user_nikename' => $nikeName,
//            );
//            $this->session->set_userdata($loginSuccessSession);
        $_SESSION['user_id']        = $userInfo->user_id;
        $_SESSION['user_name']      = $userInfo->user_name;
        $_SESSION['user_email']     = $userInfo->user_mail;
        $_SESSION['user_nikename']  = $userInfo->user_nikename;

        //如果有记录密码 存入cookie
        if ($isRemember == '1') {
            setcookie('remember_user_name', $userName, time() + 3600 * 24 * 365, '/');
        }

        /*更新用户最后登录时间和登录IP*/
        $userIp = $this->get_real_ip();
        $filter = array(
            'userIp' => $userIp,
            'nowTime' => time(),
            'userId' => $userInfo->user_id,
            'user_login_num' => $userInfo->user_login_num,
        );

        $this->UserModel->updateUserLastLoginTimeAndIp($filter);
        echo 'ok';
        exit;
    }

    /**
     *改变用户的锁定状态
     */
    public function changeLock()
    {

        $this->load->model('UserModel');
        $lockType = $_POST['lockType'];
        $userId = $_POST['userId'];

        /*验证传递过来的lockType*/
        if ($lockType != 0 && $lockType != 1) {
            echo json_encode('false');
            return;
        }

        /*验证传递过来的userid*/
        if (!is_numeric($userId)) {
            echo json_encode('false');
            return;
        }

        /*改变lock值*/
        $filter = array(
            'userId' => $userId,
            'is_lock' => $lockType,
        );
        $this->UserModel->updateLock($filter);
        echo json_encode('success');
        return;
    }

    /*退出登录*/
    public function logout()
    {
//        $loginSuccessSession = array(
//            'user_id' => '',
//        );
//        $this->session->set_userdata($loginSuccessSession);
        $_SESSION['user_id']        = '';
        $_SESSION['user_name']      = '';
        $_SESSION['user_email']     = '';
        $_SESSION['user_nikename']  = '';
        setcookie('remember_user_name', '', time(), '/');
        redirect(base_url('/'));
    }

    /*用户资料管理页面*/
    public function manage()
    {
        $this->L('usermodel');

        $data = array(
            'userInfo' => $this->userInfo
        );
        $this->load->view('user/manage', $data);
    }

    /*编辑用户资料*/
    public function editUser()
    {
        $this->L('usermodel');

        //用户资料数组
        $userSqlInfo = array(
            'user_real_name' => $this->input->get_post("user_real_name"),
            'user_nikename' => $this->input->get_post("user_nikename"),
            'user_mail' => $this->input->get_post("user_mail"),
            'user_tel' => $this->input->get_post("user_tel"),
            'user_sex' => $this->input->get_post("user_sex"),
            'user_province' => $this->input->get_post("user_province"),
            'user_city' => $this->input->get_post("user_city"),
            'user_area' => $this->input->get_post("user_area"),
            'user_address' => $this->input->get_post('user_address'),
            'last_update' => time(),
        );

        if (!empty($userSqlInfo['user_nikename']) && !empty($userSqlInfo['user_mail'])) {
            /*保存头像*/
            if (!empty($_FILES['user_img']['name'])) {
                $goodsUpload = uploadOss('', $_FILES['user_img']);
                if (!empty($goodsUpload) && !empty($goodsUpload['upload_data'])) {
                    $userSqlInfo['user_image'] = $goodsUpload['upload_data'];
                }
            }

            /*保存用户资料*/
            $this->usermodel->updateUserInfo($userSqlInfo, $this->userId);
        }

        redirect(base_url('/useraction/manage'));
        exit;
    }

    /*用户安全设置*/
    public function safety()
    {
        $this->L('usermodel');

        $data = array(
            'userInfo' => $this->userInfo
        );
        $this->load->view('user/safety', $data);
    }

    /*用户修改绑定邮箱*/
    public function editSafeEmail($editTime = '', $userMailStr = '', $userMailDx = '')
    {
        $this->L('usermodel');
        $backTime = 300; //设置邮件有效期（秒）


        /*用户修改绑定邮箱返回数据处理*/
        if ($editTime) {
            $userMail = $userMailStr . '@' . $userMailDx;
            if (((int)$editTime + $backTime) > time()) { //邮件未过期
                $userSqlInfo['user_mail'] = $userMail;
                $this->usermodel->updateUserInfo($userSqlInfo, $this->userId);
                msg('邮件绑定成功！', base_url('/useraction/safety'), 2, 2000);
                exit;
            } else { //邮件已过期
                msg('邮件已过期，请重新发送！', base_url('/useraction/safety'), 2, 2000);
                exit;
            }
        }


        $userMail = empty($userMail) ? $this->input->get_post("user_mail") : $userMail;
        $userPassword = $this->input->get_post("user_mail_pwd");
        $userPassword = self::setMd5($userPassword);

        //验证密码
        if ($userPassword == $this->userInfo->user_password && !empty($userMail)) {

            $userMailArr = explode('@', $userMail);
            $sendTo = $userMail;
            $title = 'C2M邮件绑定验证';
            $content = '您正在申请C2M邮箱绑定，请点击下面URL完成验证，如果浏览器没有自动跳转，请复制URL并粘贴到浏览器URL输入框</br>';
            $content .= base_url() . '/useraction/editSafeEmail/' . time() . '/' . $userMailArr[0] . '/' . $userMailArr[1];

            $sendEmail = sendEmail($sendTo, $title, $content);
            if ($sendEmail) {
                echo 'OK';
            } else {
                echo 'wrong';
            }
        } else {
            echo 'password_wrong';
        }
    }

    /*根据邮箱找回密码*/
    public function  emailRetrieveForgotPwd()
    {
        $this->L('usermodel');
        $username = $this->input->get_post('forgetPwd_user'); //接受用户名称
        $email = $this->input->get_post('forgetPwd_email'); //接受用户邮箱

        //根据用户名获取邮箱
        $userinfo = $this->usermodel->getUserInfoFromUserName($username);
        if (empty($userinfo)) {
            echo 'user_not_exist'; //判断用户不存在
            exit;
        }
        //判断用户输入邮箱是否跟预留邮箱一致
        if (!empty($userinfo->user_mail)) { //判断邮箱是否不存在
            if ($userinfo->user_mail != $email) {
                echo 'mail_not_same'; //用户输入邮箱是否跟预留邮箱一致
                exit;
            }
        } else {
            echo 'mail_not_exist'; //邮箱不存在
            exit;
        }
        //生成随机六位密码
        $pwdnumbet = rand(100000, 999999);
        //md5加密 存入user表
        $userSqlInfo['user_password'] = self::setMd5($pwdnumbet);
        $boolpwd = $this->usermodel->updateUserInfo($userSqlInfo, $userinfo->user_id);
        if (!$boolpwd) {
            echo 'error'; //初始密码失败！
            exit;
        }
        $myConfig = $this->config->config;

        //发送邮件
        $sendTo = $email; //发送邮箱
        $title = $myConfig['myconfig']['email_model']['title'];
        $content = $myConfig['myconfig']['email_model']['content'] . $pwdnumbet;
        $sendEmail = sendEmail($sendTo, $title, $content);
        if ($sendEmail) {
            echo 'OK'; //邮箱发送成功
            exit;
        } else {
            echo 'wrong'; //邮箱发送失败
            exit;
        }
    }

    /*用户修改安全设置*/
    public function editSafety()
    {
        $this->L('usermodel');
        /*取用户详细信息*/
        $userPassword = $this->input->get_post("user_password");
        $userPassword = ($userPassword == '********') ? '' : $userPassword;
        $userNewPassword = $this->input->get_post("user_new_password");

        //用户资料数组
        $userSqlInfo = array();
        $userPassword = self::setMd5($userPassword);

        //密码错误
        if ($userPassword != $this->userInfo->user_password) {
            echo 'old_password_wrong';
            exit;
        }

        if (!empty($userNewPassword)) {
            $userSqlInfo['user_password'] = self::setMd5($userNewPassword);
        }

        if (!empty($userSqlInfo)) {
            $this->usermodel->updateUserInfo($userSqlInfo, $this->userId);
            echo 'change_success';
        } else {
            echo 'change_false';
        }
        exit;
    }

    /*用户收货地址*/
    public function address($addressId = '')
    {
        $this->L('usermodel');

        /*取用户收货地址*/
        $addressList = $this->usermodel->getUserAddressList($this->userId);

        /*取单条信息*/
        $addressInfo = array();
        if ($addressId) {
            $addressInfo = $this->usermodel->getAddressInfo($addressId);
            if (!empty($addressInfo->user_phone)) {
                $userPhoneArr = explode('-', $addressInfo->user_phone);
                $addressInfo->user_phone1 = $userPhoneArr[0];
                $addressInfo->user_phone2 = $userPhoneArr[1];
                $addressInfo->user_phone3 = $userPhoneArr[2];
            }
        }

        $data = array(
            'userInfo' => $this->userInfo,
            'addressList' => $addressList,
            'addressInfo' => $addressInfo,
            'addressId' => $addressId,
        );
        $this->load->view('user/address', $data);
    }

    /*添加修改用户收货地址*/
    public function addEditAddress($cartId = '')
    {
        $this->L('usermodel');

        /*参数接收*/
        $act = $this->input->get_post('act');
        $province = $this->input->get_post('province');
        $city = $this->input->get_post('city');
        $area = $this->input->get_post('quyu');
        $address = $this->input->get_post('address');
        $emailCode = $this->input->get_post('email_code');
        $userRealName = $this->input->get_post('user_real_name');
        $userTel = $this->input->get_post('user_tel');
        $isDefault = $this->input->get_post('is_default');

        $userPhone1 = $this->input->get_post('user_phone_1');
        $userPhone2 = $this->input->get_post('user_phone_2');
        $userPhone3 = $this->input->get_post('user_phone_3');
        $userPhone = $userPhone1 . '-' . $userPhone2 . '-' . $userPhone3;

        /*如果为默认地址，则更新所有地址为非默认*/
        if ($isDefault) {
            $sqlInfo = array(
                'is_default' => 0,
            );
            $this->usermodel->updateUserAddress($sqlInfo, $this->userId);
        }

        /*组合数据*/
        $sqlInfo = array(
            'user_id' => $this->userId,
            'province' => $province,
            'city' => $city,
            'area' => $area,
            'address' => $address,
            'email_code' => $emailCode,
            'user_real_name' => $userRealName,
            'user_tel' => $userTel,
            'user_phone' => $userPhone,
            'is_default' => $isDefault,
            'add_time' => time(),
            'last_time' => time(),
        );
        if ($userTel == '电话号码、手机号码必须填一项 ') { //手机为空则去掉
            unset($sqlInfo['user_tel']);
        }
        if ($userPhone == '区号-电话号码-分机') { //电话为空则去掉
            unset($sqlInfo['user_phone']);
        }

        if ($act == 'add') { //添加收货地址
            $this->usermodel->insertUserAddress($sqlInfo);
        } elseif ($act == 'edit') { //修改收货地址
            unset($sqlInfo['add_time']); //去掉添加时间
            $addressId = $this->input->get_post('addressId'); //接收要修改的收货地址ID
            if ($addressId && is_numeric($addressId)) {
                $this->usermodel->updateAddress($sqlInfo, $addressId);
            }
        }
        if ($cartId) {
            redirect(base_url('/orderaction/orderPage/' . $cartId));
        } else {
            redirect(base_url('/useraction/address'));
        }
        exit;
    }

    /*ajax更改用户默认地址*/
    public function changeUserDefaultAddress()
    {
        $this->L('usermodel');

        //所有地址设置为非默认
        $sqlInfo = array(
            'is_default' => 0,
        );
        $this->usermodel->updateUserAddress($sqlInfo, $this->userId);

        //更新特定地址为默认
        $addressId = $this->input->get_post('addressId'); //接收要修改的收货地址ID
        $sqlInfo = array(
            'is_default' => 1,
        );
        if ($addressId && is_numeric($addressId)) {
            $this->usermodel->updateAddress($sqlInfo, $addressId);
        }
    }

    /*交易管理*/
    public function userOrder($orderType = '', $page = '1')
    {
        $this->L('usermodel');
        $orderType = ($orderType == '') ? 99 : $orderType;

        /*订单列表分页*/
        $where = ($orderType == '' or $orderType == 99) ? array() : (($orderType == 3 or $orderType == 8) ? array('(order_type = 3 or order_type = 8)') : array('order_type = ' . $orderType)); //订单搜索条件
        $orderTypeNum1 = 0; //未付款订单数量
        $orderTypeNum2 = 0; //已付款订单数量
        $orderTypeNum3 = 0; //已完成订单数量
        $orderTypeNum4 = 0; //已发货订单数量
        $orderNum = $this->usermodel->getOrderNum($this->userId, $where);
        $perPage = 5;
        $pageArr = array(
            'page' => $page,
            'total' => $orderNum,
            'url' => '//useraction/userOrder/' . $orderType . '/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        $orderList = $this->usermodel->getOrderListFromPage($this->userId, $page, $perPage, $where);
        foreach ($orderList as $key => $value) {
            $orderList[$key]->goodsList = $this->usermodel->getOrderGoods($this->userId, $value->order_id); //取订单商品
        }

        $allOrderList = $this->usermodel->getOrderList($this->userId);
        foreach ($allOrderList as $value) {
            //取订单状态
            switch ($value->order_type) {
                case 0:
                    $orderTypeNum1++;
                    break;
                case 1:
                    $orderTypeNum2++;
                    break;
                case 2:
                    $orderTypeNum4++;
                    break;
                case 3:
                    $orderTypeNum3++;
                    break;
                case 8:
                    $orderTypeNum3++;
                    break;
            }
        }


        /*取推荐商品*/
        $hotGoods = getHotGoods();

        $data = array(
            'userInfo' => $this->userInfo,
            'hotGoods' => $hotGoods,
            'orderList' => $orderList,
            'pageHtml' => $pageHtml,
            'orderTypeNum1' => $orderTypeNum1,
            'orderTypeNum2' => $orderTypeNum2,
            'orderTypeNum3' => $orderTypeNum3,
            'orderTypeNum4' => $orderTypeNum4,
            'page' => $page,
        );
        $this->load->view('user/myOrder', $data);
    }

    /*删除订单*/
    public function delUserOrder()
    {
        $this->L('usermodel');
        $orderId = $this->input->get_post('orderId');
        $this->usermodel->delUserOrder($this->userId, $orderId);
    }

    /*
     * 用户评价
     * */
    public function myEva($page = 1)
    {
        $this->L('usermodel');
        $page = ($page > 0) ? $page : 1;

        /*取已完成的订单列表*/
        $isReview = 0; //已点评数量
        $noReview = 0; //未点评数量
        $where[] = '(order_type = 3 or order_type = 8)'; //已完成订单搜索条件

        $orderNum = $this->usermodel->getOrderNum($this->userId, $where);
        $perPage = 5;
        $pageArr = array(
            'page' => $page,
            'total' => $orderNum,
            'url' => '//useraction/myEva/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        $orderList = $this->usermodel->getOrderListFromPage($this->userId, $page, $perPage, $where);
        //取订单商品
        foreach ($orderList as $key => $value) {
            $orderList[$key]->goodsList = $this->usermodel->getOrderGoods($this->userId, $value->order_id);
            foreach ($orderList[$key]->goodsList as $v) {
                if ($v->is_review) {
                    $isReview = $isReview + 1; //计算已点评数量
                } else {
                    $noReview = $noReview + 1; //计算未点评数量
                }
            }
        }

        /*取推荐商品*/
        $hotGoods = getHotGoods();

        $data = array(
            'userInfo' => $this->userInfo,
            'hotGoods' => $hotGoods,
            'orderList' => $orderList,
            'pageHtml' => $pageHtml,
            'isReview' => $isReview,
            'noReview' => $noReview,
        );
        $this->load->view('user/myEva', $data);
    }

    /**
     * 评论图片提交
     */
    public function loadIframe()
    {
        $data = array();

        if (!empty($_FILES['fileField'])) {
            $advUpload = @uploadOss('', $_FILES['fileField']);
            if (!empty($advUpload['upload_data'])) {
                $data = array(
                    'uploadData' => $advUpload['upload_data']
                );
            }
        }

        $this->load->view('user/eva', $data);
    }

    /*提交评论*/
    public function submitGoodsReview()
    {
        $this->L('usermodel');
        $this->L('goodsmodel');

        $score = $this->input->get_post('score');
        $con = $this->input->get_post('con');
        $img = $this->input->get_post('img');
        $goodsId = $this->input->get_post('goodsId');
        $orderGoodsId = $this->input->get_post('orderGoodsId');
        $score = empty($score) ? 5 : $score;
        if (!empty($goodsId) && !empty($this->userId)) {
            $goodsInfo = $this->goodsmodel->getGoodsInfo($goodsId);
            $userInfo = $this->userInfo;
            $sqlInfo = array(
                'goods_id' => $goodsId,
                'goods_sn' => $goodsInfo->goods_sn,
                'review_score' => $score,
                'review_content' => $con,
                'review_pics' => $img,
                'review_zan_num' => '0',
                'user_id' => $this->userId,
                'user_name' => $userInfo->user_name,
                'user_nikename' => $userInfo->user_nikename,
                'user_address' => $userInfo->user_province . ' - ' . $userInfo->user_city,
                'user_image' => $userInfo->user_image,
                'is_cream' => '0',
                'add_time' => time(),
                'last_update' => time(),
            );
            $this->usermodel->submitGoodsReview($sqlInfo); //提交评论

            /*更新订单商品表*/
            $sqlInfo = array(
                'is_review' => 1,
                'last_update' => time(),
            );
            $this->usermodel->updateOrderGoods($sqlInfo, $orderGoodsId); //提交评论
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*评论点赞*/
    public function reviewZan()
    {
        $this->L('goodsmodel');

        $reviewId = $this->input->get_post('evaId');
        $isReview = $this->input->cookie('is_review' . $reviewId);
        if ($isReview != 1) {
            $reviewZanNum = $this->goodsmodel->getReviewZanNum($reviewId);
            $this->goodsmodel->addReviewZanNum($reviewZanNum + 1, $reviewId);
            $this->input->set_cookie("is_review" . $reviewId, 1, time() + 86400 * 365);
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     *优惠券读取
     */
    public function muCoupon($page = 1)
    {
        $this->L('usermodel');
        $page = ($page > 0) ? $page : 1;

        /*取已完成的订单列表*/
        $where[] = '(is_show = 1 or user_id = "' . $this->userId . '")'; //已完成订单搜索条件
        $couponNum = $this->usermodel->getActivityDiscountCodesNum($where);
        $perPage = 10;
        $pageArr = array(
            'page' => $page,
            'total' => $couponNum,
            'url' => '//useraction/muCoupon/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        $couponList = $this->usermodel->ActivityDiscountCodesList($page, $perPage, $where);

        //循环读取优惠码信息
        foreach ($couponList as $key => $value) {
            //根据优惠码读取优惠码规则
            $dcr = $this->usermodel->getDiscountCodeRuleId($value->dc_id);
            //判断优惠码规则是否存在
            if (!empty($dcr)) {
                //累加赋值
                $couponList[$key]->dc_title = $dcr->dc_title;
                $couponList[$key]->acti_title = $dcr->acti_title;
                $couponList[$key]->dc_money = $dcr->dc_money;
                $couponList[$key]->dc_meet_money = $dcr->dc_meet_money;
            }
        }
        $data = array(
            'couponList' => $couponList,
            'userInfo' => $this->userInfo,
            'pageHtml' => $pageHtml,
        );
        $this->load->view('user/muCoupon', $data);
    }

    /**
     *ajax添加收藏
     */
    public function  addCollect()
    {
        $this->L('usermodel');
        $type = $this->input->get_post('type'); //1-产品、2-文章
        $id = $this->input->get_post('id');

        //判断用户是否登入
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        if ($userId == '') {
            echo '4'; //存在
            exit;
        }

        //产品收藏
        if ($type == 1) {

            //判断是否收藏
            $where = array( //组装查询条件
                'user_id= "' . $this->userId . '"',
                'goods_id= "' . $id . '"',
                'type= "' . $type . '"',

            );
            $goods = $this->usermodel->getCollect($where);

            if (!empty($goods)) {
                echo '3'; //存在
                exit;
            }

            $this->L('goodsmodel');
            $goodsInfo = $this->goodsmodel->getGoodsInfo($id);

            if (empty($goodsInfo)) {
                echo '2'; //失败
                exit;
            }
            //数组组装
            $inData = array(
                'user_id' => $this->userId,
                'goods_id' => $goodsInfo->goods_id,
                'goods_title' => $goodsInfo->goods_name,
                'goods_thumb' => $goodsInfo->goods_thumb,
                'type' => $type,
                'goods_money' => $goodsInfo->shop_price,
                'add_time' => time(),
            );
            $ct_id = $this->usermodel->addCollect($inData);

            //判断是否添加成功
            if (!empty($ct_id) && $ct_id > 0) {
                echo '1'; //成功
                exit;
            } else {
                echo '2'; //失败
                exit;
            }
        } else if ($type == 2) {
            //判断是否收藏
            $where = array( //组装查询条件
                'user_id= "' . $this->userId . '"',
                'goods_id= "' . $id . '"',
                'type= "' . $type . '"',

            );
            $articl = $this->usermodel->getCollect($where);
            if (!empty($articl)) {
                echo '3'; //存在
                exit;
            }

            $this->L('articlemodel');
            $articleInfo = $this->articlemodel->getArticleInfo($id);

            if (empty($articleInfo)) //判断是否有信息
            {
                echo '2'; //失败
                exit;
            }

            //数组组装
            $inData = array(
                'user_id' => $this->userId,
                'goods_id' => $articleInfo[0]->art_id,
                'goods_title' => $articleInfo[0]->art_title,
                'type' => $type,
                'add_time' => time(),
            );

            $ct_id = $this->usermodel->addCollect($inData);

            //判断是否添加成功
            if (!empty($ct_id) && $ct_id > 0) {
                echo '1'; //成功
                exit;
            } else {
                echo '2'; //失败
                exit;
            }
        }
        echo '2';
        exit;
    }

    /**
     *读取用户收藏产品信息
     */
    public function getCollectList($page = 1)
    {
        $this->L('usermodel');
        $page = ($page > 0) ? $page : 1;

        /*取已完成的订单列表*/
        $where[] = 'type = 1'; //组装 查询条件
        $where[] = 'user_id = "' . $this->userId . '"'; //组装 查询条件
        $collectNum = $this->usermodel->getCollectNum($where);

        $perPage = 10;
        $pageArr = array(
            'page' => $page,
            'total' => $collectNum,
            'url' => '//useraction/getCollectList/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );

        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        $collectList = $this->usermodel->getCollectList($page, $perPage, $where);

        $data = array(
            'collectList' => $collectList,
            'userInfo' => $this->userInfo,
            'pageHtml' => $pageHtml,
        );

        $this->load->view('user/myCollection', $data);
    }

    /**
     *读取收藏文章
     */
    public function  getCollectionArticleList($page = 1)
    {
        $this->L('usermodel');
        $page = ($page > 0) ? $page : 1;

        $where[] = 'type = 2'; //组装 查询条件
        $where[] = 'user_id = "' . $this->userId . '"'; //组装 查询条件
        $collectArticleNum = $this->usermodel->getCollectNum($where);

        $perPage = 10;
        $pageArr = array(
            'page' => $page,
            'total' => $collectArticleNum,
            'url' => '//useraction/getCollectionArticleList/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );

        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        $collectList = $this->usermodel->getCollectList($page, $perPage, $where);
        $data = array(
            'collectList' => $collectList,
            'userInfo' => $this->userInfo,
            'pageHtml' => $pageHtml,
        );
        $this->load->view('user/myCollectionArticle', $data);
    }

    /**
     * 根据ID删除收藏
     * */
    public function deleteCollect()
    {
        $this->L('usermodel');
        $ct_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($ct_id)) {
            $ctarray = explode(',', $ct_id);
            foreach ($ctarray as $item) {
                $boolCt = $this->usermodel->deleteCollect($item);
            }
            if ($boolCt) {
                msg('删除成功！', base_url('/system/myCollectionArticle/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('/system/myCollectionArticle/'), 2, 2000);
            }
        }
    }

    /**
    *个人秀
     */
    public  function myShow($page = 1){
        $this->L('usermodel');
        $act = empty($act) ? '' : $act;  //类型：add-添加、edit-修改
        $userId = $this->userId;  //用户ID
        $showNum = $this->usermodel->getPerShowNum($userId);
        //分页
        $perPage = 6;
        $pageArr = array(
            'page' => $page,
            'total' => $showNum,
            'url' => base_url() . '/useraction/myShow/', //路径
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $showHtml = $pageClass->data($pageArr);
        $showList = $this->usermodel->getPerShowList($page, $perPage,$userId);

        $data = array(
            'userInfo' => $this->userInfo,
            'act' => $act,
            'showHtml'=>$showHtml,
            'showList'=>$showList,
        );
        $this->load->view('user/myShow',$data);
    }

    /**
    *添加个人秀信息
     */
    public  function addMyShow($preids=''){

        $this->L('usermodel');
        $act = $this->input->post('act'); //主键ID
        $preId = $this->input->post('preid'); //主键ID
        $preTitle = $this->input->post('pretitle'); //标题
        $act = empty($act) ? '' : $act;  //类型：add-添加、edit-修改
        $userId = $this->userId;  //用户ID
        $inData = array(
            'pre_title'=>$preTitle,
            'user_id' =>$userId,
            'last_time' =>time(),
            'add_time' =>time(),
        );

        /*保存商品缩略图*/
        if (!empty($_FILES['preimg']['name'])) {
            $advUpload = @uploadImg();
//            if (!empty($advUpload['upload_data'])) {
            if (!empty($advUpload)) {
                $x  =  $this->input->post('left'); //客户端选择区域左上角x轴坐标
                $y  =  $this->input->post('top'); //客户端选择区域左上角y轴坐标
                $w  =  $this->input->post('right'); //客户端选择区 的宽w
                $h  =  $this->input->post('bottom'); //客户端选择区 的高h
                $im  = imagecreatefromjpeg($advUpload); // 读取需要处理的图片
                $newim  = imagecreatetruecolor(100,100); //产生新图片 100 100 为新图片的宽和高
                imagecopyresampled($newim,$im,0,0,$x,$y,100,100,$w,$h );
                //参数[1] [2] [3][4] [5] [6] [7]  [8]  [9] [10]
                //[5]  客户端选择区域左上角x轴坐标
                //[6]  客户端选择区域左上角y轴坐标
                //[7]  生成新图片的宽
                //[8]  生成新图片的高
                //[9]  客户端选择区 的宽
                //[10] 客户端选择区 的高
                imagejpeg($newim,$advUpload);
                imagedestroy($im);
                imagedestroy($newim);
             $inData['pre_img']=$advUpload;
            }
        }

        if(!empty($preid))  //主键ID不为空进行赋值
        {
            $inData['pre_id']=$preId;
        }
        if($act=='add') //添加
        {
           $preId = $this->usermodel->addPersonalShow($inData);
            if (!empty($preId)) {
                msg('添加成功！', base_url('/useraction/myShow/'), 2, 2000);
            } else {
                msg('添加失败！', base_url('/useraction/myShow/'), 2, 2000);
            }
        }else if($act=='edit')//修改
        {
            $inData['last_time'] = time();
            $preId =  $this->usermodel->editPersonalShow($inData);
            if (!empty($preId)) {
                msg('修改成功！', base_url('/useraction/myShow/'), 2, 2000);
            } else {
                msg('修改失败！', base_url('/useraction/myShow/'), 2, 2000);
            }
        }
        $personalshow=array();
        if(!empty($preids))
        {
            $personalshow =  $this->usermodel->getPerShowId($preids);
            $act ='edit';
        }
        $data = array(
            'userInfo' => $this->userInfo,
            'act' => $act,
            'personalshow' => $personalshow,
        );
        $this->load->view('user/myShow',$data);

    }

    /*删除个人秀*/
    public function delMyShow()
    {
        $this->L('usermodel');
        $id = $this->input->get_post('id');
        $this->usermodel->delMyShow($id);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */