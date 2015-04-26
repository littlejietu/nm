<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Ad_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Ad_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/Ad', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/Ad',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Ad_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/Ad_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
				array(
                     'field'   => 'title', 
                     'label'   => '广告名称', 
                     'rules'   => 'trim|required'
                  ),  
				array(
                     'field'   => 'placeid', 
                     'label'   => '广告位id', 
                     'rules'   => 'trim|required'
                  ),  
				array(
                     'field'   => 'img', 
                     'label'   => '图片地址', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'url', 
                     'label'   => '链接地址', 
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
                     'field'   => 'display', 
                     'label'   => '显示', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				//将需要保存的数据赋值给数组$data
  				$data = array(
					'title'=>$this->input->post('title'),
					'placeid'=>$this->input->post('placeid'),
					'img'=>$this->input->post('img'),
					'url'=>$this->input->post('url'),
					'summary'=>$this->input->post('summary'),
					'memo'=>$this->input->post('memo'),
					'price'=>$this->input->post('price'),
					'begtime'=>$this->input->post('begtime'),
					'endtime'=>$this->input->post('endtime'),
					'sort'=>$this->input->post('sort'),
					'display'=>$this->input->post('display'),					
					'op_userid'=>0,
					'op_username'=>0,
					'op_time'=>time(),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
  				//保存至数据库
  				$this->Ad_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/Ad'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Ad_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/Ad_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Ad_model->delete_by_id($id);
		redirect( base_url('/admin/Ad?page='.$page) );

	}
}
