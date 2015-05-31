<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Act extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Activity_model');
    }
	public function index()
	{
		$type = (int)$this->input->get('type');
		$type = $type==0?1:$type;
		
		$page     = _get_page();
		$pagesize = 8;
		$arrParam = array('type'=>$type);
		$arrWhere = array('status'=>1, 'display'=>1, 'type'=>$type);

		$list = $this->Activity_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('act', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$oSysAct = _get_config('activity');
		$oSysAct_en = _get_config('activity_en');

		$result = array(
			'list' => $list,
			'oSysAct' => $oSysAct,
			'oSysAct_en' => $oSysAct_en,
			);


		$this->load->view('act',$result);
	}

	public function enter(){
		$actid = _get_key_val($this->input->post('id'),true);

		$res = array('code'=>0,'data'=>array());
		$userid = $this->loginID;

		if(!$userid)
		{
			$res['code'] = 201;
			$res['data']['msg'] = '请先登录';
			$this->view->json($res);
			exit;
		}
		$this->load->model('Activityenter_model');
		$o = $this->Activityenter_model->get_by_where(array('userid'=>$userid,'actid'=>$actid));
		if(!$o)
		{
			$data = array('actid'=>$actid,
				'userid'=>$this->loginID,
				'nickname'=>$this->loginNickName,
				'addtime'=>time(),
				);

			$this->Activityenter_model->insert($data);
			
			$res['code']=200;
		}
		else
		{
			$res['code'] = 202;
			$res['data']['msg'] = '已报名';
		}

		$this->view->json($res);
		exit;

	}

}
