<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Link_model');
    }
	
    //默认执行index
	public function index()
	{
		$display = $this->input->get_post('display');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begdate = $this->input->get_post('begdate');
		$enddate = $this->input->get_post('enddate');
		$orderby = $this->input->get_post('orderby');
		
		if($field=='ti_tle')
			$field = 'title';

		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		if($display)
		{
			$arrParam['display'] = $display;
			$arrWhere['display'] = $display;
		}
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			if($field=='sellerid' || $field=='buyerid')
				$arrWhere[$field] = $cKey;
			else
				$arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		$arrParam['fieldDate'] = $fieldDate;

		if($begdate)
		{
			$arrParam['begdate'] = $begdate;
			$arrWhere["$fieldDate >="] = strtotime($begdate);
		}
		
		if($enddate)
		{
			$arrParam['enddate'] = $enddate;
			$arrWhere["$fieldDate <="] = strtotime("$enddate 23:59:59");
		}
		$strOrder = 'id desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}

		$list = $this->Link_model->fetch_page($page, $pagesize, $arrWhere,'*', $strOrder);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/link', $arrParam);
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


		$this->load->view('admin/link',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Link_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/link_add', $result);
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
                     'field'   => 'url', 
                     'label'   => 'url', 
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'sort', 
                     'label'   => '排序', 
                     'rules'   => 'trim|required|numeric'
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
					'url'=>$this->input->post('url'),
					'sort'=>$this->input->post('sort'),
					'display'=>$this->input->post('display'),
					'addtime'=>time(),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Link_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/link'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Link_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/link_add',$result);
  				//redirect('/admin/link/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Link_model->delete_by_id($id);
		redirect( base_url('/admin/link?page='.$page) );

	}
}
