<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderbook extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Orderbook_model');
    }
	
    //默认执行index
	public function index()
	{
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Orderbook_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('admin/orderbook', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);


		$this->load->view('admin/orderbook',$result);
	}

	public function add()
	{
		//需要修改
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Orderbook_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('admin/orderbook_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
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
                     'field'   => 'pertime', 
                     'label'   => '计价方式', 
                     'rules'   => 'trim|required|numeric'
                  ),  
                array(
                     'field'   => 'price', 
                     'label'   => '预定价格', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'begtime', 
                     'label'   => '期望拍片开始日期', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'endtime', 
                     'label'   => '期望拍片结束日期', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'linkman', 
                     'label'   => '联 系 人', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'linkway', 
                     'label'   => '联系方式', 
                     'rules'   => 'trim|required'
                  ),                  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					'item'=>$this->input->post('item'),
					'scene'=>$this->input->post('scene'),
					'pertime'=>$this->input->post('pertime'),
					'price'=>$this->input->post('price'),					
					'memo'=>$this->input->post('memo'),
					'begtime'=>$this->input->post('begtime'),
					'endtime'=>$this->input->post('endtime'),
					'linkman'=>$this->input->post('linkman'),
					'linkway'=>$this->input->post('linkway'),
					
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Orderbook_model->insert($data);

				//echo '成功,<a href="/admin/aa">返回列表页</a>';
				redirect(base_url('/admin/orderbook'));
				exit;
  			}
  			else
  			{
  				$id	= _get_key_val($this->input->get('id'), TRUE);
				$result = array();

				if(!empty($id))
				{
					$info = $this->Orderbook_model->get_info_by_id($id);
					$result = array(
						'info'=>$info,
						);
				}
  				$this->load->view('admin/orderbook_add',$result);
  				//redirect('/admin/orderbook/add?id='.$this->input->get('id'));
  			}
			



		}
	}

	function del(){
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$page = _get_page();

		$this->Orderbook_model->delete_by_id($id);
		redirect( base_url('/admin/orderbook?page='.$page) );

	}
}
