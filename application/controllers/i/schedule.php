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
		$dbprefix = $this->User_model->db->dbprefix;

		//浏览
		$sysVisittype = _get_config('visittype');
		$this->load->service('User_service');
		$this->user_service->visit($userid, $this->loginID, $sysVisittype['home']);
		//-浏览

		$y = $this->input->post('y');
		$m = $this->input->post('m');
		if(empty($y)) $y = date('Y');
		if(empty($m)) $m = date('m');

		$this->load->service('User_service');
		$oUser = $this->user_service->get_user_homeinfo($userid, $this->loginID);

		$oProduList = $this->Product_model->get_product_by_uid($userid);
		$oProductList = array();
		foreach ($oProduList as $key => $a) {
			$oProductList[ $a['item'] .'_'. $a['scene'] .'_'. $a['time'] ] = $a['price'];
		}

		$this->load->helper('site');
		$oDefaultPrice = _get_product_default_price();

		$oProductList = array_merge($oDefaultPrice, $oProductList);

		$oSysPaystatus = $this->config->item('get_paystatus');
		$arrWhere = array('a.sellerid'=>$userid,
				'a.status'=>1,'paystatus'=>"'".$oSysPaystatus[3]."'");
		$tb = $dbprefix.'order a left join '.$dbprefix.'order_book b on(a.id=b.orderid)';
		$list_result = $this->Order_model->fetch_page(1, 100, $arrWhere,'a.id,a.title,b.begtime,b.endtime','a.addtime desc',$tb);

		// $list = array(
		// 	array('id'=>1,'datetime'=>'2015-05-01 8:30:00','title'=>'周末特色文化广场活动吧','yinyueji'=>1,'classid'=>1),
		// 	array('id'=>11,'datetime'=>'2015-05-11 10:00:03','title'=>'周末特色文化广场活动','yinyueji'=>1,'classid'=>1),
		// 	array('id'=>2,'datetime'=>'2015-05-9 16:00:00','title'=>'test','yinyueji'=>0,'classid'=>1),
		// 	array('id'=>3,'datetime'=>'2015-05-1 18:00:00','title'=>'kk','yinyueji'=>1,'classid'=>12),
		// 	array('id'=>5,'datetime'=>'2015-05-15 9:20:20','title'=>'测试','yinyueji'=>1,'classid'=>1),
		// 	);
		$list = array();
		foreach ($list_result['rows'] as $key => $a) {
			$list[] = array('id'=>$a['id'],'datetime'=>$a['begtime'],'endtime'=>$a['endtime'],'title'=>$a['title']);
			if( $a['endtime'] > $a['begtime'] && ($a['endtime']-$a['begtime'])>= 24*60*60 )
			{
				$date_i = ($a['endtime']-$a['begtime'])/(24*60*60);
				for($i=0; $i<$date_i; $i++)
				{
					$list[] = array('id'=>$a['id'],'datetime'=>$a['endtime'] - 24*60*60*$i,'endtime'=>$a['endtime'],'title'=>$a['title']);
				}

			}

		}

		
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