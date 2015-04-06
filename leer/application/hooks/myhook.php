<?php
/**
 * Created by PhpStorm.
 * User: 小鸟
 * Date: 15-1-21
 * Time: 上午9:46
 */

class myHook{
    var $CI;

    function __construct(){
        $this->CI               = &get_instance();
    }

    /*获取用户购物车数量*/
    function getUserCartNum(){
        $this->CI->L('libmodel/myhookmodel','myhookmodel');
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        if(empty($userId)){
            $userCartNum            = 0;
        }else{
            $userCartNum            = $this->CI->myhookmodel->getUserCartNum($userId);
        }
        $newdata = array(
            'userCartNum'            => $userCartNum,
        );

        $this->CI->session->set_userdata($newdata);
    }

    /*取底部帮助信息*/
    function getFootArticle(){
        $this->CI->L('libmodel/myhookmodel','myhookmodel');
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        if(empty($userId)){
            $userCartNum            = 0;
        }else{
            $userCartNum            = $this->CI->myhookmodel->getUserCartNum($userId);
        }
        $newdata = array(
            'userCartNum'            => $userCartNum,
        );

        $this->CI->session->set_userdata($newdata);
    }

}