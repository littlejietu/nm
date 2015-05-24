<?php
/*公用函数库*/


function _get_userlogo_url($userlogo){

    return $userlogo? '/'.$userlogo : _get_cfg_path('images').'imghead.jpg';

}

function _get_login_agent_user(){
	$CI =& get_instance();

	$agentUser = $CI->cache->get('agentUser');
	if(!empty($agentUser))
		return $agentUser;
	else
		return $CI->loginUser;
}


?>