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

			$oUser = $this->User_model->get_info_by_id($userid);
			$oUsernum = $this->Usernum_model->get_by_id($userid);
			if($oUsernum)
				$oUser = array_merge($oUsernum, $oUser);
			

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