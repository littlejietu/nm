<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AjaxAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
	public function index()
	{
        $this->L('indexmodel');
        //取头部管理员数据
        $userInfo       = $this->indexmodel->getUserInfo($this->session->userdata['admin_id']);

        //根据管理员处理应该显示的左侧
        $myLeft        = $this->getLeft();
        $data           = array(
            'leftList'      => $myLeft,
            'userInfo'      => $userInfo,
        );
        $this->load->view('index',$data);
	}

    /*修改左侧排序*/
    public function changeLeftSequence(){
        $this->L('AjaxModel');
        $sysId      = $this->input->post('sysId');
        $sysValue   = $this->input->post('sysValue');
        $sysValue   = empty($sysValue)?0:$sysValue;
        if(!empty($sysId)){
            $this->AjaxModel->changeLeftSequence($sysId,$sysValue);
            echo json_encode('success');
        }
    }

    /*删除左侧栏目*/
    public function delLeft(){
        $this->L('AjaxModel');
        $sysId      = $this->input->post('sysId');
        if($this->session->userdata['user_level'] > 1){
            echo json_encode('noPower');
        }
        if(!empty($sysId)){
            $this->AjaxModel->delLeft($sysId);
            echo json_encode('success');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */