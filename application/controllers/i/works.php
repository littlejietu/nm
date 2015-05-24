<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usernum_model');
        $this->load->model('Fans_model');
        $this->load->model('Album_model');
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

		// $o = $this->User_model->get_info_by_id($userid);
		$list = $this->Album_model->get_list(array('userid'=>$userid,'status'=>1));
		$result = array(
			'oUser' => $oUser,
			'list' => $list,
			);
		$this->load->view('i/works',$result);
	}
	

}