<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usernum_model');
    }
	

	public function index($userid)
	{
		//浏览
		$sysVisittype = _get_config('visittype');
		$this->load->service('User_service');
		$this->user_service->visit($userid, $this->loginID, $sysVisittype['home']);
		//-浏览

		//$this->load->service('User_service');
		$oUser = $this->user_service->get_user_homeinfo($userid, $this->loginID);



		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array('insid'=>$userid, 'status'=>1,'showimg<>'=>"''",'showimg2<>'=>"''");

		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere,'id,nickname,showimg,showimg2','addtime desc');

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('model', $arrParam);
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
		$this->load->view('i/model',$result);
	}
	

}