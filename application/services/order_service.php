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
		$res = array('code'=>0, 'data'=>array());
		$config = array(
           	array(
                 'field'   => 'booked_userid', 
                 'label'   => '登录用户', 
                 'rules'   => 'trim|required'
            ),
            array(
                 'field'   => 'item', 
                 'label'   => '工作内容', 
                 'rules'   => 'trim|required'
            ),
           	array(
                 'field'   => 'scene', 
                 'label'   => '工作场景', 
                 'rules'   => 'trim|required'
            ),  
            array(
                 'field'   => 'time', 
                 'label'   => '计价方式', 
                 'rules'   => 'trim|required'
            ),
            // array(
            //      'field'   => 'begtime', 
            //      'label'   => '预订时间', 
            //      'rules'   => 'trim|required'
            // ),
        );

        $this->ci->form_validation->set_rules($config);

		if ($this->ci->form_validation->run() === TRUE)
		{
			$item = $this->ci->input->post('item');
			$scene = $this->ci->input->post('scene');
			$time = $this->ci->input->post('time');

			$buyerid = $this->ci->loginID;
			if(!$buyerid)
				$buyerid = (int)$this->ci->input->post('buyerid');
			$sellerid = _get_key_val( $this->ci->input->post('booked_userid'), true);
			$price = $this->ci->Product_model->get_produdct_by_uist($sellerid, $item, $scene, $time);
			if(!$price)
				$price = $this->ci->config->item('workprice');
			$begtime='2015-5-14';//$this->ci->input->post('begtime');		//格式:2015-5-15

			$oSysKind = $this->ci->config->item('orderkind');
			$no = date('YmdHis',time()).rand(10000,99999);
			$o = array(
					'sellerid'=>$sellerid,
					'no'=>$no,
					'kind'=>$oSysKind['book'],
					'buyerid'=>$buyerid,
					'buyer_username'=>$this->ci->loginUserName,
					'buyer_nickname'=>$this->ci->loginNickName,
					'addtime'=>time(),
					'paystatus'=>'waitpay',
					'status'=>1,
					'reject'=>0,
					'op_userid'=>$buyerid,
					'op_username'=>$this->ci->loginUserName,
					'op_time'=>time(),
				);
			$oBook = array(
					'sellerid'=>$sellerid,
					'no'=>$no,
					'item'=>$item,
					'scene'=>$scene,
					'time'=>$time,
					'num'=>( (int)$this->ci->input->post('num') == 0)?1:(int)$this->ci->input->post('num'),
					'memo'=>$this->ci->input->post('memo'),
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

			$oBook['begtime'] = strtotime($begtime);
			if($oBook['time']==1)	//时间:天
			{
				$oBook['begtime'] = $oBook['begtime'] + 24*60*60*$num;
			}
			else if($oBook['time']==2)	//时
			{
				if(date('H',$begtime)==0)
					$oBook['begtime'] = strtotime($begtime)+8*60*60;
				$oBook['begtime'] = $oBook['begtime'] + 60*60*$num;
			}
			$o['totalprice'] = $o['price'] * $oBook['num'];

			$orderid = $this->ci->Order_model->insert_string($o);
			$oBook['orderid'] = $orderid;
			$outerid = $this->ci->Orderbook_model->insert_string($oBook);
			$this->ci->Order_model->update_by_id($orderid, array('outerid'=>$outerid));
			$res['code'] = 200;
		}
		else
		{
			$res['data']['error_messages'] = $this->ci->form_validation->getErrors();
		}

		return $res;

	}


}