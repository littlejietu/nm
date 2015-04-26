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
		$dbprefix = $this->User_model->db->dbprefix;
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();
		$tb = $dbprefix.'user a left join '.$dbprefix.'user_detail b on(a.id=b.userid)';
		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere, '*','a.id', $tb);
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
					'username'=>$this->input->post('username'),
					'nickname'=>$this->input->post('nickname'),
					'usertype'=>$this->input->post('usertype'),
					'password'=>$this->input->post('password'),
					'userlogo'=>$this->input->post('userlogo'),
					'realname'=>$this->input->post('realname'),					
					'mobile'=>$this->input->post('mobile'),					
					'sex'=>$this->input->post('sex'),
					'city'=>$this->input->post('city'),					
				);

				$data_detail = array(
					'height'=>$this->input->post('height'),
					'weight'=>$this->input->post('weight'),
					'bust'=>$this->input->post('bust'),
					'waist'=>$this->input->post('waist'),
					'hips'=>$this->input->post('hips'),
					'shoes'=>$this->input->post('shoes'),
					'cup'=>$this->input->post('cup'),
					);
				$data_memo = array(
					'brand'=>$this->input->post('brand'),
					'brandtype'=>$this->input->post('brandtype'),
					'awards'=>$this->input->post('awards'),
					'fee'=>$this->input->post('fee'),
					'servicetime'=>$this->input->post('servicetime'),
					'takenote'=>$this->input->post('takenote'),
					'planeshot'=>$this->input->post('planeshot'),
					'tactivity'=>$this->input->post('tactivity'),
					'telead'=>$this->input->post('telead'),
					'magazine'=>$this->input->post('magazine'),					
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
