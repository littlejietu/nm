<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['md5_prefix']                       = 'myxt';
$config['bail']	= array(
	1=>1000,
	2=>100,
	3=>300,
	);
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
	1 => '模特',
	2 => '经纪公司',
	3 => '企业',
);
$config['userlevel'] = array(
	0 => '普通',
	1 => '平台专属',
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
$config['orderkind'] = array(
	'book'=>1,
	'cert'=>2,
);
$config['activity'] = array(
	1 => '模特面试',
	2 => '模特工作',
	3 => '模特比赛',
);
$config['activity_en'] = array(
	1 => 'interview',
	2 => 'work',
	3 => 'game',
);
$config['get_paystatus'] = array(
	1=>'waitpay',
	2=>'payed',
	3=>'finish',
);
$config['paystatus'] = array(
	'waitpay'=>'待付款',
	'payed'=>'已付款',
	'finish'=>'成功',
);
$config['visittype'] = array(
	'home'=>1,
);
$config['modelarea'] = array(
	1=>'亚洲模特',
	2=>'欧美模特',
);
$config['modelstyle'] = array(
	1=>'韩系名媛',
	2=>'气场欧美',
	3=>'优雅复古',
	4=>'清新文艺',
	5=>'英伦学院',
	6=>'甜美日系',
	7=>'OL通勤',
	8=>'接头混搭',
	9=>'性感诱惑',
);