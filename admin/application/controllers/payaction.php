<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
	public function index()
	{
        $this->L('paymodel');

        //获取支付列表
        $payList        = $this->paymodel->getPayList();

        $act            = $this->input->get_post('act');
        if($act == 'edit'){
            $sqlInfo        = array(
                'pay_amount'    => $this->input->get_post('pay_amount'),
                'pay_partner'   => $this->input->get_post('pay_partner'),
                'pay_key'       => $this->input->get_post('pay_key'),
            );
            $this->paymodel->editPay($sqlInfo);
        }

        $data           = array(
            'payList'       => $payList,
        );
        $this->load->view('system/paylist',$data);
	}
}