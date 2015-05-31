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

		$list = $this->Cert_model->fetch_page($page, $pagesize, $arrWhere,'*','status desc,addtime desc');
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
		$userid	= _get_key_val($this->input->get('userid'), TRUE);
		$result = array();
		$info = array();

		if(!empty($userid))
		{
			$info = $this->Cert_model->get_info_by_id($userid);
			$oDetail = $this->Userdetail_model->get_by_id($userid);
			$info = array_merge($oDetail, $info);
		}

		$oSysModelarea = _get_config('modelarea');
		$oSysModelstyle = _get_config('modelstyle');
		$result = array(
			'info'=>$info,
			'oSysModelarea'=>$oSysModelarea,
			'oSysModelstyle'=>$oSysModelstyle,
			);

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
                array(
                	'field'		=>	'area',
                	'label'		=>	'区域',
                	'rules'		=>	'trim|required',
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

  				$userid	= _get_key_val($this->input->get('userid'), TRUE);
  				//保存至数据库
  				$this->Cert_model->update_by_id($userid,$data);

  				$style = '';
  				if(is_array($this->input->post('style')))
  					$style = implode(',', $this->input->post('style'));
  				$data_detail = array(
					'area'=>$this->input->post('area'),
					'style'=>$style,
					);
  				$this->Userdetail_model->update_by_id($userid,$data_detail);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/Cert'));
				exit;
  			}
  			else
  			{
  				$userid	= _get_key_val($this->input->get('userid'), TRUE);
				$result = array();

				if(!empty($userid))
				{
					$info = $this->Cert_model->get_info_by_id($userid);
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
		$userid	= _get_key_val($this->input->get('userid'), TRUE);
		$page = _get_page();

		$this->Cert_model->delete_by_id($userid);
		redirect( base_url('/admin/Cert?page='.$page) );

	}
}
