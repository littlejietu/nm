<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class articleAction extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

	public function index($page = '1',$classId = '2'){
        $this->L('articlemodel');

        //获取POST过来的分类ID
        $postClassId    = $this->input->get_post('classId');
        $classId        = empty($postClassId)?$classId:$postClassId;

        /*取文章列表*/
        $classIdStr     = getChildClass($classId);
        $artNum         = $this->articlemodel->getArticleNum($classIdStr);
        //分页
        $perPage        = 20;
        $pageArr        = array(
            'page'          => $page,
            'total'         => $artNum,
            'url'           => base_url().'index.php/articleaction/index/',
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
        //取当前页信息
        $articleList    = $this->articlemodel->getArticleListFromPage($classIdStr,$page,$perPage);
        $data           = array(
            'articleList'   => $articleList,
            'pageHtml'      => $pageHtml,
            'classId'       => $classId,
            'classList'       => $this->makeArticleList(),//取信息分类
        );

        $this->load->view('article/articlelist',$data);
	}

    /*添加信息*/
	public function addArticle($id = ''){
        $this->L('articlemodel');
        $act                    = empty($_POST['act'])?'':$_POST['act'];
        if($act=='addArticle'){
            $title                  = $_POST['title'];
            $classId                = $_POST['class'];
            $artIntro               = $_POST['art_intro'];
            $sort                   = $_POST['sort'];
            $isRmd                  = $_POST['is_rmd'];
            $isShow                 = $_POST['is_show'];
            $arturl                 = $_POST['art_url'];
            $content                = htmlspecialchars($_POST['editorValue']);
            $addInfo                = array(
                'art_title'             => $title,
                'art_class_id'          => $classId,
                'art_intro'             => $artIntro,
                'sort'                  => $sort,
                'is_rmd'                => $isRmd,
                'art_url'               =>$arturl,
                'is_show'               => $isShow,
                'art_content'               => $content,
                'add_time'      => time(),
                'last_update'   => time(),
            );

            //图片上传至oss
            if(!empty($_FILES['art_pic']['name'])){
                $artPic                 = uploadOss('',$_FILES['art_pic']);
                $addInfo['art_img']     = $artPic['upload_data'];
            }

            if($id){
                //更新信息
                unset($addInfo['add_time']);
                $this->articlemodel->updateArticle($addInfo,$id);
                redirect('articleaction/addArticle/'.$id);
            }else{
                //插入新信息
                $this->articlemodel->addArticle($addInfo);
                redirect('articleaction/addArticle');
            }
        }

        //取信息分类
        $data['classList']          = $this->makeArticleList();

        /*取信息详细信息*/
        if($id){
            $articleInfo                = $this->articlemodel->getArticleInfo($id);
            $data['articleInfo']        = $articleInfo;
        }


        $this->load->view('article/addarticle',$data);
	}

    /*详细信息*/
	public function detail($id=''){
        $this->L('articlemodel');
        if($id == ''){
            show_404();
        }

        /*根据用户权限不同，取信息，并转义CONTENT字段*/
        $userLevel                  = $this->session->userdata('user_level');
        $userId                     = $this->session->userdata('admin_id');
        $detail                     = $this->articlemodel->getDetail($id,$userLevel,$userId);
        if(!empty($detail->art_content)){
            $detail->art_content        = htmlspecialchars_decode($detail->art_content,ENT_COMPAT);
        }

        /*标记此信息已被该用户阅读*/
        $reader                     = explode(',',$detail->is_read);
        if(empty($reader[0])){
            $isRead = $userId;
        }elseif(!in_array($userId,$reader)){
            array_push($reader,$userId);
            $isRead = implode(',',$reader);
        }else{
            $isRead = implode(',',$reader);
        }
        $this->articlemodel->changeReadType($id,$isRead);



        $data                       = array(
            'detail'                    => $detail,
        );
        $this->load->view('article/articledetail',$data);
	}

    /*删除信息*/
    public function delArticle(){
        $this->L('articlemodel');
        $id             = $this->input->get_post('id');
        if($id){
            $this->articlemodel->delArticle($id);
        }
    }

    /*取文章分类信息并组合显示*/
    private function makeArticleList(){
        $this->L('articlemodel');
        $classList              = $this->articlemodel->getClassList();
        /*组合分类的显示*/
        foreach($classList as $k => $v){
            $realIdArr                  = explode(',',$v->cat_real_id);
            $realIdArrLength            = count($realIdArr);
            $tempStr                    = '';
            for($i = 1; $i < $realIdArrLength; $i++){
                $tempStr                .= '|--';
            }
            $classList[$k]->cat_name    = $tempStr.$v->cat_name;
        }
        array_shift($classList);

        return $classList;
    }

    /*
    * 友情链接
    * */
    public  function  FriendlyLinksList($page=1)
    {
        $this->L('articlemodel');
        $friendlyLinksNum = $this->articlemodel->getFriendlyLinksNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $friendlyLinksNum,
            'url' => base_url() . 'index.php/articleaction/FriendlyLinksList/', //路径
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5, //分页显示多长
            'isFirst' => 1, //是否显示首页尾页
            'isprev' => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass' => 'sy', //首页的class
            'endClass' => 'my', //尾页的class
        );
        $this->load->library('page');
        $pageClass = new page();
        $friendlyLinksHtml = $pageClass->data($pageArr);
        $friendlyLinksList = $this->articlemodel->getFriendlyLinks($page, $perPage);

        $data=array(
            'friendlyLinksList'=>$friendlyLinksList,
            'friendlyLinksHtml'=>$friendlyLinksHtml,
        );
        $this->load->view('article/friendlylinkslist',$data);
    }

    /*
     * 添加、修改友情链接
     * */
    public  function  addFriendlyLinks($flid='')
    {
        $this->L('articlemodel');

        $act        = $this->input->get_post('act');
        $flids      = $this->input->get_post('flid');
        $flid       = !empty($flids)?$flids:$flid; //判断ID是get提交还是post提交
        $fltitle    = $this->input->get_post('fltitle');
        $flurl      = $this->input->get_post('flurl');
        $sort       = $this->input->get_post('sort');
        $isshow     = $this->input->get_post('isshow');

        $inData = array(
            'fl_title'      =>$fltitle,
            'fl_url'        =>$flurl,
            'sort'          =>$sort,
            'is_show'       =>$isshow,
            'add_time'      =>time(),
        );
        //添加操作
        if($act == 'addFriendlyLinks' && empty($flid))
        {
              $boolflid =  $this->articlemodel->addFriendlyLinks($inData);
            if($boolflid)
            {
                msg('添加成功！', base_url('index.php/articleaction/FriendlyLinksList/'), 2, 2000);
            }
            else
            {
                msg('添加失败！', base_url('index.php/articleaction/FriendlyLinksList/'), 2, 2000);
            }
        }

        //修改操作
        if($act == 'editFriendlyLinks' && !empty($flid))
        {
            $boolflid =  $this->articlemodel->updateFriendlyLinks($flid,$inData);
            if($boolflid)
            {
                msg('修改成功！', base_url('index.php/articleaction/FriendlyLinksList/'), 2, 2000);
            }
            else
            {
                msg('修改失败！', base_url('index.php/articleaction/FriendlyLinksList/'), 2, 2000);
            }
        }

        if(!empty($flid))
        {
            $friendlylinks = $this->articlemodel->getFriendlyLinksId($flid);
        }

        $data=array(
            'friendlylinks'=>!empty($friendlylinks)?$friendlylinks[0]:array(),
            'act'=>!empty($flid)?'edit':'',
        );

        $this->load->view('article/addfriendlylinks',$data);
    }

    /*
     * 删除友情链接
     * */
    public  function  delFriendlyLinks()
    {
        $this->L('articlemodel');
        $flid      = $this->input->get_post('id');
        if(!empty($flid))
        {
         $boolflid =   $this->articlemodel->delFriendlyLinksId($flid);
            if($boolflid)
            {
            echo 1;
            }
            exit;
        }
      }

    /*
    * 门店管理
    * */
    public  function  ShopManageList($page=1)
    {
        $this->L('articlemodel');
        $shopManageNum = $this->articlemodel->getShopManageNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $shopManageNum,
            'url' => base_url() . 'index.php/articleaction/ShopManageList/', //路径
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5, //分页显示多长
            'isFirst' => 1, //是否显示首页尾页
            'isprev' => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass' => 'sy', //首页的class
            'endClass' => 'my', //尾页的class
        );
        $this->load->library('page');
        $pageClass = new page();
        $shopManageHtml = $pageClass->data($pageArr);
        $shopManageList = $this->articlemodel->getShopManage($page, $perPage);

        $data=array(
            'shopManageHtml'=>$shopManageHtml,
            'shopManageList'=>$shopManageList,
        );
        $this->load->view('article/shopmanagelist',$data);
    }

    /*
     * 添加、修改门店管理
     * */
    public  function  addShopManage($smid='')
    {
        $this->L('articlemodel');
        $act        = $this->input->get_post('act');
        $smids      = $this->input->get_post('smid');
        $smid       = !empty($smids)?$smids:$smid; //判断ID是get提交还是post提交
        $smtitle    = $this->input->get_post('smtitle');
        $smintro    = $this->input->get_post('smintro');
        $sort       = $this->input->get_post('sort');
        $isshow     = $this->input->get_post('isshow');

        $inData = array(
            'sm_title'        =>$smtitle,
            'sm_intro'        =>$smintro,
            'sort'          =>$sort,
            'is_show'       =>$isshow,
            'add_time'      =>time(),
        );
        //添加操作
        if($act == 'addShopManage' && empty($smid))
        {
            $boolflid =  $this->articlemodel->addShopManage($inData);
            if($boolflid)
            {
                msg('添加成功！', base_url('index.php/articleaction/ShopManageList/'), 2, 2000);
            }
            else
            {
                msg('添加失败！', base_url('index.php/articleaction/ShopManageList/'), 2, 2000);
            }
        }

        //修改操作
        if($act == 'editShopManage' && !empty($smid))
        {
            $boolflid =  $this->articlemodel->updateShopManage($smid,$inData);
            if($boolflid)
            {
                msg('修改成功！', base_url('index.php/articleaction/ShopManageList/'), 2, 2000);
            }
            else
            {
                msg('修改失败！', base_url('index.php/articleaction/ShopManageList/'), 2, 2000);
            }
        }

        if(!empty($smid))
        {
            $shopManage = $this->articlemodel->getShopManageId($smid);
        }

        $data=array(
            'shopManage'=>!empty($shopManage)?$shopManage[0]:array(),
            'act'=>!empty($smid)?'edit':'',
        );

        $this->load->view('article/addshopmanage',$data);
    }


    /*
     * 删除门店管理
     * */
    public  function  delShopManage()
    {
        $this->L('articlemodel');
        $msid      = $this->input->get_post('id');
        if(!empty($msid))
        {
            $boolflid =   $this->articlemodel->delShopManageId($msid);
            if($boolflid){
                echo 1;
            }
            exit;
        }
    }

    /*
    * 订阅邮件管理
    * */
    public  function  SubscribeEmailList($page=1)
    {
        $this->L('articlemodel');
        $subscribeEmailNum = $this->articlemodel->getSubscribeEmailNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $subscribeEmailNum,
            'url' => base_url() . 'index.php/articleaction/SubscribeEmailList/', //路径
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5, //分页显示多长
            'isFirst' => 1, //是否显示首页尾页
            'isprev' => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass' => 'sy', //首页的class
            'endClass' => 'my', //尾页的class
        );
        $this->load->library('page');
        $pageClass = new page();
        $subscribeEmailHtml = $pageClass->data($pageArr);
        $subscribeEmailList = $this->articlemodel->getSubscribeEmail($page, $perPage);

        $data=array(
            'subscribeEmailHtml'=>$subscribeEmailHtml,
            'subscribeEmailList'=>$subscribeEmailList,
        );
        $this->load->view('article/subscribeemaillist',$data);
    }

    /*
     * 添加、修改订阅邮件
     * */
    public  function  addSubscribeEmail($seid='')
    {
        $this->L('articlemodel');
        $act        = $this->input->get_post('act');
        $seids      = $this->input->get_post('seid');
        $seid       = !empty($seids)?$seids:$seid; //判断ID是get提交还是post提交
        $seemail    = $this->input->get_post('seemail');
        $isshow     = $this->input->get_post('isshow');

        $inData = array(
            'se_email'        =>$seemail,
            'is_show'       =>$isshow,
            'add_time'      =>time(),
        );
        //添加操作
        if($act == 'addSubscribeEmail' && empty($seid))
        {
            $boolflid =  $this->articlemodel->addSubscribeEmail($inData);
            if($boolflid)
            {
                msg('添加成功！', base_url('index.php/articleaction/SubscribeEmailList/'), 2, 2000);
            }
            else
            {
                msg('添加失败！', base_url('index.php/articleaction/SubscribeEmailList/'), 2, 2000);
            }
        }

        //修改操作
        if($act == 'editSubscribeEmail' && !empty($seid))
        {
            $boolflid =  $this->articlemodel->updateSubscribeEmail($seid,$inData);
            if($boolflid)
            {
                msg('修改成功！', base_url('index.php/articleaction/SubscribeEmailList/'), 2, 2000);
            }
            else
            {
                msg('修改失败！', base_url('index.php/articleaction/SubscribeEmailList/'), 2, 2000);
            }
        }

        if(!empty($seid))
        {
            $subscribeEmail = $this->articlemodel->getSubscribeEmailId($seid);
        }
        $data=array(
            'subscribeEmail'=>!empty($subscribeEmail)?$subscribeEmail[0]:array(),
            'act'=>!empty($seid)?'edit':'',
        );

        $this->load->view('article/addsubscribeemail',$data);
    }

    /*
     * 删除订阅邮件
     * */
    public  function  delSubscribeEmail()
    {
        $this->L('articlemodel');
        $meid      = $this->input->get_post('id');
        if(!empty($meid))
        {
            $boolflid =   $this->articlemodel->delSubscribeEmailId($meid);
            if($boolflid){
                echo 1;
            }
            exit;
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */