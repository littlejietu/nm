<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
    }
	

	public function index()
	{
		$userid = $this->loginID;
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array('userid'=>$userid);		//条件

		$list = $this->Client_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/client', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);

		//print_r($list);
		$this->load->view('m/client',$result);
	}

}