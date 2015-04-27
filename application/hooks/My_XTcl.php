<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 权限验证
 * @author XT
 * @version $Id: My_XTcl.php 3618 2015-4-27 11:33:38Z xt_pss $
 */
class My_XTcl{
	
	function xtcl()
	{
		$CI =& get_instance();
		
		$is_manage = FALSE;
		//个人中心验证是否登录
		// if (XT_WWW=='user' || $CI->uri->uri_string && preg_match('~^m\/*~',$CI->uri->uri_string))
		// {
			$is_manage = true;
		// }

		$xt_loginID = 0;
		$xt_loginUser =$CI->input->cookie('loginUser');
		$xt_loginCode =$CI->input->cookie('loginCode');
		
		if ($xt_loginUser && $xt_loginCode)
		{
			$CI->load->library('encrypt');
			$strmd5 = substr($xt_loginUser, 0, 32);
			$str = substr($xt_loginUser,32);
			
			if (md5($CI->config->item('encryption_key').$str) == $strmd5)
			{
				$xt_loginID = (int)$CI->encrypt->decode($str);
			}
		}

		$base_url = $CI->config->item('base_url');
		$user_url = $CI->config->item('user_url');
		$CI->timestamp = time();
		$CI->todaytime = strtotime('today');
		//$CI->site_id = 0;
		$CI->loginUser = array();
		$loginUserID = '';
		$CI->loginID = 0;

		if ($xt_loginID)
		{
			$CI->loginUser['auth'] = array();
			
			$fields = 'id,usertype,userlevel,username,nickname,email,validemail,validmobile,status,lastlogintime';
			$CI->loginUser = XTM('User')->fetch_row(array('id'=>$xt_loginID), $fields);


			if($CI->loginUser && $CI->loginUser['status'])
			{
				$CI->loginUser['id']= (int)$CI->loginUser['id'];
				$CI->loginID         = $CI->loginUser['id'];
				$CI->loginUserName      = $CI->loginUser['username'];
				$CI->loginNickName      = empty($CI->loginUser['nickname']) ? $CI->loginUser['username'] : $CI->loginUser['nickname'];
				$CI->loginRealNickName = $CI->loginUser['nickname'];
				$CI->loginLevel     = $CI->loginUser['userlevel'];
				$CI->businesscardUnlimited = 0;

				$loginUserID = _get_key_val($CI->loginUser['id']);
				$CI->loginUser['id_key'] = $loginUserID;
				if ($is_manage)
				{

					//未读短信
					// $where = array(
					// 	'homepage_id'=>$CI->loginID,
					// 	'inbox_del'=>0,
					// );                    
					// $CI->loginUser['feedback_num'] = M('Item_feedback')->count($where);
				}
				
				//VIP会员标识
				//$CI->loginUser['ident_name'] = $CI->loginUser['is_vip_ident'] ? 'VIP会员' : '普通会员';
				// $CI->loginUser['user_logo'] = get_face_url($CI->loginUser['user_logo'], $CI->loginUser['contact_sex']);
				// $CI->loginUser['company_url'] = site_url('company_'.$CI->loginUser['id']);
				// init_user_auth($CI->loginUser);
				// if ($CI->UserInfo['auth']['auth_homepage_vip'])
				// {
					
				// 	$domain = M('user_domain')->get_info_by_uid($CI->loginUser['id'], 'domain,status');
				// 	if ($domain['status'])
				// 	{
				// 		$CI->loginUser['company_url'] = 'http://'.$domain['domain'].TRJ_DOMAIN;
				// 	}
				// }
			}else
			{
				unset($CI->loginUser);
				$data = array('xt_loginID'=>0);
				$CI->session->set_userdata($data);
				$CI->input->set_cookie('loginUser', '',-1, XT_DOMAIN);
				$CI->input->set_cookie('loginCode', '',-1, XT_DOMAIN);
				$CI->input->set_cookie('is_next_initial', 0, -1, XT_DOMAIN);
				setcookie('PHPSESSID', '', -1, '/', XT_DOMAIN);
			}
			/*
			$is_next_initial = (int)$CI->input->cookie('is_next_initial');
			//未初始化和未定制
			if (!isset($_POST['ver_id']))
			if ($is_next_initial==0 && $is_manage && $CI->router->fetch_class() !='initial' && ($CI->loginUser['initial']<2))
			{
				header('location:'.$base_url.'m/initial');
				exit;
			}
			
			if (!isset($_POST['ver_id']))
			if ($CI->router->fetch_class() !='initial' && $is_manage && $CI->loginUser['initial']<2)
			{
				header('location:'.$base_url.'m/initial/next');
				exit;
			}
			*/

		}
		
		if (isset($CI->check_login) && !$CI->loginUser['id'])
		{
			if ($CI->input->is_ajax_request())
			{
				$res = array(
					'code'=>500,
					'data'=>array('error_message'=>'您的登录已失效，请重新登录！','loginUrl'=>'user/login?forword_url='.urlencode($_SERVER['HTTP_REFERER'])),
				);
				echo json_encode($res);
			}
			else
			{
				
				$SCRIPT_URL =  '/'.$CI->uri->uri_string.'';
				header('location:'.$base_url.'user/login?forword_url='.urlencode($SCRIPT_URL));
				
			}
			exit;
		}
		

		//个人中心验证是否登录
		if ($is_manage && !$CI->loginUser['id'])
		{
			if ($CI->input->get('facebox')=='facebox')
			{
				echo '<script>location.href="'.$base_url.'user/login?forword_url='.urlencode($_SERVER['HTTP_REFERER']).'"</script>';
				exit;
			}
			elseif ($CI->input->is_ajax_request())
			{
				$res = array(
					'code'=>500,
					'data'=>array('error_message'=>'您的登录已失效，请重新登录！','loginUrl'=>'user/login?forword_url='.urlencode($_SERVER['HTTP_REFERER'])),
				);
				echo json_encode($res);
				exit;
			}else
			{
				$QUERY_STRING =  $_SERVER['QUERY_STRING'];
				$SCRIPT_URL =  '/'.$CI->uri->uri_string;
				$url  = $base_url.'user/login?forword_url='.urlencode($SCRIPT_URL.($QUERY_STRING ? '?' : '').$QUERY_STRING);
				header('location:'. $url );
				exit;
			}

	
		}
		if($CI->loginUser['id'])
		{
			//获取 会员未读消息数统计
			// $CI->load->service('users/user_statistics_service');
			// $CI->statistics=$CI->user_statistics_service->get($CI->loginUser['id']);
		}
		
		
		$CI->base_url    =    $base_url;
		//$CI->site_id = 0;
		$class 	= $CI->router->fetch_class();
		$method = $CI->router->fetch_method();
		$directory = trim($CI->router->fetch_directory(), '/');
		$CI->d_m_c = ($directory ? $directory.'/' : '').$class.'/'.$method;
		
	}
	
}


/* End of file My_XTcl.php */
/* Location: ./application/hooks/My_XTcl.php */
