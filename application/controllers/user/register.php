<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * 注册页
 *
 * 
 */
class Register extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    
    public function index()
    {
        // if ($this->loginUser['id'])
        // {
        //     redirect('/m/index');
        // }
        

        $data = array(
            'usertype'=> $this->config->item('usertype'),
        );
        $this->load->view('user/register', $data);
    }
    
    
    
    private function check_360()
    {
        if ($_SERVER['QUERY_STRING'] && strpos(urldecode($_SERVER['QUERY_STRING']), '<')!==false)
        {//没实际意义。为了360高分而已        
            show_404();
            exit;
        }
    }
    public function success()
    {
        $this->check_360();
        if (!$this->loginID)
        {
//            redirect('register');
        }
        $result = array();
        $result['username'] = $this->loginUser['username'];
//        $result['user'] = insert_user_list(array('templete'=>'user_new_list_reg2','limit'=>8));
        $forward = $this->input->get('forward');
        
        if (preg_match('~http:\/\/(\w+)'.TRJ_DOMAIN.'~', $forward, $m))
        {
            $result['forward'] = $forward;
        }
        if($_GET['ver'] == 'base'){
        	$this->view->_template->css_path = $this->yun_url.'/assets/src/css/';
        	$this->view->display('user/register_success');
        	return;
        }elseif($_GET['ver'] == 'qr'){
        	$passwd_plaintext = $this->loginUser['passwd_plaintext'];
        	if($passwd_plaintext{0} == ':')
        	{
        		$this->load->library('des');
        		$result['passwd_plaintext'] = $this->des->decrypt(substr($passwd_plaintext, 1));
        		if (is_numeric($result['passwd_plaintext']))
        		{
        			$this->view->assign('ver', 'qr');
        		}
        	}
        }elseif ($_GET['ver'] == 'qk'){
            $passwd_plaintext = $this->loginUser['passwd_plaintext'];
            if($passwd_plaintext{0} == ':')
            {
                $this->load->library('des');
                $result['passwd_plaintext'] = $this->des->decrypt(substr($passwd_plaintext, 1));
                if (is_numeric($result['passwd_plaintext']))
                {
                    $this->view->assign('ver', 'v1');                    
                }
            }
        }
        elseif ($_GET['ver'] == 'v2')
        {
        	$this->view->assign('mobile',$this->loginUser['mobile']);
        	$this->view->assign('mobilecode',$this->input->get('mobilecode'));
        }
        elseif ($this->loginUser['email'])
        {
            $result['email_url'] = 'http://mail.'.array_pop(explode('@', $this->loginUser['email']));        
            $this->sendemail($this->input->cookie('IsSendEmail') ? false : true);
        }

        $this->view->assign('result', $result);
        $this->view->display('user/reg_success');
    }
    
    function sendmail()
    {
        $res = array('code'=>0,'data'=>array());
        if($this->input->is_ajax_request())
        {
            $this->sendemail(true);
            $res['code'] = 200;
        }
        $this->view->json($res);
    }
    
    private function sendemail($flag=false)
    {
        if($this->loginUser['id'] && $this->loginUser['email'] && $this->loginUser['email_true']==0 && $flag===true)
        {
            $this->load->model('User_cert_model');
            $data = array(	
    			'uid'=>$this->loginUser['id'],
    			'username'=>$this->loginUser['username'],
    			'cert_type'=>1,
    			'cert_code'=>'email',
    			'cert_content'=>'{"email":"'.$this->loginUser['email'].'"}',
    			'addtime'=>$this->timestamp,
    			'updatetime'=>$this->timestamp,
    			'is_shenhe'=>0,
    			'shenhe'=>0,
    		);
    		$certid = $this->User_cert_model->insert($data);
    		
    		$email = $this->loginUser['email'];
            //发邮件
    		$this->load->library('encrypt');
    		$code = $this->loginUser['id'].'|'.$certid.'|'.$email.'|'.$this->timestamp;
    		$code .= md5('!#%&)'.$code.'!#%&)');
    		$code = $this->encrypt->encode($code);
            
    		$param = array('username'=>$email, 'content'=>'您的邮箱激活地址：<a href="http://'.$_SERVER['HTTP_HOST'].'/util/vcemail.html?code='.$code.'" target=_blank>点此激活</a>' );
    		$this->view->assign('email', $param);
    		$html = $this->view->fetch('/library/email/cert_email','.lbi');
    		if(send_email($email, '邮箱激活', $html, '投融会员'))
    		{
    		    $this->input->set_cookie('IsSendEmail', 1, 0, TRJ_DOMAIN);
    		}
        }
    }

}
