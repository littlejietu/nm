<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->input->is_post())
        {
            $this->load->service('user_service');
            $res = $this->user_service->login();
            $this->view->json($res);
        }
        
        $this->load->view('user/login');
    }

}
