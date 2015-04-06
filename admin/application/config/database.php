<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

//$db['default']['hostname'] = 'localhost';
//$db['default']['username'] = 'yc';
//$db['default']['password'] = '6Dv7AjaNLXLeCmMM';
//$db['default']['database'] = 'yc';

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'leer';

//$db['default']['hostname'] = 'rdsaaa3ayjmr7jr.mysql.rds.aliyuncs.com:3306';
//$db['default']['username'] = 'leer';
//$db['default']['password'] = 'dsf2dvvqwfh12';
//$db['default']['database'] = 'leer';

$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = 'dis_';
$db['default']['pconnect'] = false;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//设置时区
date_default_timezone_set("PRC");


/* End of file database.php */
/* Location: ./application/config/database.php */