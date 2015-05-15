<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Order_service
{
	public function __construct()
	{
		$this->ci = & get_instance();
		$this->ci->load->model('Order_model');
		$this->ci->load->model('User_model');
		$this->ci->load->model('Product_model');
	}

	//sellerid,buyerid,item,scene,time,num,memo,linkman,linkway,begtime,endtime,seller_username,seller_nickname,buyer_username,buyer_nickname
	public function book()
	{
		$sellerid = $this->ci->input->post('sellerid');
		$buyerid = $this->ci->loginID;
		$oSysKind = $this->ci->config->item('orderkind');
		$no = date('YmdHis',time()).rand(10000,99999);
		$o = array(
				'sellerid'=>$sellerid,
				'no'=>$no,
				'kind'=>$oSysKind['book'],
				'buyerid'=>$buyerid,
				'buyer_username'=>$this->loginUserName,
				'buyer_nickname'=>$this->loginNickName,
				'addtime'=>time(),
				'paystatus'=>'waitpay',
				'status'=>1,
				'reject'=>0,
				'op_userid'=>$buyerid,
				'op_username'=>$this->loginUserName,
				'op_time'=>time(),
			);
		$oBook = array(
				'sellerid'=>$sellerid,
				'no'=>$no,
				'item'=>$this->ci->input->post('item'),
				'scene'=>$this->ci->input->post('scene'),
				'time'=>$this->ci->input->post('time'),
				'price'=>$this->ci->input->post('price'),
				'num'=>$this->ci->input->post('num'),
				'begtime'=>$this->ci->input->post('begtime'),
				'linkman'=>$this->ci->input->post('linkman'),
				'linkway'=>$this->ci->input->post('linkway'),

			);

		if(!isset($o['seller_username']) || !isset($o['seller_nickname']))
		{
			$oSeller = $this->ci->load->User_model->get_by_id($sellerid);
			if(!empty($oSeller))
			{
				$o['seller_username'] = $oSeller['username'];
				$o['seller_nickname'] = $oSeller['nickname'];
			}
		}

		if(!isset($o['buyer_username']) || !isset($o['buyer_nickname']))
		{
			$oBuyer = $this->ci->load->User_model->get_by_id($sellerid);
			if(!empty($oBuyer))
			{
				$o['buyer_username'] = $oBuyer['username'];
				$o['buyer_nickname'] = $oBuyer['nickname'];
			}
		}

		if($oBook['time']==1)	//时间:天
		{
			
			$oBook['begtime'] = strtotime($oBook['begtime']);
		}
		else if($oBook['time']==2)	//时
		{

		}

		//$o['price'] = $this->ci->Product_model->get_price_by_xx($sellerid, $item, $scene, $time);
		if(!$o['price'])
			$o['price'] = $this->ci->config->item('workprice');
		$o['totalprice'] = $o['price'] * $oBook['num'];

		$this->ci->Order_model->insert($o);


		$data = array()

	}


}