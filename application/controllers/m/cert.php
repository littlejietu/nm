<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cert extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Cert_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		$that_usertype = $this->thatUser['usertype'];
		if ($this->input->is_post())
		{
			$res = $this->save();
			redirect(base_url('/m/cert?res='.$res));
			exit;
		}

		$o = $this->Cert_model->get_by_id($userid);

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

		$oSysBail = _get_config('bail');
		$sysBail = $oSysBail[$that_usertype];
		
		$result = array(
			'o' => $o,
			'sysBail' => $sysBail,
			'rightlist' => $rightlist,
			);
		
		$this->load->view('m/cert',$result);
	}

	private function save()
	{
		$res = 0;
		$config = array(
           	array(
                 'field'   => 'realname', 
                 'label'   => '真实姓名', 
                 'rules'   => 'trim|required'
            ),
            array(
                 'field'   => 'idno', 
                 'label'   => '身份证号', 
                 'rules'   => 'trim|required'
            ),
           	array(
                 'field'   => 'mobile', 
                 'label'   => '手机号', 
                 'rules'   => 'trim|required'
            ),  
            array(
                 'field'   => 'idnoimg', 
                 'label'   => '身份证照片', 
                 'rules'   => 'trim|required'
            ),
            // array(
            //      'field'   => 'company', 
            //      'label'   => '所属公司', 
            //      'rules'   => 'trim|required'
            // ),
        );

        $this->form_validation->set_rules($config);

		if ($this->form_validation->run() === TRUE)
		{

			$oSysKind = _get_config('orderkind');
			$oSysBail = _get_config('bail');
			$buyerid = $this->thatUser['id'];

			$o = array(
					'userid'=>$buyerid,
					'username'=>$this->thatUser['username'],
					'realname'=>$this->input->post('realname'),
					'idno'=>$this->input->post('idno'),
					'mobile'=>$this->input->post('mobile'),
					'idnoimg'=>$this->input->post('idnoimg'),
					'company'=>$this->input->post('company'),
					'bail'=>$oSysBail[$this->loginUsertype],
					'addtime'=>time(),
					'status'=>0,
					'op_userid'=>$this->loginID,
					'op_username'=>$this->loginUserName,
					'op_time'=>time(),
				);

			$this->Cert_model->insert($o);
			$res = 200;
		}
		
		return $res;
	}

	public function gotopay(){
		// $userid = $this->thatUser['id'];

		// $data = array(
		// 			'addtime'=>time(),
		// 			'status'=>2,
		// 			'op_userid'=>$this->loginID,
		// 			'op_username'=>$this->loginUserName,
		// 			'op_time'=>time(),
		// 		);
		// $this->Cert_model->update_by_id($userid, $data);

		echo '前往缴费..';
	}


}