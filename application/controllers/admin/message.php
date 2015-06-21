<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
    }
	
    //默认执行index
	public function index()
	{
		$type = $this->input->get_post('type');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begtime = $this->input->get_post('begtime');
		$endtime = $this->input->get_post('endtime');
		$orderby = $this->input->get_post('orderby');

		if($field=='ti_tle')
			$field = 'title';

		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		if($type)
		{
			$arrParam['type'] = $type;
			if($type==1)
				$arrWhere['touserid'] = 0;
			else
				$arrWhere['touserid >'] = 0;
		}
		
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			if($field=='touserid')
				$arrWhere[$field] = $cKey;
			else
				$arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		$arrParam['fieldDate'] = $fieldDate;

		if($begtime)
		{
			$arrParam['begtime'] = $begtime;
			$arrWhere["$fieldDate >="] = strtotime($begtime);
		}
		if($endtime)
		{
			$arrParam['endtime'] = $endtime;
			$arrWhere["$fieldDate <="] = strtotime("$endtime 23:59:59");
		}
		$strOrder = 'id desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}

		$list = $this->Message_model->fetch_page($page, $pagesize, $arrWhere, '*', $strOrder);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/message', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'arrParam' => $arrParam,
			);


		$this->load->view('admin/message',$result);
	}

	public function add()
	{
		$touserid = 0;
		$result = array();
		//需要修改
		if($this->input->get('touserid'))
		{
			$touserid = _get_key_val($this->input->get('touserid'), TRUE);
				
			$this->load->model('User_model');
			$userinfo = $this->User_model->get_by_id($touserid);
		}
		else
		{
			$userinfo['id'] = 0;
			$userinfo['nickname'] = '所有用户';
		}


		$result = array(
			'userinfo'=>$userinfo,
			);
		
		
		

		$this->load->view('admin/message_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               
                array(
                     'field'   => 'title', 
                     'label'   => '标题', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'content', 
                     'label'   => '内容', 
                     'rules'   => 'trim|required'
                  ), 
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					'touserid'=>$this->input->post('touserid'),
					'tonickname'=>$this->input->post('tonickname'),
					'title'=>$this->input->post('title'),
					'content'=>$this->input->post('content'),
					'readed'=>0,
					'status'=>1,					
					'addtime'=>time(),					
					

				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Message_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/message'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Message_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/message_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}//-is_post()



	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Message_model->delete_by_id($id);
		redirect( base_url('/admin/message?page='.$page) );

	}
}
