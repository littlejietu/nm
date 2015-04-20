<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/user', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/user',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->User_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/user_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
                array(
                     'field'   => 'username', 
                     'label'   => '用户名', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'nickname', 
                     'label'   => '昵称', 
                     'rules'   => 'trim|required'
                  ),  
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

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					'figure'=>$this->input->post('figure'),
					'skill'=>$this->input->post('skill'),
					'efficiency'=>$this->input->post('efficiency'),
					'attitude'=>$this->input->post('attitude'),
					'memo'=>$this->input->post('memo'),
					'good'=>$this->input->post('good'),
					'addtime'=>time(),
					'display'=>$this->input->post('display'),
					'status'=>$this->input->post('status'),
					'op_userid'=>0,
					'op_username'=>0,
					'op_time'=>time(),
				);

				$data_detail = array(
					);
				$data_memo = array(
					);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
				//保存数据库
  				$this->User_model->update_info_by_id($id, $data, $data_detail, $data_memo);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/user'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->User_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/user_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->User_model->delete_by_id($id);
		redirect( base_url('/admin/user?page='.$page) );

	}
}
