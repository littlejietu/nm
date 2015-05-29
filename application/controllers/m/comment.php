<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Comment_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array('touserid'=>$userid);		//条件

		$list = $this->Comment_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/Comment', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);
		
		$this->load->view('m/comment',$result);
	}

	public function add(){
		$userid = $this->thatUser['id'];

		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
                array(
                     'field'   => 'figure', 
                     'label'   => '身材样貌', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'skill', 
                     'label'   => '专业技能', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'efficiency', 
                     'label'   => '工作效率', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'attitude', 
                     'label'   => '工作态度', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'memo', 
                     'label'   => '评价内容', 
                     'rules'   => 'trim|required'
                  ),
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$orderid = $this->input->post('orderid');
  				$commentid = (int)$this->input->post('commentid');
				$this->load->model('Order_model');
				$oOrder = $this->Order_model->get_by_id($orderid);
				if($oOrder && ($oOrder['buyerid']==$userid || $oOrder['sellerid']==$userid))
				{
					if($oOrder['buyerid']==$userid)
					{
						$touserid = $oOrder['sellerid'];
						$tonickname = $oOrder['seller_nickname'];
					}
					else if($oOrder['sellerid']==$userid)
					{
						$touserid = $oOrder['buyerid'];
						$tonickname = $oOrder['buyer_nickname'];
					}

					if($touserid && $tonickname)
					{
						$data = array(
		  					'touserid'=>$touserid,
		  					'tonickname'=>$tonickname,
		  					'userid'=>$this->thatUser['id'],
		  					'nickname'=>$this->thatUser['nickname'],
		  					'logo'=>$this->thatUser['userlogo'],
		  					'commentid'=>$commentid,
		  					'orderid'=>$orderid,
							'figure'=>$this->input->post('figure'),
							'skill'=>$this->input->post('skill'),
							'efficiency'=>$this->input->post('efficiency'),
							'attitude'=>$this->input->post('attitude'),
							'memo'=>$this->input->post('memo'),
							'addtime'=>time(),
							'display'=>1,
							'status'=>1,
							'op_userid'=>$this->loginID,
							'op_nickname'=>$this->loginNickName,
							'op_time'=>time(),
						);

		  				$this->Comment_model->insert($data);
		  				$commentstatus = 1;
		  				if($commentid)
		  					$commentstatus = 2;
		  				$this->Order_model->update_by_where(array('id'=>$orderid), array('commentstatus'=>$commentstatus));

		  				$this->load->service('Num_service');
		  				$this->num_service->set_user_num($touserid,'be_commentnum');
		  				$this->num_service->set_user_num($touserid,'be_commentnum_new',1);
						$this->num_service->set_user_num($this->thatUser['id'],'commentnum');
						$this->num_service->set_user_num($this->thatUser['id'],'commentnum_new',1);

						redirect(base_url('/m/order'));
						exit;
					}
					
				}

  				
  			}

		}

		$get_orderid = _get_key_val($this->input->get('orderid'),true);
		$get_commentid = _get_key_val($this->input->get('commentid'),true);

		$info = array('orderid'=>$get_orderid,'commentid'=>$get_commentid);

		$result = array(
			'info' => $info,
			);
		$this->load->view('m/commentadd',$result);
	}

}