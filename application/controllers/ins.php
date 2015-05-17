<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ins extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $type = (int)$this->input->get('type');
        $type = $type==0?1:$type;
        
        $page     = _get_page();
        $pagesize = 15;
        $arrParam = array('type'=>$type);
        $arrWhere = array('status'=>1,'usertype'=>2);

        $list = $this->User_model->fetch_page($page, $pagesize, $arrWhere);
        //echo $this->User_model->db->last_query();die;
        

        //分页
        $pagecfg = array();
        $pagecfg['base_url']     = _create_url('ins', $arrParam);
        $pagecfg['total_rows']   = $list['count'];
        $pagecfg['cur_page'] = $page;
        $pagecfg['per_page'] = $pagesize;
        //$this->load->library('pagination');
        $this->pagination->initialize($pagecfg);
        $list['pages'] = $this->pagination->create_links();

        $result = array(
            'list' => $list,
            );


        $this->load->view('ins',$result);
    }

}
