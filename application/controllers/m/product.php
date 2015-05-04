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
		$userid = $this->loginID;
		//is_post()
		if ($this->input->is_post())
		{
			//验证规则		required必填项
			$config = array(
                array(
                     'field'   => 'height', 
                     'label'   => '身高', 
                     'rules'   => 'trim|required'
                  ),  
                array(
                     'field'   => 'weight', 
                     'label'   => '体重', 
                     'rules'   => 'trim|required'
                  ),
                array(
                     'field'   => 'BWH', 
                     'label'   => '三围', 
                     'rules'   => 'trim|required'
                  ),
            );
			if(!$this->loginRealNickName)
				$config[] = array(
                     'field'   => 'nickname', 
                     'label'   => '昵称', 
                     'rules'   => 'trim|required'
                  );
			//-验证规则


            $this->form_validation->set_rules($config);
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() === TRUE)
  			{
  				$bust=$waist=$hips=0;
  				$arrBWH = explode('-', $this->input->post('BWH')) ;
				if(count($arrBWH)>=1)
					$bust = $arrBWH[0];
				if(count($arrBWH)>=2)
					$waist = $arrBWH[1];
				if(count($arrBWH)>=3)
					$hips = $arrBWH[2];

  				$data = array(					
					'userlogo'=>$this->input->post('userlogo'),
					'realname'=>$this->input->post('realname'),					
					'mobile'=>$this->input->post('mobile'),					
					'sex'=>$this->input->post('sex'),
					'city'=>$this->input->post('city'),					
				);

				$data_detail = array(
					'height'=>$this->input->post('height'),
					'weight'=>$this->input->post('weight'),
					'bust'=>$bust,
					'waist'=>$waist,
					'hips'=>$hips,
					'shoes'=>$this->input->post('shoes'),
					'cup'=>$this->input->post('cup'),
					);
				$data_memo = array(
					'brand'=>$this->input->post('brand'),
					'brandtype'=>$this->input->post('brandtype'),
					'awards'=>$this->input->post('awards'),
					'fee'=>$this->input->post('fee'),
					'servicetime'=>$this->input->post('servicetime'),
					'takenote'=>$this->input->post('takenote'),
					'planeshot'=>$this->input->post('planeshot'),
					'tactivity'=>$this->input->post('tactivity'),
					'telead'=>$this->input->post('telead'),
					'magazine'=>$this->input->post('magazine'),					
					);
				if(!$this->loginRealNickName)
					$data['nickname']=$this->input->post('nickname');
  				
  				//$data['id'] = $userid;
 				//echo $userid;      			
      			//print_r($data);
				//print_r($data_detail);
				//print_r($data_memo);
				//die;

				//保存数据库
  				$this->User_model->update_info_by_id($userid, $data, $data_detail, $data_memo);
				
  			}//-form_validation TRUE

		}//-is_post()

		$o = $this->Product_model->get_list('userid=$userid and status=1', '*','addtime');
		$result = array(
			'o' => $o,
			'workitem'=> $this->config->item('workitem'),
			'workscene'=> $this->config->item('workscene'),
			'worktime'=> $this->config->item('worktime'),
			);
		$this->load->view('m/product',$result);
	}

}