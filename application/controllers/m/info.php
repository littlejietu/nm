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
		$that_userid = _get_key_val($this->input->get('agid'), true);
		$that_usertype = $this->input->get('agusertype');
		
		if(!$that_userid || !$that_usertype)
		{
			$that_userid = $this->thatUser['id'];
			$that_usertype = $this->thatUser['usertype'];
		}

		//is_post()
		if ($this->input->is_post())
		{
			if($that_usertype==1)
				list($config, $data, $data_detail, $data_memo) = $this->m_model_config();
			else if( in_array($that_usertype, array(4,5)) )
				list($config, $data, $data_detail, $data_memo) = $this->m_photo_config();
			else if($that_usertype==2)
				list($config, $data, $data_detail, $data_memo) = $this->m_ins_config();

			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() === TRUE)
			{
				//保存数据库
				$this->User_model->update_info_by_id($that_userid, $data, $data_detail, $data_memo);
			}

		}//-is_post()

		//begin:右侧-推荐用户
		$right_usertype = 1;
		$right_sex = 1;
		if($this->loginUsertype == 1)
			$right_usertype = 2;
		if($this->loginUser['sex']==1)
			$right_sex = 2;
		$arrWhere = array('usertype'=>$right_usertype,'status'=>1,'userlevel'=>1,'sex'=>$right_sex);
		$feild = 'user.id,nickname,userlogo,company';
		$this->load->model('Recommend_model');
		$rightlist = $this->Recommend_model->get_user_list($arrWhere, $feild, 10);
		//end:右侧-推荐用户

		$o = $this->User_model->get_info_by_id($that_userid);
		$oSysModelstyle = _get_config('modelstyle');
		$oSysType = array();
		if(in_array($this->loginUsertype, array(1,2)))
		{
			$oSysType = _get_config('type');

			$oSysType = $oSysType[$this->loginUsertype];
		}
		$this->load->model('Userbody_model');
		$oBody = $this->Userbody_model->get_by_id($that_userid);
		$result = array(
			'o' => $o,
			'rightlist' => $rightlist,
			'oSysModelstyle' => $oSysModelstyle,
			'oSysType' => $oSysType,
			'oBody' => $oBody,
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

		$style = '';
		if(is_array($this->input->post('style')))
			$style = implode(',', $this->input->post('style'));

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
			'style'=>$style,
			'province_id'=>(int)$this->input->post('province_id'),
			'city_id'=>(int)$this->input->post('city_id'),
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
		if($this->input->post('nickname'))
			$data['nickname']=$this->input->post('nickname');

		return array($config, $data, $data_detail, $data_memo);


	}

	private function m_photo_config(){
		//验证规则		required必填项
		$config = array(
            array(
                 'field'   => 'sex', 
                 'label'   => '性别', 
                 'rules'   => 'trim|required'
              ),  
        );
		if(!$this->thatUser['nickname'])
			$config[] = array(
                 'field'   => 'nickname', 
                 'label'   => '艺名', 
                 'rules'   => 'trim|required'
              );
		//-验证规则

		$data = array(					
			'userlogo'=>$this->input->post('userlogo'),
			'realname'=>$this->input->post('realname'),					
			//'mobile'=>$this->input->post('mobile'),					
			'sex'=>$this->input->post('sex'),
			'city'=>$this->input->post('city'),
			'showimg'=>$this->input->post('showimg'),
			'showimg2'=>$this->input->post('showimg2'),
			'mobile'=>$this->input->post('mobile'),
		);

		$data_detail = array(
			'province_id'=>(int)$this->input->post('province_id'),
			'city_id'=>(int)$this->input->post('city_id'),
			);
		$data_memo = array(
			'brand'=>$this->input->post('brand'),
			'brandtype'=>$this->input->post('brandtype'),
			'memo'=>$this->input->post('memo'),
			'fee'=>$this->input->post('fee'),
			'servicetime'=>$this->input->post('servicetime'),
			'takenote'=>$this->input->post('takenote'),
			'bgimg'=>$this->input->post('bgimg'),
			//'video'=>$this->input->post('video'),					
			);
		if($this->input->post('nickname'))
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

		$type = '';
		if(is_array($this->input->post('type')))
			$type = implode(',', $this->input->post('type'));

		$data = array(					
			'userlogo'=>$this->input->post('userlogo'),
			'showimg'=>$this->input->post('showimg'),
			'realname'=>$this->input->post('realname'),
			'sex'=>$this->input->post('sex'),
		);

		$data_detail = array(
			'type'=>$type,
			);

		$data_memo = array(
			'memo'=>$this->input->post('memo'),
			'bgimg'=>$this->input->post('bgimg'),
			);
		if(!$this->thatUser['nickname'])
			$data['nickname']=$this->input->post('nickname');
				
		return array($config, $data, $data_detail, $data_memo);
	}

	public function add()
	{
		$insid = $this->loginID;
		$usertype = $this->input->get('usertype');
		if(!in_array($usertype, array(1,4,5)))
		{
			echo 'error';
			exit;
		}

		$id = $this->User_model->add_user_by_ins($insid, $usertype);

		redirect(base_url('/m/info?agid='._get_key_val($id).'&agusertype='.$usertype));



	}

	public function setbody(){

		if($this->input->is_post())
		{
			$id = $this->input->post('id');
			$userid = _get_key_val($id,true);
			$usertype = $this->input->post('t');

			if($userid)
			{
				$data_detail = array(
					'height'=>(int)$this->input->post('bd_height'),
					'bust'=>(int)$this->input->post('bd_bust'),
					'waist'=>(int)$this->input->post('bd_waist'),
					'hips'=>(int)$this->input->post('bd_hips'),
					'shoes'=>(int)$this->input->post('bd_shoes'),
					);
				$this->load->model('Userdetail_model');
				$this->Userdetail_model->update_by_where(array('userid'=>$userid),$data_detail);

				$data_body = array(
					'userid'=>$userid,
					'hipd'=>(int)$this->input->post('bd_hipd'),
					'hipe'=>(int)$this->input->post('bd_hipe'),
					'collarf'=>(int)$this->input->post('bd_collarf'),
					'shoulderg'=>(int)$this->input->post('bd_shoulderg'),
					'sleeveh'=>(int)$this->input->post('bd_sleeveh'),
					'sleevefull'=>(int)$this->input->post('bd_sleevefull'),
					'outseam'=>(int)$this->input->post('bd_outseam'),
					'inseamj'=>(int)$this->input->post('bd_inseamj'),
					'hatk'=>(int)$this->input->post('bd_hatk'),
					'wristl'=>(int)$this->input->post('bd_wristl'),
					'thighm'=>(int)$this->input->post('bd_thighm'),
					'calfn'=>(int)$this->input->post('bd_calfn'),
					'hair'=>$this->input->post('bd_hair'),
					'eye'=>$this->input->post('bd_eye'),
				);

				$this->load->model('Userbody_model');
				$this->Userbody_model->insert($data_body);
			}

			if($userid != $this->thatUser['id'])
				redirect('/m/info?agid='.$id.'&agusertype='.$usertype);
			else
				redirect('/m/info');


		}

	}

}