<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usernum_model');
    }
	

	public function index($albumid)
	{

		$this->load->model('Album_model');
		$o = $this->Album_model->get_info_by_id($albumid);
		if($o)
		{
			$userid = $o['userid'];

			//浏览
			$sysVisittype = _get_config('visittype');
			$this->load->service('User_service');
			$this->user_service->visit($userid, $this->loginID, $sysVisittype['home']);
			//-浏览

			$this->load->service('User_service');
			$oUser = $this->user_service->get_user_homeinfo($userid, $this->loginID);
			

			$arrWhere = array('albumid'=>$albumid,'status'=>1);
			$this->load->model('Photo_model');
			$list = $this->Photo_model->get_list($arrWhere,'id,img,title');

			$result = array(
				'oUser' => $oUser,
				'list' => $list,
				);


			$this->load->view('i/photo',$result);

		}
		
	}

}