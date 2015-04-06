<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class articleAction extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /*信息列表页*/
    public function index($classId = '22', $page = '1')
    {
        if (empty($classId)) {
            show_404();
        }

        $this->L('articlemodel');

        //取所有分类的组合
        $classIdStr = getChildClass($classId);

        //取分类名
        $catName = $this->articlemodel->getCatName($classId);

        /*取信息总数*/
        $artNum = $this->articlemodel->getArtNum($classIdStr);

        //分页
        $page = ($page < 1) ? 1 : $page;
        $perPage = 6;
        $url = '/article/index/' . $classId . '/';
        $pageArr = array(
            'page' => $page,
            'total' => $artNum,
            'url' => $url,
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
        //取当前页信息
        $artList = $this->articlemodel->getArtList($classIdStr, $page, $perPage);

        /*取1+6条热门专区*/
        $remenList_1 = getList(24, 1, 0, 1, 1, 1);
        $remenList_6 = array();
        if (!empty($remenList_1)) {
            $remenList_1 = $remenList_1[0];
            $remenList_6 = getList(24, 6, $remenList_1->art_id, 1, 1, 1);
        }

        $data = array(
            'pageHtml' => $pageHtml,
            'artList' => $artList,
            'remenList_1' => $remenList_1,
            'remenList_6' => $remenList_6,
            'catName' => $catName,
        );
        $this->load->view('article/list', $data);
    }

    /*信息详细页*/
    public function articleDetail($id = '')
    {
        $this->L('articlemodel');
        /*取信息详细信息*/
        if ($id) {
            $articleInfo = $this->articlemodel->getArticleInfo($id);

            /*取1+6条热门专区*/
            $remenList_1 = getList(24, 1, 0, 1, 1, 1);
            $remenList_6 = array();
            if (!empty($remenList_1)) {
                $remenList_1 = $remenList_1[0];
                $remenList_6 = getList(24, 6, $remenList_1->art_id, 1, 1, 1);
            }

            /*增加阅读数*/
            if (!isset($_COOKIE['read' . $id])) {
                $nowNum = $articleInfo[0];
                $num = $nowNum->art_views;
                $num += 1;
                $this->articlemodel->addRead($id, $num);
                setcookie('read' . $id, 1, time() + 3600 * 24 * 365, '/');
            }

            //取分类名
            $catName = $this->articlemodel->getCatName($articleInfo[0]->art_class_id);

            $data = array(
                'articleInfo' => $articleInfo,
                'remenList_1' => $remenList_1,
                'remenList_6' => $remenList_6,
                'catName' => $catName,
            );
            $this->load->view('article/detail', $data);
        } else {
            show_404();
        }
    }

    /*ajax zan*/
    public function articleLike()
    {
        $this->L('articlemodel');

        $id = $this->input->get_post('id');
        if (!isset($_COOKIE['like' . $id])) {
            $articleInfo = $this->articlemodel->getArticleInfo($id);
            $nowNum = $articleInfo[0];
            $num = $nowNum->art_likes;
            $num += 1;
            $this->articlemodel->addLike($id, $num);
            setcookie('like' . $id, 1, time() + 3600 * 24 * 365, '/');
        }
    }

    /*邮箱保存*/
    public function  addSubscribeEmail()
    {
        $this->L('articlemodel');
        $seemail = $this->input->get_post('join_email');
        if(!empty($seemail))
        {
            $friendlylinks = $this->articlemodel->getSubscribeEmailName($seemail); //查询邮箱是否存在
            if(!empty($friendlylinks))
            {
                msg('订阅成功！', base_url('index.php'), 2, 2000);
            }
            else
            {
                $inData = array(
                    'se_email'        =>$seemail,
                    'is_show'       =>1,
                    'add_time'      =>time(),
                );
                $boolflid =  $this->articlemodel->addSubscribeEmail($inData);
                if($boolflid)
                {
                    msg('订阅成功！', base_url('index.php'), 2, 2000);
                }
                else
                {
                    msg('订阅失败！', base_url('index.php'), 2, 2000);
                }
            }
        }
    }

    //资讯频道页
    public function  articleIndex()
    {
        $this->L('articlemodel');
        //最新动态
        $latestNews = $this->articlemodel->getArtNewsTop(54, 4);

        //国际同步
        $inteclassIdStr = getChildClass(12); //取所有分类的组合
        $inteSynch = $this->articlemodel->getArtNewsTop($inteclassIdStr, 18);

        //粉丝会
        $fanswill = $this->articlemodel->getArtNewsTop(17, 7);

        //新品活动
        $newEvents = $this->articlemodel->getArtNewsTop(51, 7);

        //新品活动
        $expertReviews = $this->articlemodel->getArtNewsTop(52, 4);

        //设计师
         $designers = $this->articlemodel->getArtNewsTop(50, 7);

        //设计师
        $starArticle   = $this->articlemodel->getArtNewsTop(15, 11);

        //热门专区
        $hotArea   = $this->articlemodel->getArtNewsTop(24, 8);

        //活动视频
        $activeVideo  = $this->articlemodel->getArtNewsTop(53, 6);

        $this->L('advSpacesmodel');
        //资讯频道首页-中部
        $cenSpac = $this->advSpacesmodel->getSpacesId(10);
        if (!empty($cenSpac)) {
            $advCentral = $this->advSpacesmodel->getSpacesIdList($cenSpac[0]->adv_spaces_id, 1);
            foreach ($advCentral as $k => $v) {
                $advCentral[$k]->adv_spaces_height = $cenSpac[0]->adv_spaces_height;
                $advCentral[$k]->adv_spaces_width = $cenSpac[0]->adv_spaces_width;
            }
        }

        //资讯频道首页-底部
        $bottomSpac = $this->advSpacesmodel->getSpacesId(11);
        if (!empty($bottomSpac)) {
            $advBottom = $this->advSpacesmodel->getSpacesIdList($bottomSpac[0]->adv_spaces_id, 1);
            foreach ($advBottom as $k => $v) {
                $advBottom[$k]->adv_spaces_height = $bottomSpac[0]->adv_spaces_height;
                $advBottom[$k]->adv_spaces_width = $bottomSpac[0]->adv_spaces_width;
            }
        }

        $data = array(
            'latestNews'     => $latestNews,    //最新动态
            'inteSynch'      => !empty($inteSynch) ? $inteSynch : array(),    //国际同步
            'fanswill'       => !empty($fanswill) ? $fanswill : array(),//粉丝会
            'newEvents'      => !empty($newEvents) ? $newEvents : array(), //新品活动
            'expertReviews'  => !empty($expertReviews) ? $expertReviews : array(), //新品活动
            'designers'      => !empty($designers) ? $designers : array(),//设计师
            'starArticle'    => !empty($starArticle) ? $starArticle : array(),    //设计师
            'hotArea'        => !empty($hotArea) ? $hotArea : array(), //热门专区
            'activeVideo'    => !empty($activeVideo) ? $activeVideo : array(),//活动视频
            'advCentral'    => !empty($advCentral) ? $advCentral : array(),//资讯频道首页-中部
            'advBottom'    => !empty($advBottom) ? $advBottom : array(),//资讯频道首页-底部
        );

        $this->load->view('article/index', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */