<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Activity_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/activity', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/activity',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Activity_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/activity_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => '活动名称', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'type', 
                     'label'   => '活动类型', 
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'img', 
                     'label'   => '活动图片', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'begtime', 
                     'label'   => '开始时间', 
                     'rules'   => 'trim|required'
                  ),  
                 array(
                     'field'   => 'endtime', 
                     'label'   => '结束时间', 
                     'rules'   => 'trim|required'
                  ),  
                  array(
                     'field'   => 'place', 
                     'label'   => '地点', 
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
					'title'=>$this->input->post('title'),
					'type'=>$this->input->post('type'),
					'img'=>$this->input->post('img'),
					'intro'=>$this->input->post('intro'),
					'begtime'=>strtotime($this->input->post('begtime')),
					'endtime'=>strtotime($this->input->post('endtime')),
					'place'=>$this->input->post('place'),
					'address'=>$this->input->post('address'),
					'innumfake'=>$this->input->post('innumfake'),
					'innum'=>$this->input->post('innum'),
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

  				$this->Activity_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/activity'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Activity_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/activity_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Activity_model->delete_by_id($id);
		redirect( base_url('/admin/activity?page='.$page) );

	}
}
