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
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('insid'=>$userid,'status'=>1);		//条件

		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/model', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);

		//print_r($list);
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
		
		$this->User_model->update_by_where(array('id'=>$id, 'insid'=>$this->loginID),array('insid'=>0));
		$res['code'] = 200;

		$this->view->json($res);
	}

	public function set(){
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
	}

	public function exitagt(){
		//$modelid = _get_key_val( $this->input->get('modelid'), TRUE);
		$this->cache->delete('agentUser');
		redirect('/m/info');
	}
}