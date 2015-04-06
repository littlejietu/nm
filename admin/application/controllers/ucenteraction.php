<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ucenterAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }

    /*编辑会员*/
    public function editUser($userId = ''){
        if(empty($userId)){
            show_404();
        }
        $this->L('ucentermodel');
        $act                = $this->input->get_post('act');
        if($act == 'edit'){
            $userName           = $this->input->get_post('user_name');
            $userNikename       = $this->input->get_post('user_nikename');
            $userPassword       = $this->input->get_post('user_password');
            $cUserPassword      = $this->input->get_post('c_user_password');
            $userMail           = $this->input->get_post('user_mail');
            $userRealName       = $this->input->get_post('user_real_name');
            $userSex            = $this->input->get_post('user_sex');
            $userTel            = $this->input->get_post('user_tel');
            $userLevel          = $this->input->get_post('userstep');
            $userProvince       = $this->input->get_post('user_province');
            $userCity           = $this->input->get_post('user_city');
            $userArea           = $this->input->get_post('user_area');
            $userAddress        = $this->input->get_post('user_address');
            $user_image         = '';

            $userPassword       = ($userPassword == '********')?'':$userPassword;

            /*判断密码与确认密码是否一致*/
            if($userPassword != $cUserPassword){
                msg('两次输入密码不一致！', base_url('ucenteraction/addUser/'), 2, 2000);
            }elseif(!empty($userPassword)){
                $userPassword       = self::setMd5($userPassword);
            }

            /*保存头像*/
            if (!empty($_FILES['user_image']['name'])) {
                $goodsUpload = @uploadOss('', $_FILES['user_image']);
                if (!empty($goodsUpload['upload_data'])) {
                    $user_image = $goodsUpload['upload_data'];
                }
            }

            /*查询用户名是否重复*/
            if($userName){
                $userNameInfo       = $this->ucentermodel->getUserInfoFromUserName($userName);
            }
            if(!empty($userNameInfo) && $userNameInfo->user_id != $userId){
                msg('用户名已存在！', base_url('ucenteraction/addUser/'), 2, 2000);
            }

            /*查询用户邮箱是否重复*/
            if($userMail){
                $userEmailInfo      = $this->ucentermodel->getUserInfoFromUserEmail($userMail);
            }
            if(!empty($userEmailInfo) && $userEmailInfo->user_id != $userId){
                msg('用户邮箱已存在！', base_url('ucenteraction/addUser/'), 2, 2000);
            }
            $userLevel = empty($userLevel)?0:$userLevel;
            $userLevel = $userLevel<10 ? 11:$userLevel; //11:模特

            /*保存信息*/
            $sqlInfo            = array(
                'user_name'         => $userName,
                'user_real_name'    => $userRealName,
                'user_mail'         => $userMail,
                'user_nikename'     => $userNikename,
                'user_integral'     => 0,
                'user_tel'          => $userTel,
                'user_level'        => $userLevel,
                'user_sex'          => $userSex,
                'user_image'        => $user_image,
                'user_province'     => $userProvince,
                'user_city'         => $userCity,
                'user_area'         => $userArea,
                'user_address'      => $userAddress,
                'add_time'          => time(),
                'last_update'       => time(),
            );
            if($userPassword){
                $sqlInfo['user_password']   = $userPassword;
            }

            $this->ucentermodel->updateUser($sqlInfo,$userId);
            msg('用户编辑成功！', base_url('useraction/indexuserlist/'), 2, 2000);
        }

        /*根据ID取会员详细信息*/
        $userInfo           = $this->ucentermodel->getUserId($userId);

        $data               = array(
            'userInfo'          => $userInfo,
        );

        $this->load->view('ucenter/adduser',$data);
    }

    /*添加会员*/
    public function addUser(){
        $this->L('ucentermodel');
        $act                = $this->input->get_post('act');
        if($act == 'add'){
            $userName           = $this->input->get_post('user_name');
            $userNikename       = $this->input->get_post('user_nikename');
            $userPassword       = $this->input->get_post('user_password');
            $cUserPassword      = $this->input->get_post('c_user_password');
            $userMail           = $this->input->get_post('user_mail');
            $userRealName       = $this->input->get_post('user_real_name');
            $userSex            = $this->input->get_post('user_sex');
            $userTel            = $this->input->get_post('user_tel');
            $userLevel          = $this->input->get_post('userstep');
            $userProvince       = $this->input->get_post('user_province');
            $userCity           = $this->input->get_post('user_city');
            $userArea           = $this->input->get_post('user_area');
            $userAddress        = $this->input->get_post('user_address');
            $user_image         = '';

            $userPassword       = ($userPassword == '********')?'':$userPassword;

            /*判断密码与确认密码是否一致*/
            if($userPassword != $cUserPassword){
                msg('两次输入密码不一致！', base_url('ucenteraction/addUser/'), 2, 2000);
            }elseif(!empty($userPassword)){
                $userPassword       = self::setMd5($userPassword);
            }

            /*保存头像*/
            if (!empty($_FILES['user_image']['name'])) {
                $goodsUpload = @uploadOss('', $_FILES['user_image']);
                if (!empty($goodsUpload['upload_data'])) {
                    $user_image = $goodsUpload['upload_data'];
                }
            }

            /*查询用户名是否重复*/
            if($userName){
                $userInfo           = $this->ucentermodel->getUserInfoFromUserName($userName);
            }
            if(!empty($userInfo)){
                msg('用户名已存在！', base_url('ucenteraction/addUser/'), 2, 2000);
            }

            /*查询用户邮箱是否重复*/
            if($userMail){
                $userEmailInfo      = $this->ucentermodel->getUserInfoFromUserEmail($userMail);
            }
            if(!empty($userEmailInfo)){
                msg('用户邮箱已存在！', base_url('ucenteraction/addUser/'), 2, 2000);
            }
            $userLevel = empty($userLevel)?0:$userLevel;
            $userLevel = $userLevel<10 ? 11:$userLevel; //11:模特

            /*保存信息*/
            $sqlInfo            = array(
                'user_name'         => $userName,
                'user_real_name'    => $userRealName,
                'user_mail'         => $userMail,
                'user_nikename'     => $userNikename,
                'user_integral'     => 0,
                'user_tel'          => $userTel,
                'user_level'        => $userLevel,
                'user_sex'          => $userSex,
                'user_image'        => $user_image,
                'user_province'     => $userProvince,
                'user_city'         => $userCity,
                'user_area'         => $userArea,
                'user_address'      => $userAddress,
                'add_time'          => time(),
                'last_update'       => time(),
            );
            if($userPassword){
                $sqlInfo['user_password']   = $userPassword;
            }

            $this->ucentermodel->insertUser($sqlInfo);
            msg('用户添加成功！', base_url('ucenteraction/addUser/'), 2, 2000);
        }

        $this->load->view('ucenter/adduser');
    }

    /**
     *改变用户的锁定状态
    */
    public function changeLock(){

        $this->L('ucentermodel');
        $lockType   = $_POST['lockType'];
        $userId     = $_POST['userId'];

        /*验证传递过来的lockType*/
        if($lockType != 0 && $lockType!= 1){
            echo json_encode('false');
            return;
        }

        /*验证传递过来的userid*/
        if(!is_numeric($userId)){
            echo json_encode('false');
            return;
        }

        /*改变lock值*/
        $filter = array(
            'userId'        => $userId,
            'is_lock'       => $lockType,
        );
        $this->ucentermodel->updateLock($filter);
        echo json_encode('success');
        return;
    }

    /*删除会员*/
    public function delUser(){
        $this->L('ucentermodel');
        $userId         = $this->input->get_post('userId');
        $this->ucentermodel->delUser($userId);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */