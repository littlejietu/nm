<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cert extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Cert_model');
    }
	

	public function index()
	{
		$o = $this->Cert_model->get_by_id($this->loginID);
		
		$result = array(
			'o' => $o,
			);
		
		$this->load->view('m/cert',$result);
	}


}