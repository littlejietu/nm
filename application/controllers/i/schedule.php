<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
    }
	

	public function index($userid)
	{
		$y = $this->input->post('y');
		$m = $this->input->post('m');
		if(empty($y)) $y = date('Y');
		if(empty($m)) $m = date('m');

		$oUser = $this->User_model->get_info_by_id($userid);

		$oProduList = $this->Product_model->get_product_by_uid($userid);
		$oProductList = array();
		foreach ($oProduList as $key => $a) {
			$oProductList[ $a['item'] .'_'. $a['scene'] .'_'. $a['time'] ] = $a['price'];
		}

		$this->load->helper('site');
		$oDefaultPrice = _get_product_default_price();

		$oProductList = array_merge($oDefaultPrice, $oProductList);
		//print_r($oProductList);


		
		

		$list = array(
			array('id'=>1,'datetime'=>'2015-05-01 8:30:00','title'=>'周末特色文化广场活动吧','yinyueji'=>1,'classid'=>1),
			array('id'=>11,'datetime'=>'2015-05-11 10:00:03','title'=>'周末特色文化广场活动','yinyueji'=>1,'classid'=>1),
			array('id'=>2,'datetime'=>'2015-05-9 16:00:00','title'=>'test','yinyueji'=>0,'classid'=>1),
			array('id'=>3,'datetime'=>'2015-05-1 18:00:00','title'=>'kk','yinyueji'=>1,'classid'=>12),
			array('id'=>5,'datetime'=>'2015-05-15 9:20:20','title'=>'测试','yinyueji'=>1,'classid'=>1),
			);

		
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
		if(!$this->loginID)
		{
			$res['code'] = 201;
			$res['data']['error'] = '请先登录';
		}
		else{

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
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{

  				$buyerid = $this->loginID;
				$sellerid = _get_key_val( $this->input->post('booked_userid'), true);
				$price = $this->Product_model->get_price_by_produdct($sellerid, $item, $scene, $time);
				if(!$price)
					$price = _get_product_default_price();
				$oSeller = $this->User_model->get_by_id($sellerid);

				
  				$data = array(
  					'buyerid'=>$buyerid,
  					'sellerid'=>$sellerid,
  					'seller_username'=>$oSeller['username'],
					'item'=>$this->input->post('item'),
					'scene'=>$this->input->post('scene'),
					'time'=>$this->input->post('time'),
					'price'=>$this->input->post('price'),
					'status'=>$this->input->post('status'),
				);

  				$this->Order_model->insert($data);

				$res['code'] = 200;
				
				// else
				// {
				// 	$res['code'] = 201;
				// 	$res['data']['error_messages']='不存在此产品';

				// }
  			}
  			else
			{
				$res['data']['error_messages'] = $this->form_validation->getErrors();
			}



		}

		
		

		$this->view->json($res);

	}

}