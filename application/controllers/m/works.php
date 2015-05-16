<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }
	

	public function index()
	{
		$id = _get_key_val($this->input->get('id'),true);
		$o = $this->Order_model->get_info_by_id($id);
		$result = array(
			'o' => $o,
			);
		
		$this->load->view('m/works',$result);
	}


}