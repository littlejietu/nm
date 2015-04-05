<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*自定义配置*/
$config['myconfig']['md5_prefix']                       = 'smallBird';//加密密码
$config['myconfig']['order_out_of_date']                = 3600;//订单过期时间（秒）
$config['myconfig']['goods_out_of_date']                = 3600*24*365*2;//商品过期时间（秒）

//发送邮件配置
$config['myconfig']['email']                            = array(
    'user_name'     => 'yangchu0407@163.com',
    'user_password' => '*19860211**',
    'email_name'    => 'C2M工厂',
);

//根据邮件找回密码--模板
$config['myconfig']['email_model']                            = array(
    'title'     => 'C2M密码找回',
    'content' => '您的密码已重设成功！新密码为：',
);
//$config['myconfig']['email']                            = array(
//    'user_name'     => '87540852@qq.com',
//    'user_password' => '*19860211**',
//    'email_name'    => 'C2M工厂',
//);

//订单状态
$config['myconfig']['order_type']                       = array(
    '0' => '未付款',
    '1' => '已支付未配送',
    '2' => '已配送',
    '3' => '已确认收货',
    '4' => '换货中',
    '5' => '退货中',
    '6' => '退货完成',
    '7' => '重新配送',
    '8' => '换货完成',
    '9' => '取消订单',
    '10' => '订单差异金额未支付',
    '11' => '未付款',
);

//退货换货理由
$config['myconfig']['change_goods']                       = array(
    '1' => '质量问题',
    '2' => '无理由退换货',
    '3' => '不想买了',
    '4' => '买错了',
    '5' => '重复买了',
);

//充值链接
$config['myconfig']['pay_link']                         = 'http://item.taobao.com/item.htm?spm=0.0.0.0.5o2g5R&id=43347088371';

//淘宝API配置
$config['myconfig']['tb_api']                           = array(
    'appkey'        => '23072006',
    'secretkey'     => '4c2ef2ef893a01f6a929155f25bf6f93',
);

//颜色配置
$config['myconfig']['color']                           = array(
    '000'           => '黑色',
    'fff'           => '白色',
);