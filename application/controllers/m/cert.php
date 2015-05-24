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
			$this->save();
			redirect(base_url('/m/cert'));
			exit;
		}

		$o = $this->Cert_model->get_by_id($userid);

		$oSysBail = _get_config('bail');
		$sysBail = $oSysBail[$that_usertype];
		
		$result = array(
			'o' => $o,
			'sysBail' => $sysBail,
			);
		
		$this->load->view('m/cert',$result);
	}

	private function save()
	{
		$res = array('code'=>0, 'data'=>array());
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
            array(
                 'field'   => 'company', 
                 'label'   => '所属公司', 
                 'rules'   => 'trim|required'
            ),
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
			$res['code'] = 200;
		}
		else
		{
			$res['data']['error_messages'] = $this->form_validation->getErrors();
		}
	}


}