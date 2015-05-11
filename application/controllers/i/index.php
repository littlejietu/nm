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
		// $o = $this->User_model->get_info_by_id($userid);
		$result = array(
			//'o' => $o,
			);
		$this->load->view('i/index',$result);
	}

	

}