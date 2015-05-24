<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		//所有人的消息
		$toall_list = $this->Message_model->get_list(array('touserid'=>0,'status'=>1));

		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array('touserid'=>$userid,'status'=>1);		//条件

		$list = $this->Message_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/message', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'toall_list' =>$toall_list,
			);

		//print_r($list);
		$this->load->view('m/message',$result);
	}

	public function detail($id){
		
		
		$o = $this->Message_model->get_info_by_id($id);

		//修改为已读
		if($o['touserid']>0)
			$this->Message_model->update_by_where(array('id'=>$id),array('readed'=>1));

		$result = array(
			'o' => $o,
			);
		
		$this->load->view('m/messagedetail',$result);
	
	}

}