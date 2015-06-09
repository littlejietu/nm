<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Usernum_model');
        $this->load->model('Product_model');
        //$this->load->model('Order_model');
        $this->load->model('Schedule_model');
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

		$oSysItem = _get_config('workitem');
		$oSysScene = _get_config('workscene');
		$oSysTime = _get_config('worktime');
		$oProduList = $this->Product_model->get_product_by_uid($userid);
		$oProductList = array();
		$oItemList = array();
		$oItem_Scene_Time = array();
		$oSceneList = array();
		$oTimeList = array();
		if($oProduList)
		{
			foreach ($oProduList as $key => $a) {

				$oProductList[ $a['item'] .'_'. $a['scene'] .'_'. $a['time'] ] = $a['price'];
				$oItemList[$a['item']] = $oSysItem[$a['item']];

				$thatScene = $oSysScene[$a['scene']];
				$thatTime = $oSysTime[$a['time']];
				if(key($oItemList)==$a['item'])
				{
					$oSceneList[$a['scene']] = $thatScene;
					$oTimeList[$a['time']] = $thatTime;
				}

				if(!array_key_exists($a['item'], $oItem_Scene_Time))
					$oItem_Scene_Time[$a['item']] = array( array('scene_key'=>$a['scene'],'scene_name'=>$thatScene,'time_list'=>array($a['time']=>$thatTime)) );
				else{
					/*

					if(!in_array($a['scene'], $oItem_Scene_Time[$a['item']]['scene_key']))
					{
						array_push($oItem_Scene_Time[$a['item']], array('scene_key'=>$a['scene'],'scene_name'=>$thatScene,'time_list'=>array($a['time']=>$thatTime)) );
					}
					else
					{
						$oItem_Scene_Time[$a['item']]['time_list'][$a['time']]=$thatTime;
					}
					*/

					
					$bExist = false;
					foreach ($oItem_Scene_Time[$a['item']] as $key => $av) {
						if($av['scene_key']==$a['scene'])
						{
							$oItem_Scene_Time[$a['item']][$key]['time_list'][$a['time']] = $thatTime;
							$bExist = true;
							break;
						}
					}
					if(!$bExist)
					{
						array_push($oItem_Scene_Time[$a['item']], array('scene_key'=>$a['scene'],'scene_name'=>$thatScene,'time_list'=>array($a['time']=>$thatTime)) );
					}
					
				}
			}

		}
		else
		{
			$oItemList = $oSysItem;
			$oSceneList = $oSysScene;
			$oTimeList = $oSysTime;

		}
		//默认汇总
		//$this->load->helper('site');
		//$oDefaultPrice = _get_product_default_price();
		//$oProductList = array_merge($oDefaultPrice, $oProductList);


		// $list = array(
		// 	array('id'=>1,'datetime'=>'2015-05-01 8:30:00','title'=>'周末特色文化广场活动吧','yinyueji'=>1,'classid'=>1),
		// 	array('id'=>11,'datetime'=>'2015-05-11 10:00:03','title'=>'周末特色文化广场活动','yinyueji'=>1,'classid'=>1),
		// 	array('id'=>2,'datetime'=>'2015-05-9 16:00:00','title'=>'test','yinyueji'=>0,'classid'=>1),
		// 	array('id'=>3,'datetime'=>'2015-05-1 18:00:00','title'=>'kk','yinyueji'=>1,'classid'=>12),
		// 	array('id'=>5,'datetime'=>'2015-05-15 9:20:20','title'=>'测试','yinyueji'=>1,'classid'=>1),
		// 	);

		/* //订单->档期
		$oSysPaystatus = $this->config->item('get_paystatus');
		$arrWhere = array('a.sellerid'=>$userid,
				'a.status'=>1,'paystatus'=>"'".$oSysPaystatus[3]."'");
		$tb = $dbprefix.'order a left join '.$dbprefix.'order_book b on(a.id=b.orderid)';
		$list_result = $this->Order_model->fetch_page(1, 100, $arrWhere,'a.id,a.title,b.begtime,b.endtime','a.addtime desc',$tb);

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
		*/

		//档期
		$arrWhere = array('userid'=>$userid,
				'status'=>1);
		$list = $this->Schedule_model->fetch_page(1, 100, $arrWhere,'id,dodate as datetime,0 as endtime,thing as title','addtime desc');
		
		$result = array(
			//'o' => $o,
			'oItemList'=> $oItemList,
			'oSceneList'=> $oSceneList,
			'oTimeList'=> $oTimeList,

			'oSysScene'=>$oSysScene,
			'oSysTime'=>$oSysTime,
			
			'oProductList' => $oProductList,
			'oItem_Scene_Time' => $oItem_Scene_Time,
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