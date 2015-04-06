<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class onlinepayAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
	public function index()
	{
        $this->L('onlinepaymodel');
        $onlinepayList              = $this->onlinepaymodel->getOnlinepayList();//充值信息列表


        $data                       = array(
            'onlinepayList'            => $onlinepayList
        );
        $this->load->view('onlinepay/onlinepaylist',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */