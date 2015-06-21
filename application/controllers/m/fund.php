<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->model('Usernum_model');
    }
	

	public function index()
	{

		//is_post()
		if ($this->input->is_post())
		{
			$that_userid = $this->thatUser['id'];
			//验证规则
			$config = array(
                array(
                     'field'   => 'account', 
                     'label'   => '帐户', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$account = $this->input->post('account');
  				$data = array('account'=>$account);
				//保存数据库
				$this->load->model('Userdetail_model');
				$this->Userdetail_model->update_by_where(array('userid'=>$that_userid), $data);

				redirect(base_url('/m/fund'));
			}

		}//-is_post()

		$get_paystatus = (int)$this->input->get('paystatus');
		$get_keyword = $this->input->post('keyword')?$this->input->post('keyword'):$this->input->get('keyword');
		$dbprefix = $this->User_model->db->dbprefix;


		$id = _get_key_val($this->input->get('id'),true);
		$o = $this->Usernum_model->get_by_id($this->thatUser['id']);
		$oDetail = $this->Userdetail_model->get_by_where(array('userid'=>$this->thatUser['id']));
		if($oDetail)
			$o = array_merge($oDetail, $o);
		$oSysPaystatus = $this->config->item('get_paystatus');

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('a.sellerid'=>$this->thatUser['id'],'status'=>1,'paystatus'=>"'".$oSysPaystatus[2]."'");
		if($get_keyword)
		{
			$arrParam['keyword']=$get_keyword;
			$arrWhere['@like']=array('title'=>$get_keyword);
		}
		$tb = $dbprefix.'order a left join '.$dbprefix.'order_book b on(a.id=b.orderid)';
		$list = $this->Order_model->fetch_page($page, $pagesize, $arrWhere,'a.*,b.begtime,b.endtime','a.addtime desc',$tb);
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/order', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'o' => $o,
			'list' => $list,
			'keyword' => !empty($arrParam['keyword'])?$arrParam['keyword']:'',
			);
		
		$this->load->view('m/fund',$result);
	}


}