<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Initial extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->load->model('Comment_model');
    }
	

	public function index()
	{
		echo '个人中心--完善资料';
		//redirect('/m/info');
	}

}