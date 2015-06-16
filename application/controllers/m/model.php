<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
	

	public function index()
	{
		$userid = $this->loginID;
		$arrWhere1 = array('insid'=>$userid,'status'=>2,'usertype'=>1);
		$list = $this->User_model->get_list($arrWhere1);

		$arrWhere2 = array('insid'=>$userid,'status'=>2,'usertype'=>4);
		$list2 = $this->User_model->get_list($arrWhere2);

		$arrWhere3 = array('insid'=>$userid,'status'=>2,'usertype'=>5);
		$list3 = $this->User_model->get_list($arrWhere3);
	
		$result = array(
			'list' => $list,
			'list2' => $list2,
			'list3' => $list3,
			);

		$this->load->view('m/model',$result);
	}

	public function addtoins()
	{
		$res = array('code'=>0,'data'=>array());
		
		if ($this->input->is_post())
		{
			$id	= _get_key_val($this->input->post('id'), TRUE);
			$this->User_model->update_by_where(array('id'=>$id, 'insid'=>0),array('insid'=>$this->loginID));
			$res['code'] = 200;

		}//-is_post()
		$this->view->json($res);
		exit;

	}

	public function del(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->post('id'), TRUE);
		
		$this->User_model->update_by_where(array('id'=>$id, 'insid'=>$this->loginID),array('status'=>-1));
		$res['code'] = 200;

		$this->view->json($res);
	}

	public function set(){
		$agid = $this->input->get('modelid');
		$modelid = _get_key_val( $agid, TRUE);
		$agUser = $this->User_model->fetch_row(array('id'=>$modelid), 'usertype');
		if($agUser)
			redirect('/m/info?agid='.$agid.'&agusertype='.$agUser['usertype']);
		else
		{
			echo 'err';
			exit;
		}

		/*//原代理模式
		$modelid = _get_key_val( $this->input->get('modelid'), TRUE);
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->cache->delete('agentUser');
		if ( ! $agentUser = $this->cache->get('agentUser'))
		{
		    $fields = 'id,usertype,userlevel,username,nickname,realname,mobile,email,userlogo,validemail,validmobile,status,lastlogintime';
			$agentUser = $this->User_model->fetch_row(array('id'=>$modelid), $fields);

		    $this->cache->save('agentUser', $agentUser, 60*60);
		}

		redirect('/m/info');
		*/
	}

	public function exitagt(){
		//$modelid = _get_key_val( $this->input->get('modelid'), TRUE);
		$this->cache->delete('agentUser');
		redirect('/m/info');
	}
}