<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cert extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Cert_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Cert_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/Cert', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/Cert',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Cert_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/Cert_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
				
				array(
                     'field'   => 'realname', 
                     'label'   => '真实姓名', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'idno', 
                     'label'   => '身份证', 
                     'rules'   => 'trim|required'
                  ),                
                array(
                     'field'   => 'mobile', 
                     'label'   => '手机号', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'company', 
                     'label'   => '所属经纪公司', 
                     'rules'   => 'trim|required'
                  ),
                  
               
               
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				//将需要保存的数据赋值给数组$data
  				$data = array(
					
					'realname'=>$this->input->post('realname'),
					'idno'=>$this->input->post('idno'),
					'mobile'=>$this->input->post('mobile'),
					'idnoimg'=>$this->input->post('idnoimg'),
					'company'=>$this->input->post('company'),
					'bail'=>$this->input->post('bail'),
					'status'=>$this->input->post('status'),
					'op_userid'=>0,
					'op_username'=>0,
					'op_time'=>time(),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
  				//保存至数据库
  				$this->Cert_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/Cert'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Cert_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/Cert_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Cert_model->delete_by_id($id);
		redirect( base_url('/admin/Cert?page='.$page) );

	}
}
