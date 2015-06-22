<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('userid'=>$userid,'status'=>1);		//条件

		$list = $this->Activity_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->Activity_model->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/activity', $arrParam);
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
		$this->load->view('m/activity',$result);
	}
	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               array(
                     'field'   => 'type', 
                     'label'   => '通告性质', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'begtime', 
                     'label'   => '工作时间', 
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'place', 
                     'label'   => '工作地点', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'summary', 
                     'label'   => '工作内容', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'actnum', 
                     'label'   => '名额', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'workfee', 
                     'label'   => '工作费用', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'inendtime', 
                     'label'   => '报名截止时间', 
                     'rules'   => 'trim|required' 
                  ),
                  array(
                     'field'   => 'img', 
                     'label'   => '通告封面', 
                     'rules'   => 'trim|required'
                  ),    
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				
  				$data = array(
  					'title'=>$this->input->post('title'),
					'type'=>$this->input->post('type'),
					'begtime'=>strtotime($this->input->post('begtime')),
					'endtime'=>strtotime($this->input->post('endtime')),
					'place'=>$this->input->post('place'),
					'summary'=>$this->input->post('summary'),
					'actnum'=>(int)$this->input->post('actnum'),
					'workfee'=>$this->input->post('workfee'),
					'inendtime'=>strtotime($this->input->post('inendtime')),
					'img'=>$this->input->post('img'),
					'status'=>1,
					'op_userid'=>$this->loginID,
					'op_username'=>$this->loginUserName,
					'op_time'=>time(),
				);

				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
  				
  				if(!$id)
  				{
  					$data['userid']=$this->thatUser['id'];
	  				$data['nickname']=$this->thatUser['nickname'];
  				}

  				$this->Activity_model->insert($data);
  				redirect('/m/activity');
  				exit;
  			}

		}//-is_post()

		if(!empty($id))
		{
			
			$info = $this->Activity_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		$oSysActType = _get_config('activity');
		$result['oSysActType'] = $oSysActType;


		$this->load->view('m/activityadd', $result);
	}
	/*public function add()
	{
		$this->load->view('m/activityadd');
	}*/

	public function getinfo(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$o = $this->Activity_model->get_info_by_id($id,'linkman,contact,memo');
		$res['code'] = 200;
		$res['data'] = $o;

		$this->view->json($res);
		exit;

	}

	public function del(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->post('id'), TRUE);
		
		$this->Activity_model->update_by_where(array('id'=>$id, 'userid'=>$this->thatUser['id']),array('status'=>0));
		$res['code'] = 200;

		$this->view->json($res);
	}

	public function enterlist()
	{
		$aid = (int)$this->input->get('aid');

		$page     = _get_page();
		$pagesize = 120;
		$arrParam = array('aid'=>$aid);
		$arrWhere = array('actid'=>$aid);

		$o = $this->Activity_model->get_by_id($aid);
		
		$dbprefix = $this->Activity_model->db->dbprefix;
		$this->load->model('Activityenter_model');
		$tb = $dbprefix.'activity_enter a left join '.$dbprefix.'user b on(a.userid=b.id and b.status=1)';
		$list = $this->Activityenter_model->fetch_page($page, $pagesize, $arrWhere,'a.userid,b.nickname,b.userlogo','a.addtime desc',$tb);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('act/enterlist', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'o' => $o,
			);

		$this->load->view('m/actenterlist',$result);

	}
}