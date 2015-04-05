<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 自定义Controller类
 *
 * @author             小鸟
 * @createtime         2014-05-07
 * @since             Version 1.0
 */

class MY_Controller extends CI_Controller
{
    public $systemList;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'main', 'source'));
        if(!session_id())session_start();
    }

    /**
     * checkLogin 检查是否登录
     */
    public function checkLogin()
    {
        $isLoginHtml = strpos('anything' . uri_string(), 'login.html'); //显示登录窗口时不验证是否登录
        $isLogin = strpos('anything' . uri_string(), 'useraction/login'); //显示登录窗口时不验证是否登录
        $isAjaxGetCode = strpos('anything' . uri_string(), 'useraction/ajaxGetVerify'); //ajax获取验证码时不验证是否登录
        $isAjaxLogin = strpos('anything' . uri_string(), 'useraction/ajaxLogin'); //ajax提交登录信息时不验证是否登录
        $isRegister = strpos('anything' . uri_string(), 'useraction/register'); //注册时不验证是否登录
        $isEmailRetrieveForgotPwd = strpos('anything' . uri_string(), 'useraction/emailRetrieveForgotPwd'); //注册时不验证是否登录
        $addCollect   = strpos('anything'.uri_string(),'useraction/addCollect');//ajax提交收藏信息时不验证是否登录
        $addCollect   = strpos('anything'.uri_string(),'useraction/addCollect');//ajax提交收藏信息时不验证是否登录
         /*有记住密码时自动登录*/
        if (!empty($_COOKIE['remember_user_name'])) {
            $this->L('UserModel');
            $userInfo = $this->UserModel->getUserInfoFromUserName($_COOKIE['remember_user_name']);
            /*登录通过*/
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

            /*更新用户最后登录时间和登录IP*/
            $userIp = $this->get_real_ip();
            $filter = array(
                'userIp' => $userIp,
                'nowTime' => time(),
                'userId' => $userInfo->user_id,
            );

            $this->UserModel->updateUserLastLoginTimeAndIp($filter);
        }
//print_r($_SESSION);
        if ($isLoginHtml == False && $isLogin == False && $isAjaxLogin == False && $isEmailRetrieveForgotPwd == False && $isAjaxGetCode == False && $isRegister == False &&$addCollect==False && $_SESSION['user_id'] == '') {
            redirect('login.html');
        }
    }

    /**
     * 生成验证码
     */
    public function verify_image()
    {
        $this->load->helper('captcha');
        $allStr = 'QWERTYUIOPLKJHGFDSAZXCVBNM';
        $randStr = $allStr[rand(0, 9)] . $allStr[rand(0, 9)] . $allStr[rand(0, 9)] . $allStr[rand(0, 9)];
        $vals = array(
            'word' => $randStr,
            'img_path' => './captcha/',
            'img_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/captcha/',
            'img_width' => 80,
            'img_height' => 40,
            'expiration' => 7200
        );

        //删除两个小时以前生产的缩略图文件
        $this->deldir($vals['img_path'], $vals['expiration']);

        //生成新的缩略图
        $cap = create_captcha($vals);
        return $cap;
    }

    /**
     * MD5加密
     */
    public function setMd5($str)
    {
        $md5Prefix = $this->config->config['myconfig']['md5_prefix'];
        $str = md5($md5Prefix . md5($str) . $md5Prefix);
        return $str;
    }

    /**
     * 删除文件夹下所有文件
     * paramerter:
     *      $dir:文件夹名称（绝对路径）
     *      $delTime:设置删除的时间（当前时间 - 创建时间）
     */
    function deldir($dir = '', $delTime = 0)
    {
        if ($dir == '') {
            return false;
        }
        $delTime = 0; //设置删除时间

        $dh = opendir($dir);
        $nowTime = time();
        while ($file = readdir($dh)) {

            if ($file != "." && $file != "..") {
                $fullpath = $dir . "/" . $file;
                $fileTime = filectime($fullpath);
                $canDelTime = $nowTime - $fileTime;
                if (!is_dir($fullpath) && $canDelTime > $delTime) {
                    unlink($fullpath);
                }
            }
        }
        closedir($dh);
    }

    /**
     * 获得用户的真实IP
     */
    function get_real_ip()
    {
        $ip = false;
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match("^(10|172.16|192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    public function  __set($key, $value)
    {
        $this->$key = $value;
    }

}
