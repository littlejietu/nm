<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Comment_model');
    }
	

	public function index($userid)
	{
		
		$oUser = $this->User_model->get_info_by_id($userid);
		$oUsernum = $this->Usernum_model->get_by_id($userid);
		if($oUsernum)
			$oUser = array_merge($oUsernum, $oUser);

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('touserid'=>$userid);		//条件

		$list = $this->Comment_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('i/comment', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'oUser' => $oUser,
			'list' => $list,
		);
		$this->load->view('i/comment',$result);
	}

}