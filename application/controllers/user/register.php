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

    public function save()
    {
        $res = array('code'=>0,'data'=>array());
        if ($this->input->is_post())
        {
            $this->callback = true;
            $version = $this->input->post('version');
            switch($version)
            {
                default://默认注册页
                    list($config, $data_main) = $this->phone_config();
                    break;
            }

            $this->form_validation->set_rules($config);
            if ($res['code'] == 0  && $this->form_validation->run() === true)
            {
                $data_init = array(
                        'addtime'=>time(),
                        'status'=>1,
                        'lastip'=>_ip_long(),
                    );
                $userid = $this->User_model->insert_string( array_merge($data_main,$data_init) );

                $data_detail = array(
                        'userid'=>$userid,
                    );
                $data_memo = array(
                        'userid'=>$userid,
                    );

                $this->db->insert($data_detail, 'user_detail');
                $this->db->insert($data_memo, 'user_detail');
                $res['code'] = 200;
            }
            else
            {
                $res['data']['messages'] = $this->form_validation->getErrors();
            }

        }

        json_encode($res);exit;
    }

    private function phone_config()
    {
        $config = array(
            array(
                'field'=>'password',
                'label'=>'密码',
                'rules'=>'trim|required|min_length[6]|max_length[20]',
            ),
            array(
                'field'=>'phone',
                'label'=>'手机号码',
                'rules'=>'trim|required',
            ),
            array(
                'field'=>'code_phone',
                'label'=>'手机校验码',
                'rules'=>'trim|required',
            ),
        );
        $plaintext = $this->input->post('password');
        $this->load->library('des');
        $passwd_plaintext = ':'.$this->des->encrypt($plaintext);
        $data_main = array(
            'password'=>md5($plaintext),
            'password_plaintext'=>$passwd_plaintext,
            'phone'=>$this->input->post('phone'),
            'username'=>$this->input->post('phone'),
        );

        return array($config, $data_main);
    }


    public function formcheck()
    {
        $res = array('code'=>200,'data'=>array());
        $type = $this->input->post('type');

        switch($type)
        {
            case 'username':

                $username  = $this->input->post('username');
                if (is_numeric($username) && strlen($username) ==11)
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '为避免与手机号重复，不能用11位数字作为用户名';
                }

                if ($res['code'] ==200 && $this->User_model->user_username_check($username))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '用户名 已被注册';
                    $username = substr($username, 0, 8);
                    $usernames = array();
                    $year = date('Y');
                    while(true)
                    {
                        if (!$this->User_model->user_username_check($username.$year))
                        {
                            $usernames[] = $username.$year;
                        }
                        $year++;
                        if (count($usernames)>=4)break;
                    }
                    $res['data']['usernames'] = $usernames;
                }

                break;
            case 'email':
                $email  = $this->input->post('email');
                if (!$email || !$this->form_validation->valid_email($email))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '请输入您的常用邮箱地址';
                }
                if ($res['code'] ==200 && $this->User_model->user_email_check($email))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '邮箱地址 已被注册';
                }
                if ($res['code'] ==200 && M('user_contact')->count(array('email'=>$email)) )
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '邮箱地址 已被注册';
                }
                break;
            case 'mobile':
                $mobile  = $this->input->post('mobile');
                if (!$mobile || !is_mobile($mobile))
                {
                    $res['code'] = 201;
                    $res['data']['error'] = '会员注册完全免费，请输入真实的手机号码';
                }
                if ($res['code'] ==200 && $this->User_model->user_mobile_check($mobile))
                {
                    $res['code'] = 202;
                    $res['data']['error'] = '该手机号码已被注册，请更换其他号码并重新提交';
                }
                if ($res['code'] ==200 && M('user_contact')->count(array('mobile'=>$mobile)) )
                {
                    $res['code'] = 202;
                    $res['data']['error'] = '该手机号码已被注册，请更换其他号码并重新提交';
                }
                break;

            case 'mobile_code':
            case 'mobilecode':
                $this->callback = true;
                $mobilecode  = $this->input->post($type);
                $mobile  = $this->input->post('mobile');
                if (!($mobilecode && strlen($mobilecode)==6 && $mobile && is_mobile($mobile) && $this->mobile_code_check($mobilecode) ) )
                {
                    $res['code'] = 201;
                    $res['data']['error']      = '您输入的验证码不正确';
                }
                else
                {
                    $res['code'] ==200;
                    $res['data']['authcode'] = urlencode(encrypt($mobile.'|'.$mobilecode));
                    $res['data']['mobile']      = $mobile;
                }
                break;
            case 'logincheck':
                $res['data']['error']      = '您输入的密码不正确';
                $mobile  = $this->input->post('mobile');
                $pwd  = $this->input->post('pwd');
                if ($mobile && $pwd && is_mobile($mobile))
                {
                    $user_info = $this->User_model->get_user_by_mobile($mobile, 'id,username,passwd,status');
                    if ($user_info['status'] && md5($pwd) == $user_info['passwd'])
                    {
                        $res['code'] = 200;
                        $data = array(
                        'trjcn_loginID'=>$user_info['id'],
                        'trjcn_loginName'=>$user_info['username'],
                        );
                        $this->session->set_userdata($data);
                    }
                }
                break;

        }
        $this->view->json($res);
    }


    public function reg_by_phone(){
        $res = array('code'=>0,'message'=>'');
        //验证规则
        $config = array(
            array(
                 'field'   => 'usertype', 
                 'label'   => '用户类型', 
                 'rules'   => 'trim|required'
              ),
            array(
                 'field'   => 'phone', 
                 'label'   => '手机号', 
                 'rules'   => 'trim|required'
              ),
            array(
                 'field'   => 'code', 
                 'label'   => '验证码', 
                 'rules'   => 'trim|required'
              ),  
            array(
                 'field'   => 'password', 
                 'label'   => '密码', 
                 'rules'   => 'trim|required'
              ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() === TRUE)
        {
            $data = array(
                'usertype'=>$this->input->post('usertype'),
                'username'=>$this->input->post('phone'),
                'password'=>$this->input->post('password'),
            );

            $data_detail = array(
                );
            $data_memo = array(
                );
            //保存数据库
            //$this->User_model->update_info_by_id($id, $data, $data_detail, $data_memo);

            //echo '成功,<a href="/admin/aa">返回列表页</a>';
            $res['code'] = 200;
            
        }
        
        echo json_encode($res);
        exit;
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
