<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['md5_prefix']                       = 'myxt';


$config['cfg_path'] = array(
	'css'=>'/assets/src/css/',
	'js'=>'/assets/src/js/',
	'images'=>'/assets/src/images/',
	'lib'=>'/assets/src/lib/',

	'admin_css'=>'/assets/admin/css/',
	'admin_js'=>'/assets/admin/js/',
	'admin_images'=>'/assets/admin/image/',
);

$config['usertype'] = array(
	1 => '经纪公司',
	2 => '模特',
	3 => '企业',
);

$config['workitem'] = array(
	1 => '服装拍摄',
	2 => '平面广告',
	3 => '时尚杂志',
	4 => '内衣泳装',
	5 => '娱乐节目',
	6 => '视频广告',
	7 => '其他拍摄',
	8 => '其他活动',
);

$config['workscene'] = array(
	1 => '外景',
	2 => '棚景',
);

$config['worktime'] = array(
	1 => '天',
	2 => '时',
	3 => '场',
	4 => '件',
);

$config['workprice'] = 150;