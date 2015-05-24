<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Order_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/order', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/order',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Order_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/order_add', $result);
	}

	

	
}
