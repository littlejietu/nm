<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fans extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Fans_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		$this->load->model('Usernum_model');
		$oUsernum = $this->Usernum_model->get_by_id($userid, 'fansnum,concernnum,be_ordernum');

		$keyword = $this->input->get('keyword');

		
		$page     = _get_page();
		$pagesize = 9;
		$arrParam = array();
		$arrWhere = array('fansuserid'=>$userid,'status >'=>0);		//条件
		$cField = 'userid,nickname,userlogo,type';
		if($keyword)
		{
			$arrParam['keyword'] = $keyword;
			$arrWhere['nickname like'] = "'%$keyword%'";
		}

		if($this->input->get('havefans'))
		{
			$arrParam = array('havefans'=>(int)$this->input->get('havefans'));
			$arrWhere = array('userid'=>$userid,'status >'=>0);
			$cField = 'fansuserid as userid,fansnickname as nickname,fanslogo as userlogo,type';

			if($keyword)
			{
				$arrParam['keyword'] = $keyword;
				$arrWhere['fansnickname like'] = "'%$keyword%'";
			}
		}

		

		$list = $this->Fans_model->fetch_page($page, $pagesize, $arrWhere, $cField);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/Fans', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			'oUsernum' => $oUsernum,
			'arrParam' => $arrParam,
			);
		
		$this->load->view('m/fans',$result);
	}

}