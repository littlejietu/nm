<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->model('Usernum_model');
    }
	

	public function index()
	{
		$get_paystatus = (int)$this->input->get('paystatus');
		$get_keyword = $this->input->post('keyword')?$this->input->post('keyword'):$this->input->get('keyword');
		if($get_keyword)
		{
			$arrParam['keyword']=$get_keyword;
		}

		$id = _get_key_val($this->input->get('id'),true);
		$o = $this->Usernum_model->get_by_id($this->loginID);
		$oSysPaystatus = $this->config->item('get_paystatus');
		$arrWhere = array('sellerid'=>$this->loginID,'status'=>1,'paystatus'=>$oSysPaystatus[2]);
		$list = $this->Order_model->get_list($arrWhere);
		$result = array(
			'o' => $o,
			'list' => $list,
			'keyword' => !empty($arrParam['keyword'])?$arrParam['keyword']:'',
			);
		
		$this->load->view('m/fund',$result);
	}


}