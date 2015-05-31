<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Admin_Controller {

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
		//$tb = $dbprefix.'user a left join '.$dbprefix.'user_detail b on(a.id=b.userid) left join '.$dbprefix.'recommend c on(c.outerid=a.id and c.kind=1)';
		$tb = $dbprefix.'user a left join '.$dbprefix.'recommend b on(b.outerid=a.id and b.kind=1)';
		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere, 'a.*,(b.id is not null) as isrecommend ','a.id', $tb);
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

		$oSysUsertype = _get_config('usertype');
		$oSysUserlevel = _get_config('userlevel');

		$result = array(
			'list' => $list,
			'oSysUsertype' => $oSysUsertype,
			'oSysUserlevel' => $oSysUserlevel,
			);


		$this->load->view('admin/user',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();
		$info = array();

		if(!empty($id))
		{
			$info = $this->User_model->get_info_by_id($id);
			
		}

		$oSysUsertype = _get_config('usertype');
		$oSysUserlevel = _get_config('userlevel');
		$result = array(
				'info'=>$info,
				'oSysUsertype' => $oSysUsertype,
				'oSysUserlevel' => $oSysUserlevel,
			);
		

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
                     'field'   => 'userlevel', 
                     'label'   => '用户级别', 
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
					'userlevel'=>$this->input->post('userlevel'),
					
					'userlogo'=>$this->input->post('userlogo'),
					'realname'=>$this->input->post('realname'),					
					//'mobile'=>$this->input->post('mobile'),					
					'sex'=>$this->input->post('sex'),
					'city'=>$this->input->post('city'),	
					'showimg'=>$this->input->post('showimg'),
					'qq'=>$this->input->post('qq'),				
				);
				if($this->input->post('password'))
					$data['password'] = md5($this->input->post('password'));


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
					'card'=>$this->input->post('card'),
					'bgimg'=>$this->input->post('bgimg'),
					'video'=>$this->input->post('video'),					
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
		
		$this->User_model->update_by_where(array('id'=>$id),array('status'=>0));

		redirect( base_url('/admin/user?page='.$page) );

	}

	function recommend(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->load->model('Recommend_model');
		$this->Recommend_model->do_recommend(1,$id);

		redirect( base_url('/admin/user?page='.$page) );

	}
	
}
