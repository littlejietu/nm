<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

	
	public function index()
	{
		
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array('status'=>1,'b.photonum>'=>0);

		$this->load->model('User_model');
		$this->load->model('Photo_model');
		$dbprefix = $this->User_model->db->dbprefix;
		$tb = $dbprefix.'user a inner join '.$dbprefix.'user_num b on(a.id=b.userid)';
		$list = $this->User_model->fetch_page($page, $pagesize, $arrWhere,'a.id,a.nickname','a.addtime desc', $tb);

		$alist = array('rows'=>array());
		foreach ($list['rows'] as $key => $value) {
			$rs = $this->Photo_model->fetch_page(1, 5, array('userid'=>$value['id'],'status'=>1),'img');
			$value['photolist'] = $rs['rows'];
			$alist['rows'][]=$value;
		}

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('model', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$alist['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $alist,
			);

		$this->load->view('model',$result);
	}
}