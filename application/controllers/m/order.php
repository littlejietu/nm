<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }
	

	public function index()
	{
		$get_paystatus = (int)$this->input->get('paystatus');
		$get_keyword = $this->input->post('keyword')?$this->input->post('keyword'):$this->input->get('keyword');
		$dbprefix = $this->User_model->db->dbprefix;
		$userid = $this->thatUser['id'];
		if($this->loginUserNum && $this->loginUserNum['be_ordernum_new'])
		{
			$this->load->service('Num_service');
			$this->num_service->clear_user_num($userid, 'be_ordernum_new');
		}

		//超过一小时的，自动关闭订单
		//'sellerid'=>$userid,
		$this->Order_model->update_by_where(array('addtime <'=>(time()-60*60),'paystatus'=>'waitpay','status'=>1,'reject'=>0 ),array('reject'=>-1) );

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();		//条件
		if( in_array($this->thatUser['usertype'], array(1,4,5)) )
		{
			$arrWhere = array('a.sellerid'=>$userid,'a.status'=>1);
		}
		else
		{
			$arrWhere = array(" a.status=1 and ( a.buyerid =$userid  or a.sellerid in(select id from ".$dbprefix."user where insid=".$this->loginInsID.") )"=>'');
		}
		if($get_paystatus)
		{
			$oSysGetPaystatus = $this->config->item('get_paystatus');
			$arrWhere['paystatus']="'".$oSysGetPaystatus[$get_paystatus]."'";
			$arrParam['paystatus']=$get_paystatus;
		}
		if($get_keyword)
		{
			$arrWhere['@like']=array('title'=>$get_keyword);
			$arrParam['keyword']=$get_keyword;
		}

		$tb = $dbprefix.'order a left join '.$dbprefix.'order_book b on(a.id=b.orderid)';
		$list = $this->Order_model->fetch_page($page, $pagesize, $arrWhere,'a.*,b.begtime,b.endtime','a.addtime desc',$tb);
		//echo $this->Order_model->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/order', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$oSysPaystatus = $this->config->item('paystatus');

		$result = array(
			'list' => $list,
			'oSysPaystatus' => $oSysPaystatus,
			'keyword' => !empty($arrParam['keyword'])?$arrParam['keyword']:'',
			);

		//print_r($list);
		$this->load->view('m/order',$result);
	}

	public function detail(){
		$id = _get_key_val($this->input->get('id'),true);
		$o = $this->Order_model->get_by_id($id);
		$this->load->model('Orderbook_model');
		$oBook = $this->Orderbook_model->get_by_where(array('orderid'=>$id));

		if($oBook)
			$o = array_merge($oBook, $o);

		$oSysItem = _get_config('workitem');
		$oSysScene = _get_config('workscene');
		$oSysTime = _get_config('worktime');

		$result = array(
			'o' => $o,
			'oSysItem' => $oSysItem,
			'oSysScene' => $oSysScene,
			'oSysTime' => $oSysTime,
			);

		$this->load->view('m/orderdetail',$result);
	}

	public function reject()
	{
		$dbprefix = $this->User_model->db->dbprefix;
		$id = _get_key_val($this->input->get('id'),true);
		if(!$this->loginInsID)
			$arrWhere = array('id'=>$id, 'sellerid'=>$this->thatUser['id']);
		else
			$arrWhere = "id=$id and (sellerid =".$this->thatUser['id']." or sellerid in(select id from ".$dbprefix."user where insid=".$this->loginInsID." ) )";
		$data = array('reject'=>-1);
		$this->Order_model->update_by_where($arrWhere, $data);

		redirect('/m/order');

	}

	public function agree()
	{
		$dbprefix = $this->User_model->db->dbprefix;
		$id = _get_key_val($this->input->get('id'),true);
		if(!$this->loginInsID)
			$arrWhere = array('id'=>$id, 'sellerid'=>$this->thatUser['id']);
		else
			$arrWhere = "id=$id and (sellerid =".$this->thatUser['id']." or sellerid in(select id from ".$dbprefix."user where insid=".$this->loginInsID." ) )";
		$data = array('reject'=>1);
		$this->Order_model->update_by_where($arrWhere, $data);

		redirect('/m/order');

	}

	public function del()
	{
		$id = _get_key_val($this->input->get('id'),true);
		if(!$this->loginInsID)
			$arrWhere = array('id'=>$id, 'sellerid'=>$this->thatUser['id']);
		else
			$arrWhere = "id=$id and (sellerid =".$this->thatUser['id']." or sellerid in(select id from ".$dbprefix."user where insid=".$this->loginInsID." ) )";
		$data = array('status'=>-1);
		$this->Order_model->update_by_where($arrWhere, $data);

		redirect('/m/order');

	}

	public function getinfo(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$o = $this->Order_model->get_info_by_id($id,'id,title, no,totalprice as price');
		if($o)
		{
			$o['id'] = _get_key_val($o['id']);
		}
		$res['code'] = 200;
		$res['data'] = $o;

		$this->view->json($res);
		exit;

	}

	public function modifyprice(){
		$res = array('code'=>0,'data'=>array());
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               	array(
                     'field'   => 'price', 
                     'label'   => '价格', 
                     'rules'   => 'trim|required'
                ),
                array(
                     'field'   => 'id', 
                     'label'   => '订单号', 
                     'rules'   => 'trim|required'
                ),
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$res['data'] = '修改成功';
  				$id	= _get_key_val($this->input->post('id'), TRUE);
  				if($id)
  				{
  					$data = array(
						'totalprice'=>$this->input->post('price'),
						'op_userid'=>$this->loginID,
						'op_username'=>$this->loginUserName,
						'op_time'=>time(),
					);
  				}
  				
  				$this->Order_model->update_by_id($id, $data);
				$res['code'] = 200;

  			}
  			else
  				$res['data']['error_messages'] = $this->form_validation->getErrors();

		}//-is_post()
		$this->view->json($res);
		exit;
	}

}