<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usernum_model');
        $this->load->model('Product_model');
        $this->load->model('Order_model');
    }
	

	public function index($userid)
	{

		$y = $this->input->post('y');
		$m = $this->input->post('m');
		if(empty($y)) $y = date('Y');
		if(empty($m)) $m = date('m');

		$oUser = $this->User_model->get_info_by_id($userid);
		$oUsernum = $this->Usernum_model->get_by_id($userid);
		if($oUsernum)
			$oUser = array_merge($oUsernum, $oUser);

		$oProduList = $this->Product_model->get_product_by_uid($userid);
		$oProductList = array();
		foreach ($oProduList as $key => $a) {
			$oProductList[ $a['item'] .'_'. $a['scene'] .'_'. $a['time'] ] = $a['price'];
		}

		$this->load->helper('site');
		$oDefaultPrice = _get_product_default_price();

		$oProductList = array_merge($oDefaultPrice, $oProductList);

		$oSysPaystatus = $this->config->item('get_paystatus');
		$list = $this->Order_model->get_list(array('sellerid'=>$userid,'status'=>1,'paystatus'=>$oSysPaystatus[3]),'id,addtime as datetime,title');

		// $list = array(
		// 	array('id'=>1,'datetime'=>'2015-05-01 8:30:00','title'=>'周末特色文化广场活动吧','yinyueji'=>1,'classid'=>1),
		// 	array('id'=>11,'datetime'=>'2015-05-11 10:00:03','title'=>'周末特色文化广场活动','yinyueji'=>1,'classid'=>1),
		// 	array('id'=>2,'datetime'=>'2015-05-9 16:00:00','title'=>'test','yinyueji'=>0,'classid'=>1),
		// 	array('id'=>3,'datetime'=>'2015-05-1 18:00:00','title'=>'kk','yinyueji'=>1,'classid'=>12),
		// 	array('id'=>5,'datetime'=>'2015-05-15 9:20:20','title'=>'测试','yinyueji'=>1,'classid'=>1),
		// 	);

		
		$result = array(
			//'o' => $o,
			'workitem'=> $this->config->item('workitem'),
			'workscene'=> $this->config->item('workscene'),
			'worktime'=> $this->config->item('worktime'),
			
			'oProductList' => $oProductList,
			'oUser' => $oUser,
			'list' => $list,
			'YM'=>array('y'=>$y,'m'=>$m),
			);
		$this->load->view('i/schedule',$result);
	}

	public function book()
	{
		$res = array('code'=>0, 'data'=>array());

		if ($this->input->is_post())
		{
			if(!$this->loginID)
			{
				$res['code'] = 201;
				$res['data']['error_messages'] = array('请先登录');
			}
			else{
				$this->load->service('Order_service');
				$res = $this->order_service->book();
			}
		}

		$this->view->json($res);

	}

}