<?php
/* *
 * 配置文件
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
	
 * 提示：如何获取安全校验码和合作身份者id
 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
	
 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */

//链接数据库
$con = mysql_connect("rdsaaa3ayjmr7jr.mysql.rds.aliyuncs.com:3306","leer","dsf2dvvqwfh12");
//$con = mysql_connect("192.168.111.8","root","");
$database = 'leer';
mysql_query("set names 'utf8'");//编码转化
$db_selecct=mysql_select_db($database);//选择数据库

/*取得后台配置的支付宝信息*/
$sql                    = "SELECT * FROM `dis_pay` where pay_id = 1";
$result=mysql_query( $sql, $con);
$row=mysql_fetch_array($result);

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者id，以2088开头的16位纯数字
$alipay_config['partner']		= $row['pay_partner'];
//$alipay_config['partner']		= '2088811561869234';

//安全检验码，以数字和字母组成的32位字符
$alipay_config['key']			= $row['pay_key'];
//$alipay_config['key']			= '3zbx0yl64mpm5ahu0aa8f9fz0ox8j65u';

//用户支付宝名
$alipay_config['pay_amount']    = $row['pay_amount'];


//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert']    = getcwd().'\\cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';


?>