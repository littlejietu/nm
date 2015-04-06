<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class goodsReviewAction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * 评论列表
     */
    public function index($page = 1)
    {
        $this->L('goodsreviewmodel');
        $goodsSn                = $this->input->get_post('goods_sn');
        $reviewList             = array();      //当前分页评论列表
        $pageHtml               = '';           //分页
        /*取评论列表*/
        $goodsNum               = $this->goodsreviewmodel->getReviewNum($goodsSn);
        //分页
        $perPage                = 15;
        $pageArr                = array(
            'page'                  => $page,
            'total'                 => $goodsNum,
            'url'                   => 'sourceaction/goods/',
            'perPage'               => $perPage,
            'maxSize'               => 5,
            'isFirst'               => 1,
            'isprev'                => 1,
            'prevClass'             => 'syy',
            'nextClass'             => 'xyy',
            'firstClass'            => 'sy',
            'endClass'              => 'my',
        );
        $this->load->library('page');
        $pageClass              = new page();
        $pageHtml               = $pageClass->data($pageArr);

        $reviewList             = $this->goodsreviewmodel->getReviewListFromPage($page, $perPage, $goodsSn);


        $data                   = array(
            'reviewList'            => $reviewList,
            'pageHtml'              => $pageHtml,
        );
        $this->load->view('review/goodsreview', $data);
    }

    /*删除评论*/
    public function delReview(){
        $this->L('goodsreviewmodel');
        $reviewId               = $this->input->get_post('review_id');
        if($reviewId){
            $this->goodsreviewmodel->delReview($reviewId);
        }
    }

    /*评论加精*/
    public function setCream(){
        $this->L('goodsreviewmodel');
        $reviewId               = $this->input->get_post('review_id');
        $creamNum               = $this->input->get_post('creamNum');
        if($reviewId){
            $this->goodsreviewmodel->setCream($reviewId,$creamNum);
        }
    }
}

/* End of file goodsreviewaction.php */
/* Location: ./admin/application/controllers/goodsreviewaction.php */