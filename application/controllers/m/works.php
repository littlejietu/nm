<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Album_model');
        $this->load->model('Photo_model');
    }
	

	public function index()
	{
		// $id = _get_key_val($this->input->get('id'),true);
		// $o = $this->Order_model->get_info_by_id($id);
		// $result = array(
		// 	'o' => $o,
		// 	);
		$page     = _get_page();
		$pagesize = 3;
		$arrParam = array();
		$arrWhere = array();

		$list = $this->Album_model->fetch_page($page, $pagesize, $arrWhere);
		//echo $this->db->last_query();die;
		

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url('m/works', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();

		$result = array(
			'list' => $list,
			);
		
		$this->load->view('m/works',$result);
	}

	public function addalbum(){
		$res = array('code'=>0,'data'=>array());
		
		if ($this->input->is_post())
		{
			//验证规则
			$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => '相册名称', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'memo', 
                     'label'   => '相册描述', 
                     'rules'   => 'trim|required'
                  ),
            );

            $this->form_validation->set_rules($config);

			if ($this->form_validation->run() === TRUE)
  			{
  				$res['data'] = '添加成功';
  				$id	= _get_key_val($this->input->post('id'), TRUE);
  				if($id)
  				{
  					$res['data'] = '修改成功';
  					$data = array(
						'title'=>$this->input->post('title'),
						'memo'=>$this->input->post('memo'),
						'updatetime'=>time(),
						'op_userid'=>$this->loginID,
						'op_nickname'=>$this->loginNickName,
						'op_time'=>time(),
					);
					$data['id'] = $id;
  				}
  				else
  				{
	  				$data = array(
	  					'userid'=>$this->loginID,
	  					'nickname'=>$this->loginNickName,
	  					'insid'=>$this->loginInsID,
						'title'=>$this->input->post('title'),
						'memo'=>$this->input->post('memo'),
						'addtime'=>time(),
						'status'=>1,
						'op_userid'=>$this->loginID,
						'op_nickname'=>$this->loginNickName,
						'op_time'=>time(),
					);
				}

  				$this->Album_model->insert($data);
				$res['code'] = 200;

  			}
  			else
  				$res['data']['error_messages'] = $this->form_validation->getErrors();

		}//-is_post()
		$this->view->json($res);
		exit;

	}

	public function album(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->get('id'), TRUE);
		$o = $this->Album_model->get_info_by_id($id,'title,memo');
		$res['code'] = 200;
		$res['data'] = $o;

		$this->view->json($res);
		exit;

	}

	public function delalbum(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->post('id'), TRUE);
		
		$this->Album_model->update_by_where(array('id'=>$id, 'userid'=>$this->loginID),array('status'=>0));
		$res['code'] = 200;

		$this->view->json($res);
	}

	public function photo(){
		$id = _get_key_val($this->input->get('id'), TRUE);
		$arrWhere = array('userid'=>$this->loginID,'status'=>1);

		$list = $this->Album_model->get_list($arrWhere,'id,title');
		$photolist = $this->Photo_model->get_list($arrWhere,'id,img,title');

		$result = array(
			'albumlist' => $list,
			'photolist' => $photolist,
			);
		$this->load->view('m/worksphoto',$result);

	}

	public function delphoto(){
		$res = array('code'=>0,'data'=>array());
		$id	= _get_key_val($this->input->post('id'), TRUE);
		$this->Photo_model->update_by_where(array('id'=>$id, 'userid'=>$this->loginID),array('status'=>0));
		$res['code'] = 200;

		$this->view->json($res);
	}

	public function getphoto(){
		$res = array('code'=>0,'data'=>array());
		$id = _get_key_val($this->input->post('albumid'), TRUE);
		$arrWhere = array('albumid'=>$id,'userid'=>$this->loginID,'status'=>1);

		$photolist = $this->Photo_model->get_list($arrWhere,'id,img,title');
		$res['code'] = 200;
		$res['data']['photolist'] = $photolist;

		$this->view->json($res);
	}

}