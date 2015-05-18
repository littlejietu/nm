<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fans extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Fans_model');
    }
	

	public function index()
	{
		$userid = $this->loginID;
		$page     = _get_page();
		$pagesize = 9;
		$arrParam = array();
		$arrWhere = array('fansuserid'=>$userid);		//条件

		$list = $this->Fans_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/Fans', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);
		
		$this->load->view('m/fans',$result);
	}

}