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
        $data = array(
            'usertype'=> $this->config->item('usertype'),
        );
        $this->load->view('user/register', $data);
    }

    public function save(){
        $res = array('code'=>0,'data'=>array());


        if ($this->input->is_post())
        {
            $version = $this->input->post('version');
            switch($version)
            {
                case 'email'://邮箱
                    list($config, $config_data) = $this->email_config();
                    break;
                default://默认手机注册
                    list($config, $data_main) = $this->phone_config();
                    break;
            }


            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() === TRUE)
            {
                $ip = _ip_long();
                $data = array(
                    'addtime'=>time(),
                    'lastip'=>$ip,
                    'status'=>1,
                );

                $data = array_merge($data, $data_main);

                $this->User_model->insert($data);

                if (isset($data_detail) && $data_detail && is_array($data_detail) )
                {
                }
                if (isset($data_memo) && $data_memo && is_array($data_memo) )
                {
                }

                $res['code'] = 200;
            }
            else
                $res['data']['error_messages'] = $this->form_validation->getErrors();
        }

        echo json_encode($res);
        exit;
    }

    private function phone_config()
    {
        //验证规则
        $config = array(
            array(
                 'field'   => 'usertype', 
                 'label'   => '用户类型', 
                 'rules'   => 'trim|required'
            ),
            array(
                 'field'   => 'phone', 
                 'label'   => '手机', 
                 'rules'   => 'trim|required'
            ),
            array(
                 'field'   => 'code_phone', 
                 'label'   => '验证码', 
                 'rules'   => 'trim|required'
            ),  
            array(
                 'field'   => 'password_phone', 
                 'label'   => '密码', 
                 'rules'   => 'trim|required'
            ),  
        );
        $password = $this->input->post('password');
        $this->load->library('des');
        $passwd_plaintext = ':'.$this->des->encrypt($password);
        $data_main = array(
            'usertype'=>(int)$this->input->post('usertype'),
            'username'=>$this->input->post('phone'),
            'password'=>md5($password),
            'passwd_plaintext'=>$passwd_plaintext,
            'phone'=>$this->input->post('phone'),
        );

        return array($config, $data_main);
    }
    
    private function email_config()
    {
    }


    public function formcheck()
    {
        $res = array('code'=>200,'data'=>array());
        $type = $this->input->post('type');
        $ajax_remote = $this->input->post('remote');

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
                if ($res['code'] ==200 && $this->User_model->user_mobile_check($mobile) && $this->User_model->user_username_check($mobile))
                {
                    $res['code'] = 202;
                    $res['data']['error'] = '该手机号码已被注册，请更换其他号码并重新提交';
                }
                // if ($res['code'] ==200 && M('user_contact')->count(array('mobile'=>$mobile)) )
                // {
                //     $res['code'] = 202;
                //     $res['data']['error'] = '该手机号码已被注册，请更换其他号码并重新提交';
                // }
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

        if($ajax_remote==1)
        {
            if($res['code']==200)
                echo 'true';
            else
                echo 'false';

        }
        else
            //echo json_encode($res);
            print_r($res);

        
        exit;
    }





    public function mobilecode()
    {
        if ($this->input->is_ajax_request())
        {
            $res = array();
            $res['code'] = 0;
            $res['data'] = array();
            $url =  $_SERVER['HTTP_REFERER'];
            if (strpos($url, '/order/query')!==false)
            {
                $error = '您提交的手机号码已是注册用户，请登录账号查询订单！';
            }else
            {
                $error = '该手机号码已被注册，请更换其他号码并重新提交';
            }

            $uid     = (int)get_key_val($this->input->post('uid'), TRUE);
            $mobile = $this->input->post('mobile');
            if ($uid)
            {
                $res['code'] = 199;
            }
            elseif (!is_mobile($mobile))
            {
                $res['code'] = 201;
                $res['data']['error'] = '请填写真实的手机号码';
            }
            elseif ($this->User_model->user_mobile_check($mobile))
            {
                $res['code'] = 202;
                $res['data']['error'] = $error;
            }elseif (M('user_contact')->count(array('mobile'=>$mobile)) ){
                $res['code'] = 202;
                $res['data']['error'] = $error;
            }else{
                $today = strtotime('today');
                $db = $this->User_model->db;
                $ip = ip_long();

                $result = $db->select('COUNT(1) as num')
                             ->from('mobile_blacklist')
                             ->where('mobile', $mobile)
                             ->get()
                             ->row_array();
                if ($result && $result['num']>0)
                {
                    $res['code'] = 204;
                    $res['data']['error'] = '您输入的手机号码存在异常操作，如有疑问请联系400-858-9000';
                    $this->view->json($res);
                }
                
                //同一个IP 3次,
                $result = $db->select('COUNT(distinct mobile) AS num')
                                ->from('sms_code')
                                ->where('ip', $ip)
                                ->where('created >=', $today)
                                ->where('type', 'register')
                                ->get()
                                ->row_array();

                if ($result && $result['num'] >= 2)
                {
                    $res['code'] = 204;
                    $res['data']['error'] = '您更换手机号超过系统限制无法继续注册，请联系400-858-9000';
                }
                
                
                $result = $db->select('COUNT(1) AS sendnum')
                                ->from('sms_code')
                                ->where('mobile', $mobile)
                                ->where('created >=', $today)
                                ->where('type', 'register')
                                ->get()
                                ->row_array();
                                
                $sendnum = isset($result['sendnum']) ? $result['sendnum']:0;

                if ($res['code'] == 0)
                {
                    //同一个号码同一个IP 5次,
                    $result = $db->select('COUNT(*) AS num')
                                    ->from('sms_code')
                                    ->where('mobile', $mobile)
                                    // ->where('ip', $ip)
                                    ->where('created >=', $today)
                                    ->where('type', 'register')
                                    ->get()
                                    ->row_array();
                    if ($result && $result['num'] >= 2)
                    {
                        $res['code'] = 204;
                        $res['data']['error'] = '您今天手机验证功能已使用超过系统限制无法继续使用，请联系400-858-9000';
                    }
                }

                $code = '';
                if ($res['code'] == 0)
                {
                    $result = $db->select('id,code,created')
                                    ->from('sms_code')
                                    ->where('mobile', $mobile)
                                    ->where('type', 'register')
                                    ->order_by('id DESC')
                                    ->limit(1)
                                    ->get()
                                    ->row_array();

                    if ($result)
                    {
                        $left_time = $this->timestamp-$result['created'];
                        if ($left_time < 60)
                        {
                            $res['data']['time'] = 60-$left_time;
                            $res['data']['last'] = date('Y-m-d H:i:s', $result['created']);
                            $res['data']['now']  = date('Y-m-d H:i:s', $this->timestamp);
                            $res['code'] = 203;
                        }
                        if ($left_time < 30*60)
                        {
                            $code = $result['code'];
                        }
                    }
                }

                if ($res['code'] == 0)
                {
                    $code   = $code ? $code : rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
                    $smsway = $this->config->item('smsway');                    
                    $count  = count($smsway);
                    $n = 0;
                    for($i=0;$i<=$sendnum;$i++)
                    {
                        if($n >= $count)
                        {
                            $n = 0;
                        }
                        $way = $smsway[$n];
                        $n++;
                    }
                    
                    $data = array(
                        'type'=>'register',
                        'mobile'=>$mobile,
                        'code'=>$code,
                        'created' => $this->timestamp,
                        'ip'=>$ip,
                        'way'=>$way,
                    );
                    if(isset($_POST['from']))
                    {
                        switch($_POST['from'])
                        {
                            case 'zjxmdetail':
                                $data['from_web'] = 1;
                                break;
                        }
                    }
                    $db->insert('sms_code', $data);
                    if ($this->input->post('method') == 'publishquick')
                    {
                        $sms = '您的投融界注册验证码是:'.$data['code'].'，该验证码在半小时内均有效，验证成功后您可使用该验证码作为登录密码。如非本人操作，请勿理会！';
                    }
                    else
                    {
                        $sms = '您的投融界注册验证码是:'.$data['code'].'。该验证码在半小时内均有效。如非本人操作，请勿理会！';
                    }
                    $this->load->helper('sms');
                    if (do_send_sms($mobile, $sms, $way))
                    {
                        $res['code'] = 200;
                    }
                    else
                    {
                        $res['code'] = 206;
                        $res['data']['error'] = '手机校验码发失败，请重试或联系客服';
                    }
                }
            }
            $this->view->json($res);
        }
    }

/*
    public function username_check($val)
    {
        if (!$this->callback)exit;
        //验证
        if (is_numeric($val) && strlen($val) ==11)
        {
            $this->form_validation->set_message('user_username_check', '为避免与手机号重复，不能用11位数字作为%s');
            return false;
        }
        if ($this->User_model->user_username_check($val))
        {
            $this->form_validation->set_message('user_username_check', ' %s 已被注册');
            return false;
        }
        return true;
    }


    public function mobile_code_check($code)
    {
        if (!$this->callback)exit;
        $db = $this->User_model->db;
        $result = $db->select('id,code')
                    ->from('sms_code')
                    ->where('type', 'register')
                    ->where('mobile', $this->input->post('mobile'))
                    ->order_by('id DESC')
                    ->limit(1)
                    ->get()
                    ->row_array();
        if ($result && $result['code'] == $code)
        {
            return TRUE;
        }
        $this->form_validation->set_message('mobile_code_check', ' %s 不正确');
        return FALSE;

    }
    
    */
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
