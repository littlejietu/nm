<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }
	

	public function index()
	{
		$get_paystatus = (int)$this->input->get('paystatus');
		$get_keyword = $this->input->post('keyword')?$this->input->post('keyword'):$this->input->get('keyword');
		$dbprefix = $this->User_model->db->dbprefix;
		$userid = $this->loginID;
		if($this->loginUserNum && $this->loginUserNum['be_ordernum_new'])
		{
			$this->load->service('Num_service');
			$this->num_service->clear_user_num($userid, 'be_ordernum_new');
		}

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();		//条件
		if($this->loginUsertype==1)
		{
			$arrWhere = array('a.sellerid'=>$userid,'a.status'=>1);
		}
		else
		{
			$arrWhere = array('a.buyerid'=>$userid,'a.status'=>1);
		}
		if($get_paystatus)
		{
			$oSysGetPaystatus = $this->config->item('get_paystatus');
			$arrWhere['paystatus']="'".$oSysGetPaystatus[$get_paystatus]."'";
			$arrParam['paystatus']=$get_paystatus;
		}
		if($get_keyword)
		{
			$arrWhere['@like']=array('title'=>$get_keyword);
			$arrParam['keyword']=$get_keyword;
		}

		$tb = $dbprefix.'order a left join '.$dbprefix.'order_book b on(a.id=b.orderid)';
		$list = $this->Order_model->fetch_page($page, $pagesize, $arrWhere,'a.*,b.begtime,b.endtime','a.addtime desc',$tb);
		//echo $this->Order_model->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/order', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$oSysPaystatus = $this->config->item('paystatus');

		$result = array(
			'list' => $list,
			'oSysPaystatus' => $oSysPaystatus,
			'keyword' => !empty($arrParam['keyword'])?$arrParam['keyword']:'',
			);

		//print_r($list);
		$this->load->view('m/order',$result);
	}

	public function detail(){
		$id = _get_key_val($this->input->get('id'),true);
		$o = $this->Order_model->get_by_id($id);
		$this->load->model('Orderbook_model');
		$oBook = $this->Orderbook_model->get_by_where(array('orderid'=>$id));

		$o = array_merge($oBook, $o);

		$result = array(
			'o' => $o,
			);

		$this->load->view('m/orderdetail',$result);
	}

	public function reject()
	{
		$id = _get_key_val($this->input->get('id'),true);
		$arrWhere = array('id'=>$id, 'sellerid'=>$this->loginID);
		$data = array('reject'=>-1);
		$this->Order_model->update_by_where($arrWhere, $data);

		redirect('/m/order');

	}

	public function agree()
	{
		$id = _get_key_val($this->input->get('id'),true);
		$arrWhere = array('id'=>$id, 'sellerid'=>$this->loginID);
		$data = array('reject'=>1);
		$this->Order_model->update_by_where($arrWhere, $data);

		redirect('/m/order');

	}

	public function del()
	{
		$id = _get_key_val($this->input->get('id'),true);
		$arrWhere = array('id'=>$id, 'sellerid'=>$this->loginID);
		$data = array('status'=>-1);
		$this->Order_model->update_by_where($arrWhere, $data);

		redirect('/m/order');

	}

}