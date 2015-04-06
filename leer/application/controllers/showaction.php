<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class showAction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    //个人秀列表
    public function showIndex($hottype=0,$page=1){
        $this->L('usermodel');
        $showNum = $this->usermodel->getPerShowNum();
        //分页
        $perPage = 6;
        $pageArr = array(
            'page' => $page,
            'total' => $showNum,
            'url' => base_url() . '/useraction/showIndex/', //路径
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
        $showList = $this->usermodel->getPerShowList($page, $perPage,$hottype);
        $data = array(
            'showHtml'=>$showHtml,
            'showList'=>$showList,
            'hottype'=>$hottype,
        );

        $this->load->view('show/list',$data);
    }

  //个人秀列表
    public function ajaxShowIndex(){
        $this->L('usermodel');
        $page = $this->input->get_post('page');
        $hottype = $this->input->get_post('hottype'); //接受 是否为热门信息
        $hottype = !empty($hottype)?'':$hottype; // 判断热门信息是否为空
        $showNum = $this->usermodel->getPerShowNum();
        //分页
        $perPage = 6;
        $pageArr = array(
            'page' => $page,
            'total' => $showNum,
            'url' => base_url() . '/useraction/ajaxShowIndex/', //路径
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
        $showList = $this->usermodel->getPerShowList($page, $perPage,$hottype);
        echo json_encode($showList);
        exit;
    }

    //个人详细
    public function getDetail($hottype=0,$preid='')
    {
        $this->L('usermodel');

        if(empty($preid))
        {
            show_404();
        }
        $perShow =  $this->usermodel->getPerShowId($preid); //根据主键ID获取详细信息

        //根据用户ID读取用户信息
        if(!empty($perShow))
        {
            $userInfo =  $this->usermodel->getUserInfoFromUserId($perShow->user_id);
            if(!empty($userInfo))
            {
                $perShow->user_name     = $userInfo->user_name;
                $perShow->user_province = $userInfo->user_province;
                $perShow->user_area     = $userInfo->user_area;
            }
        }
        //统计浏览数量操作
        $personalShowBrowse =  $this->usermodel->getPersonalShowBrowse($preid);
        if(!empty($_SESSION['user_id'])) //判断用户ID是否有值
        {
            if(count($personalShowBrowse)==5) //判断数量是否等于五
            {
                //删除最早一条数数据
                $this->usermodel->delPersonalShowBrowse($personalShowBrowse[0]->psb_id);
            }else
            {
                if(!isset($_COOKIE['personalshowbrowse' . $userInfo->user_id.$preid])){
                    $userInfo =  $this->usermodel->getUserInfoFromUserId($_SESSION['user_id']);
                    $inData   =array(
                        'user_id'   => $userInfo->user_id,
                        'per_id'    => $preid,
                        'user_name'=> $userInfo->user_name,
                        'user_photo'=> $userInfo->user_image,
                        'add_time'  => time(),
                    );
                    $this->usermodel->addPersonalShowBrowse($inData);
                    setcookie('personalshowbrowse' . $userInfo->user_id.$preid, 1, time() + 3600 * 24 * 90, '/');
                }
            }
        }

        //读取评论信息
        $personalshowguestbook =  $this->usermodel->getPersonalShowGuestbookId($preid);
        foreach($personalshowguestbook as $k=>$v){
        if(!empty($personalshowguestbook)){
            $userInfo =  $this->usermodel->getUserInfoFromUserId($personalshowguestbook[0]->user_id);
            if(!empty($userInfo))
            {
                $personalshowguestbook[$k]->user_name     = $userInfo->user_name;
                $personalshowguestbook[$k]->user_image    = $userInfo->user_image;
            }
        }
        }
        $data = array(
            'perShow'            =>$perShow,
            'personalShowBrowse' =>$personalShowBrowse,    //读取浏览记录
            'hottype'=>$hottype,
            'personalshowguestbook'=>$personalshowguestbook,
        );
        $this->load->view('show/detail',$data);
    }

    /*评论点赞*/
    public function addMyShowZanNum()
    {
        $this->L('usermodel');
        $preId = $this->input->get_post('id');
        if (!isset($_COOKIE['prelikes' . $preId])) {
            $prelikes = $this->usermodel->getMyShowZanNum($preId);
            $num =$prelikes+1;
            $this->usermodel->addMyShowZanNum($num,$preId);
            setcookie('prelikes' . $preId, 1, time() + 3600 * 24 * 365, '/');
        }
    }

    /*添加评论*/
    public  function addPersonalShowGuestbook(){

        $this->L('usermodel');
        $preId = $this->input->get_post('preId'); //个人秀ID
        $psgid = $this->input->get_post('psgid'); //回复主键ID
        $hottype = $this->input->get_post('hottype');
        $txtcontent = $this->input->get_post('txtcontent');

        //判断代码是否为空
        if(!isset($_SESSION['user_id'])){
            msg('用户未登录！', base_url('login.html'), 2, 2000);
        }

        //根据用户ID和个人秀主键ID获取评论信息
        $personalShowGuestbook = $this->usermodel->getPersonalShowGuestbookId($preId,$_SESSION['user_id']);

        if(!empty($personalShowGuestbook)&&!empty($psgid)) //判断是否有值
        {
            $inData = array(
               'psg_reply' =>$txtcontent,
                'last_time' =>time(),
            );
          $boolpsgid = $this->usermodel->editPersonalShowGuestbook($inData,$psgid);
            if($boolpsgid){
                msg('回复成功！', base_url().'/showaction/getDetail/'.$hottype.'/'.$preId, 2, 2000);
            }
            else
            {
                msg('回复失败！', base_url().'/showaction/getDetail/'.$hottype.'/'.$preId, 2, 2000);
            }
        }else if(empty($personalShowGuestbook)&&empty($psgid))
        {
            $inData = array(
                'per_id'     =>$preId, //个人秀主键ID
                'psg_comment'=>$txtcontent, //内容
                'user_id'    =>$_SESSION['user_id'], //用户ID
                'add_time'   =>time(),  //时间
            );

            $boolpsgid =  $this->usermodel->addPersonalShowGuestbook($inData);
            if($boolpsgid){
                msg('评论成功！', base_url().'/showaction/getDetail/'.$hottype.'/'.$preId, 2, 2000);
            }
            else
            {
                msg('评论失败！',  base_url().'/showaction/getDetail/'.$hottype.'/'.$preId, 2, 2000);
            }
        }

    }
}