<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
	

	public function index()
	{
		$userid=3;
		$o = $this->User_model->get_info_by_id($userid);
		$result = array(
			'o' => $o,
			);
		$this->load->view('i/info',$result);
	}

}