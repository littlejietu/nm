<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
	

	public function index()
	{
		$userid = $this->loginID;
		//is_post()
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
                array(
                     'field'   => 'usertype', 
                     'label'   => '用户类型', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'height', 
                     'label'   => '身高', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'weight', 
                     'label'   => '体重', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'bust', 
                     'label'   => '胸围', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'waist', 
                     'label'   => '腰围', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'hips', 
                     'label'   => '臀围', 
                     'rules'   => 'trim|required'
                  ),  
            );
			if(!$this->loginRealNickName)
				$config[] = array(
                     'field'   => 'nickname', 
                     'label'   => '昵称', 
                     'rules'   => 'trim|required'
                  );
			//-验证规则


            $this->form_validation->set_rules($config);
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					
					'usertype'=>$this->input->post('usertype'),
					'password'=>$this->input->post('password'),
					'userlogo'=>$this->input->post('userlogo'),
					'realname'=>$this->input->post('realname'),					
					'mobile'=>$this->input->post('mobile'),					
					'sex'=>$this->input->post('sex'),
					'city'=>$this->input->post('city'),					
				);

				$data_detail = array(
					'height'=>$this->input->post('height'),
					'weight'=>$this->input->post('weight'),
					'bust'=>$this->input->post('bust'),
					'waist'=>$this->input->post('waist'),
					'hips'=>$this->input->post('hips'),
					'shoes'=>$this->input->post('shoes'),
					'cup'=>$this->input->post('cup'),
					);
				$data_memo = array(
					'brand'=>$this->input->post('brand'),
					'brandtype'=>$this->input->post('brandtype'),
					'awards'=>$this->input->post('awards'),
					'fee'=>$this->input->post('fee'),
					'servicetime'=>$this->input->post('servicetime'),
					'takenote'=>$this->input->post('takenote'),
					'planeshot'=>$this->input->post('planeshot'),
					'tactivity'=>$this->input->post('tactivity'),
					'telead'=>$this->input->post('telead'),
					'magazine'=>$this->input->post('magazine'),					
					);
				if(!$this->loginRealNickName)
					$data['nickname']=$this->input->post('nickname');
  				
  				$data['id'] = $userid;
				//保存数据库
  				$this->User_model->update_info_by_id($userid, $data, $data_detail, $data_memo);
				
  			}//-form_validation TRUE

		}//-is_post()

		$o = $this->User_model->get_info_by_id($userid);
		$result = array(
			'o' => $o,
			);
		$this->load->view('m/info',$result);
	}

}