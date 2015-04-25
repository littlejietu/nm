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
        // if ($this->loginUser['id'])
        // {
        //     redirect('/m/index');
        // }
        
        $this->load->view('user/login');
    }
}
