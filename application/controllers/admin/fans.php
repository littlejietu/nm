<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fans extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Fans_model');
    }
	
    //默认执行index
	public function index()
	{
		$status = $this->input->get_post('status');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begtime = $this->input->get_post('begtime');
		$endtime = $this->input->get_post('endtime');
		$orderby = $this->input->get_post('orderby');

		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		if($status)
		{
			$arrParam['status'] = $status;
			$arrWhere['status'] = $status;
		}
		
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			if($field=='userid')
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
		$strOrder = 'addtime desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		}

		$list = $this->Fans_model->fetch_page($page, $pagesize, $arrWhere,'*', $strOrder);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/Fans', $arrParam);
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


		$this->load->view('admin/Fans',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Fans_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/Fans_add', $result);
	}

	
	

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		//删除数据库
		$this->Fans_model->delete_by_id($id);
		redirect( base_url('/admin/Fans?page='.$page) );

	}
}
