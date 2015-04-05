<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class isbuildingAction extends MY_Controller {

    function __construct(){
        parent::__construct();
    }

    /*信息列表页*/
    public function index()
    {
        $this->load->view('building');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */