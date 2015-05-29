<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }
	

	public function index()
	{
		$userid = $this->thatUser['id'];
		$nickname = $this->thatUser['nickname'];
		//is_post()
		if ($this->input->is_post())
		{
			//验证规则		required必填项
			$config = array(
                array(
                     'field'   => 'code', 
                     'label'   => '工作', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'price', 
                     'label'   => '工作价格', 
                     'rules'   => 'required'
                  ),
            );
            $arrCode = $this->input->post('code');
			$arrPrice = $this->input->post('price');
			if(count($arrCode)!=count($arrPrice))
			{
				echo '请正确提交数据';die;
			}
			//-验证规则

            $this->form_validation->set_rules($config);
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() === TRUE)
  			{

  				foreach ($arrCode as $key => $v) {
  					
					$aItem = explode('_', $v);
					if(count($aItem)==3)
					{
						$data = array(					
							'userid'=>$userid,
							'nickname'=>$nickname,					
							'item'=>$aItem[0],					
							'scene'=>$aItem[1],
							'time'=>$aItem[2],
							'price'=>$arrPrice[$key],
							'status'=>1,
							'addtime'=>time(),
							'op_userid'=>$this->loginID,
							'op_username'=>$this->loginUserName,
							'op_time'=>time(),
						);

						//保存数据库
		  				$this->Product_model->insert_update($data);
					}	

  				}
				
  			}//-form_validation TRUE

		}//-is_post()

		$list = $this->Product_model->fetch_rows("userid=$userid and status=1", '*','addtime');
		$result = array(
			'list' => $list,
			'workitem'=> $this->config->item('workitem'),
			'workscene'=> $this->config->item('workscene'),
			'worktime'=> $this->config->item('worktime'),
			);
		$this->load->view('m/product',$result);
	}

}