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
		//$where  = array();
        // if ($title)
        // {
        //     $where['title'] = $title;
        // }
		$list = $this->Comment_model->get_list();

		$result = array(
			'list' => $list,
			);

		$this->load->view('m/comment',$result);
	}

	public function add()
	{
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$result = array();

		if(!empty($id))
		{
			$info = $this->Comment_model->get_info_by_id($id);
			$result = array(
				'info'=>$info,
				);
		}
		

		$this->load->view('m/comment_add', $result);
	}

	public function save()
	{
		//$res = array('code'=>0,'data'=>array());
		if ($this->input->is_post())
		{

			$config = array(
               array(
                     'field'   => 'title', 
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
					'title'=>$this->input->post('title'),
					'memo'=>$this->input->post('memo'),
					'addtime'=>time(),
				);

  				$id	= _get_key_val($this->input->get('id'), TRUE);
  				if($id)
  					$data['id'] = $id;

  				$this->Comment_model->insert($data);

				echo '成功,<a href="/m/comment">返回列表页</a>';
				exit;
  			}
			/*
			$res = array(
					'code' => 201,
					'data' => array(
						'message' => '对不起，您已经提交过该调查问卷了！',
					),
				);

			_get_json($res);
			exit;
			*/



		}

		$this->load->view('/m/comment_add');
		//redirect('/m/comment');
	}
}
