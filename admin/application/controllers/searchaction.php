<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class searchAction extends MY_Controller {

    function __construct(){
        parent::__construct();
    }

    public function index($action)
    {

    }

    /*商品快搜*/
    public function searchGoods(){
        $data               = array();
        $this->load->view('search/searchgoods',$data);
    }


}

/* End of file searchaction.php */
/* Location: ./application/controllers/searchaction.php */