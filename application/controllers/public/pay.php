<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }
	

	public function done()
	{
		$id = _get_key_val( $this->input->post('orderid'),true);
		$no = $this->input->post('orderno');

		$o = $this->Order_model->get_by_id($id);
		if($o && $o['no']==$no)
		{
			$oSysPaystatus = $this->config->item('get_paystatus');
			$this->Order_model->update_by_where(array('id'=>$id), array('paystatus'=>$oSysPaystatus[3]));

			echo '成功';exit;
		}
		else
		{

		}
	}

}