<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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

		$oUser = $this->user_service->get_user_homeinfo($userid, $this->loginID);

		$oBody = array();
		if($oUser['usertype']==1)
		{
			$this->load->model('Userbody_model');
			$oBody = $this->Userbody_model->get_by_id($userid);
		}


		//精选作品
		$oGood = $this->user_service->get_user_goodwork($userid);

		$result = array(
			'oUser' => $oUser,
			'oGood' => $oGood,
			'oBody' => $oBody,
			);
		$view = 'i/index';
		if($oUser['usertype']==2)
			$view = 'i/index_ins';
		else if(in_array($oUser['usertype'],array(4,5)))
			$view = 'i/index_photo';
		$this->load->view($view,$result);
	}

}