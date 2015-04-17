<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tt extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Tt_model');
    }
	
    //默认执行index
	public function index()
	{
		//从数据库读取数据
		$list = $this->Tt_model->get_list();

		//页面所需要的数据放入$result
		$result = array(
			'list' => $list,
			);
		// 加载页面绑定数据
		$this->load->view('m/tt',$result);
	}

	//添加
	public function add()
	{
		//需要修改
		//从加密串中取得id值
		$id	= _get_key_val($this->input->get('id'), TRUE);
		//echo $this->input->get('id').'---'.$id;
		$result = array();

		if(!empty($id))
		{
			//从数据库中读取此id的详细记录
			$info = $this->Tt_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		
		// 绑定添加页面
		$this->load->view('m/tt_add', $result);
	}
	//保存数据
	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
				array(
                     'field'   => 'name', 
                     'label'   => '姓名', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'phone', 
                     'label'   => '电话', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'content', 
                     'label'   => '内容', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);


			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
  					'name'=>$this->input->post('name'),
  					'phone'=>$this->input->post('phone'),
					'title'=>$this->input->post('title'),
					'content'=>$this->input->post('content'),
					'addtime'=>time(),
				);

  				//取得需要修改的id
  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;
  				//写进数据库
  				$this->Tt_model->insert($data);

				echo '成功,<a href="/m/tt">返回列表页</a>';
				exit;
  			}
			



		}

		$this->load->view('/m/tt_add');
		//redirect('/m/comment');
	}
}
