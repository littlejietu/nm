<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_json') ){
	function _get_json($data)
	{
		$callback = isset($_GET['callback']) ? $_GET['callback'] : '';
		$data = json_encode($data);
		if ($callback && preg_match('~^(jQuery)[\d\_]+$~', $callback))
		{
			echo $callback.'('.$data.')';
		}
		else
		{
			echo $data;
		}
		exit;
	}
}

if ( ! function_exists('ip_long') ){
	function _ip_long($ip='')
	{
		$CI =& get_instance();
		return sprintf('%u', ip2long( $ip ? $ip : $CI->input->ip_address() ));
	}
}


function _get_db($group='xt')
{
	static $db=array();
	if (!isset($db[$group])){
		$CI =& get_instance();
		$db[$group] = $CI->load->database($group, TRUE);
		$db_name = 'xt_'.$group;
		$CI->$db_name = $db[$group];
	}
	return $db[$group];
}

/**
 * 返回加密串
 * @param $val
 * @param $flag
 * @return unknown_type
 */
function _get_key_val($val, $flag=FALSE)
{
	if (!$val)return '';
	if ($flag)
	{
		$md5 = substr($val, -32);
		$str = substr($val,0,-32);
		if ($md5 == md5(session_id().'!#%&)'.$str))
		{
			return $str;
		}
		else
		{
			return '';
		}

	}
	else
	{
		return $val.md5(session_id().'!#%&)'.$val);
	}
}

function _get_param($val, $is_id=FALSE)
{
	if($is_id)
	{
		if(!empty($val))
			return _get_key_val($val);
		else
			return 0;
	}
	else
	{
		if(!empty($val))
			return $val;
		else
			return '';
	}
}

//缓存--begin
if(!function_exists('cache_read')){
    function _cache_read($file, $dir = '', $mode = '') {
        $file = _get_cache_file($file, $dir);
        if(!is_file($file)) return NULL;
        return $mode ? read_file($file) : include $file;
    }
}
  
if(!function_exists('cache_write')){
    function _cache_write($file, $string, $dir = '') {
        if(is_array($string)) {
            $string = "<?php return ".var_export($string, true)."; ?>";
            $string =  str_replace(array(chr(13), chr(10), "\n", "\r", "\t", '  '),array('', '', '', '', '', ''), $string);
        }
        $file = _get_cache_file($file, $dir);
        return write_file($file, $string);
    }
}
  
  
if(!function_exists('cache_delete')){
    function _cache_delete($file, $dir = '') {
        $file = _get_cache_file($file, $dir);
        return unlink($file);
    }
}
  
  
if(!function_exists('_get_cache_file')){
    function _get_cache_file($file, $dir) {
        $path = config_item('cache_path') ? config_item('cache_path') : APPPATH . 'cache/';
        return ($dir ? $path.$dir.'/'.$file : $path.$file);
    }
}
//缓存--end


?>