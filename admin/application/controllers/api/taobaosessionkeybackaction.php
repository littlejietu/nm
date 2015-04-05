<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class taobaosessionkeybackAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }

	public function index(){
        $myConfig               = $this->config->config;
        $secretKey              = $myConfig['myconfig']['tb_api']['secretkey'];
        $appKey                 = $myConfig['myconfig']['tb_api']['appkey'];
        // doc url = http://open.taobao.com/doc/detail.htm?spm=0.0.0.0.b6L55H&id=110
        // 签名规则为base64(md5(top_appkey+top_parameters+top_session+app_secret))
        print_r($_GET);
        $this->session->set_userdata($_GET['code']);
//        $str                    = $appKey.$_GET['top_parameters'].$_GET['top_session'].$secretKey;
//        $my_sign                = base64_encode(md5($str,true));
//        $top_sign               = $_GET['top_sign'];
//
//        if($my_sign == $top_sign){//到这里验证成功了
//            $params = parseParam(base64_decode($_GET['top_parameters']));
//
//            $ts = $params['ts']/1000+$params['expires_in'];
//
//            setcookie('user', $params['visitor_nick']);
//            setcookie('visitor_id', $params['visitor_id']);
//            $_SESSION['id'] = $params['visitor_id'];
//            $_SESSION['user'] = $params['visitor_nick'];
//            setcookie('sessionKey', $_GET['top_session'], $ts);
//
//            $_SESSION['sessionKey'] = $params['top_session'];
//            simplePage(
//                $params['visitor_nick'].'，授权成功！<br />授权将于'.date('Y/m/d H:i:s', $ts).'过期，届时需要重新授权。'
//                ,'setTimeout(function(){
//        window.location.href = "order_list.php";
//    },5000);');
//        }else{
//            echo '$sign='.$sign.'
//$top_sign='.$top_sign.'
//$my_sign='.$my_sign.'
//$str='.$str.'
//';
//            simplePage('系统参数验证失败！');
//        }
    }

}

/* End of file taobaoapiAction.php */
/* Location: ./application/controllers/api/tb/taobaoapiAction.php */