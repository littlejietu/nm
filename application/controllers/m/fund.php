<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->model('Usernum_model');
    }
	

	public function index()
	{
		$get_paystatus = (int)$this->input->get('paystatus');
		$get_keyword = $this->input->post('keyword')?$this->input->post('keyword'):$this->input->get('keyword');
		$dbprefix = $this->User_model->db->dbprefix;


		$id = _get_key_val($this->input->get('id'),true);
		$o = $this->Usernum_model->get_by_id($this->loginID);
		$oSysPaystatus = $this->config->item('get_paystatus');

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('a.sellerid'=>$this->loginID,'status'=>1,'paystatus'=>"'".$oSysPaystatus[2]."'");
		if($get_keyword)
		{
			$arrParam['keyword']=$get_keyword;
			$arrWhere['@like']=array('title'=>$get_keyword);
		}
		$tb = $dbprefix.'order a left join '.$dbprefix.'order_book b on(a.id=b.orderid)';
		$list = $this->Order_model->fetch_page($page, $pagesize, $arrWhere,'a.*,b.begtime,b.endtime','a.addtime desc',$tb);
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/order', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'o' => $o,
			'list' => $list,
			'keyword' => !empty($arrParam['keyword'])?$arrParam['keyword']:'',
			);
		
		$this->load->view('m/fund',$result);
	}


}