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
		$paystatus = $this->input->get_post('paystatus');
		$field = $this->input->get_post('field');
		$cKey = $this->input->get_post('txtKey');
		$fieldDate = $this->input->get_post('fieldDate');
		$begdate = $this->input->get_post('begdate');
		$enddate = $this->input->get_post('enddate');
		$orderby = $this->input->get_post('orderby');

		if($field=='ti_tle')
			$field = 'title';

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();

		if($paystatus)
		{
			$arrParam['paystatus'] = $paystatus;
			$arrWhere['paystatus'] = "'$paystatus'";
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

		$list = $this->Order_model->fetch_page($page, $pagesize, $arrWhere, '*', $strOrder);
		//echo $this->Order_model->db->last_query();die;
		$oSysPaystatus = _get_config('paystatus');
		

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
			'oSysPaystatus' => $oSysPaystatus,
			'arrParam' => $arrParam,
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
