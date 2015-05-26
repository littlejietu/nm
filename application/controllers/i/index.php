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
		
		$result = array(
			'oUser' => $oUser,
			);
		$view = 'i/index';
		if($oUser['usertype']==2)
			$view = 'i/index_ins';
		$this->load->view($view,$result);
	}

}