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
		$usertype = (int)$this->input->get('t');
		if(!$usertype)
			$usertype = 1;
		//浏览
		$sysVisittype = _get_config('visittype');
		$this->load->service('User_service');
		$this->user_service->visit($userid, $this->loginID, $sysVisittype['home']);
		//-浏览

		//$this->load->service('User_service');
		$oUser = $this->user_service->get_user_homeinfo($userid, $this->loginID);



		$page     = _get_page();
		$pagesize = 20;
		$arrParam = array();
		$arrWhere = array('insid'=>$userid, 'status'=>2,'showimg<>'=>"''",'showimg2<>'=>"''");
		if($usertype)
		{
			$arrParam['t'] = $usertype;
			$arrWhere['usertype'] = $usertype;
		}

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
			'arrParam' => $arrParam,
			);
		$this->load->view('i/model',$result);
	}

	public function info($id)
	{
		$this->load->service('user_service');
		$oIns = $this->user_service->get_ins_homeinfo($id, $this->loginID);
		$oInfo = $oIns['modelinfo'];
		unset($oIns['modelinfo']);

		$oBody = array();
		if($oUser['usertype']==1)
		{
			$this->load->model('Userbody_model');
			$oBody = $this->Userbody_model->get_by_id($userid);
		}

		$result = array(
			'oUser' => $oIns,
			'oInfo' => $oInfo,
			'oBody' => $oBody,
			);
		$view = 'i/modelinfo';
		if(in_array($oInfo['usertype'],array(4,5)))
			$view = 'i/modelinfo_photo';
		$this->load->view($view,$result);
	}
	

}