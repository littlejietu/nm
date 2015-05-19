<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Fans_model');
        $this->load->model('Album_model');
    }
	

	public function index($userid)
	{
		$oUser = $this->User_model->get_info_by_id($userid);
		$oUsernum = $this->Usernum_model->get_by_id($userid);
		if($oUsernum)
			$oUser = array_merge($oUsernum, $oUser);

		// $o = $this->User_model->get_info_by_id($userid);
		$list = $this->Album_model->get_list(array('userid'=>$userid,'status'=>1));
		$result = array(
			'oUser' => $oUser,
			'list' => $list,
			);
		$this->load->view('i/index',$result);
	}

	public function fans()
	{
		$res = array('code'=>0,'data'=>array());
		$mid = $this->input->post('mid');

		$o = $this->Fans_model->get_by_where(array('userid'=>$mid,'fansuserid'=>$this->loginID));
		if(!$o)
		{
			$data = array(
				'userid'=>$mid,
				'fansuserid'=>$this->loginID,
				'fansnickname'=>$this->loginNickName,
				'addtime'=>time(),
				);

			$this->Fans_model->insert($data);
			$res['code']=200;
		}
		else
		{
			$res['code'] = 201;
		}

		$this->view->json($res);
	}
	

}