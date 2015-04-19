<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Comment_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Comment_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/comment', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/comment',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Comment_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/comment_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
                array(
                     'field'   => 'figure', 
                     'label'   => '身材样貌', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'skill', 
                     'label'   => '专业技能', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'efficiency', 
                     'label'   => '工作效率', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'attitude', 
                     'label'   => '服务态度', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'memo', 
                     'label'   => '评价内容', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'good', 
                     'label'   => '是否精华', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'display', 
                     'label'   => '显示', 
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

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Comment_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/comment'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Comment_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/comment_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Comment_model->delete_by_id($id);
		redirect( base_url('/admin/comment?page='.$page) );

	}
}
