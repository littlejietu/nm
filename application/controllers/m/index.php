<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
	

	public function index()
	{
		//header('location:'.base_url('m/info') );
		$this->load->model('Ad_model');
		$adlist = $this->Ad_model->get_ads_by_code('member_banner');

		$this->load->model('Usernum_model');
		$o = $this->Usernum_model->get_by_id($this->thatUser['id']);

		//begin:右侧-推荐用户
		$right_usertype = 1;
		$right_sex = 1;
		if($this->loginUsertype == 1)
			$right_usertype = 2;
		if($this->loginUser['sex']==1)
			$right_sex = 2;
		$arrWhere = array('usertype'=>$right_usertype,'status'=>1,'userlevel'=>1,'sex'=>$right_sex);
		$feild = 'user.id,nickname,userlogo,company';
		$this->load->model('Recommend_model');
		$rightlist = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);
		//end:右侧-推荐用户

		$result = array(
			'o' => $o,
			'adlist' => $adlist,
			'rightlist' => $rightlist,
			);
		$this->load->view('m/index',$result);
	}

}