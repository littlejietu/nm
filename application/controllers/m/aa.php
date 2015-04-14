<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aa extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Aa_model');
    }
	
    //默认执行index
	public function index()
	{
		//
		$list = $this->Aa_model->get_list();

		$result = array(
			'list' => $list,
			);

		$this->load->view('m/aa',$result);
	}

	public function add()
	{
		//需要修改
		// $id	= _get_key_val($this->input->get('id'), TRUE);
		 $result = array();

		// if(!empty($id))
		// {
		// 	$info = $this->Aa_model->get_info_by_id($id);
		// 	$result = array(
		// 		'info'=>$info,
		// 		);
		// }
		

		$this->load->view('m/aa_add', $result);
	}

	public function save()
	{
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               array(
                     'field'   => 'name', 
                     'label'   => '标题', 
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'memo', 
                     'label'   => '内容', 
                     'rules'   => 'trim|required'
                  ),  
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
					'name'=>$this->input->post('name'),
					'memo'=>$this->input->post('memo'),
					'addtime'=>time(),
				);

  				// $id	= _get_key_val($this->input->get('id'), TRUE);
  				// if($id)
  				// 	$data['id'] = $id;

  				$this->Aa_model->insert($data);

				echo '成功,<a href="/m/aa">返回列表页</a>';
				exit;
  			}
			



		}

		$this->load->view('/m/aa_add');
		//redirect('/m/comment');
	}
}
