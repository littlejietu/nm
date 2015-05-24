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
		$userid = $this->thatUser['id'];
		$that_usertype = $this->thatUser['usertype'];
		//is_post()
		if ($this->input->is_post())
		{
			if($that_usertype==1)
				list($config, $data, $data_detail, $data_memo) = $this->m_model_config();
			else if($that_usertype==2)
				list($config, $data, $data_detail, $data_memo) = $this->m_ins_config();

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === TRUE)
			{
				
				//保存数据库
				$this->User_model->update_info_by_id($userid, $data, $data_detail, $data_memo);
			}

		}//-is_post()

		$o = $this->User_model->get_info_by_id($userid);
		$result = array(
			'o' => $o,
			);
		$view = 'm/info';
		if($that_usertype==2)
			$view = 'm/info_ins';
		$this->load->view($view,$result);
	}

	private function m_model_config(){
		//验证规则		required必填项
		$config = array(
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
                 'field'   => 'BWH', 
                 'label'   => '三围', 
                 'rules'   => 'trim|required'
              ),
        );
		if(!$this->thatUser['nickname'])
			$config[] = array(
                 'field'   => 'nickname', 
                 'label'   => '昵称', 
                 'rules'   => 'trim|required'
              );
		//-验证规则
        
		$bust=$waist=$hips=0;
		$arrBWH = explode('-', $this->input->post('BWH')) ;
		if(count($arrBWH)>=1)
			$bust = $arrBWH[0];
		if(count($arrBWH)>=2)
			$waist = $arrBWH[1];
		if(count($arrBWH)>=3)
			$hips = $arrBWH[2];

		$data = array(					
			'userlogo'=>$this->input->post('userlogo'),
			'realname'=>$this->input->post('realname'),					
			//'mobile'=>$this->input->post('mobile'),					
			'sex'=>$this->input->post('sex'),
			'city'=>$this->input->post('city'),
			'showimg'=>$this->input->post('showimg'),
			'showimg2'=>$this->input->post('showimg2'),
			'qq'=>$this->input->post('qq'),					
		);

		$data_detail = array(
			'height'=>$this->input->post('height'),
			'weight'=>$this->input->post('weight'),
			'bust'=>$bust,
			'waist'=>$waist,
			'hips'=>$hips,
			'shoes'=>(int)$this->input->post('shoes'),
			'cup'=>(int)$this->input->post('cup'),
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
			'card'=>$this->input->post('card'),
			'bgimg'=>$this->input->post('bgimg'),
			'video'=>$this->input->post('video'),					
			);
		if(!$this->thatUser['nickname'])
			$data['nickname']=$this->input->post('nickname');

		return array($config, $data, $data_detail, $data_memo);


	}

	private function m_ins_config(){
		//验证规则
		$config = array(
            array(
                 'field'   => 'realname', 
                 'label'   => '联系人姓名', 
                 'rules'   => 'trim|required'
              ),  
            array(
                 'field'   => 'sex', 
                 'label'   => '性别', 
                 'rules'   => 'trim|required'
              ),
            array(
                 'field'   => 'memo', 
                 'label'   => '公司简介', 
                 'rules'   => 'trim|required'
              ),
        );
		if(!$this->thatUser['nickname'])
			$config[] = array(
                 'field'   => 'nickname', 
                 'label'   => '昵称', 
                 'rules'   => 'trim|required'
              );
		//-验证规则

		$data = array(					
			'userlogo'=>$this->input->post('userlogo'),
			'showimg'=>$this->input->post('showimg'),
			'realname'=>$this->input->post('realname'),
			'sex'=>$this->input->post('sex'),
		);

		$data_memo = array(
			'memo'=>$this->input->post('memo'),
			);
		if(!$this->thatUser['nickname'])
			$data['nickname']=$this->input->post('nickname');
				
		return array($config, $data, array(), $data_memo);
	}

}