<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usernum_model');
    }
	

	public function index($userid)
	{
		
		$oUser = $this->User_model->get_info_by_id($userid);
		$oUsernum = $this->Usernum_model->get_by_id($userid);
		if($oUsernum)
			$oUser = array_merge($oUsernum, $oUser);
		$result = array(
			'oUser' => $oUser,
			);
		$this->load->view('i/info',$result);
	}

}