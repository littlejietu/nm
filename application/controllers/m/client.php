<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('userid'=>$userid,'status'=>1);		//条件

		$list = $this->Client_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/client', $arrParam);
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
		$this->load->view('m/client',$result);
	}

	public function addclient()
	{
		$res = array('code'=>0,'data'=>array());
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               	array(
                     'field'   => 'linkman', 
                     'label'   => '联系人', 
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'contact', 
                     'label'   => '联系方式', 
                     'rules'   => 'trim|required'
                ),
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$res['data'] = '添加成功';
  				$id	= _get_key_val($this->input->post('id'), TRUE);
  				if($id)
  				{
  					$res['data'] = '修改成功';
  					$data = array(
						'linkman'=>$this->input->post('linkman'),
						'contact'=>$this->input->post('contact'),
						'memo'=>$this->input->post('memo'),
						'updatetime'=>time(),
						'op_userid'=>$this->loginID,
						'op_nickname'=>$this->loginNickName,
						'op_time'=>time(),
					);
					$data['id'] = $id;
  				}
  				else
  				{
	  				$data = array(
	  					'userid'=>$this->thatUser['id'],
	  					'nickname'=>$this->thatUser['nickname'],
						'linkman'=>$this->input->post('linkman'),
						'contact'=>$this->input->post('contact'),
						'memo'=>$this->input->post('memo'),
						'addtime'=>time(),
						'status'=>1,
						'op_userid'=>$this->loginID,
						'op_nickname'=>$this->loginNickName,
						'op_time'=>time(),
					);
				}

  				$this->Client_model->insert($data);
				$res['code'] = 200;

  			}
  			else
  				$res['data']['error_messages'] = $this->form_validation->getErrors();

		}//-is_post()
		$this->view->json($res);
		exit;

	}

	public function getinfo(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$o = $this->Client_model->get_info_by_id($id,'linkman,contact,memo');
		$res['code'] = 200;
		$res['data'] = $o;

		$this->view->json($res);
		exit;

	}

	public function del(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->post('id'), TRUE);
		
		$this->Client_model->update_by_where(array('id'=>$id, 'userid'=>$this->thatUser['id']),array('status'=>0));
		$res['code'] = 200;

		$this->view->json($res);
	}
}