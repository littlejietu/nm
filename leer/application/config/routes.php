<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "indexaction";
$route['admin.html'] = "indexaction";
$route['login.html'] = "useraction/login";
$route['404_override'] = '';

$route['register'] = "user/register/index";


