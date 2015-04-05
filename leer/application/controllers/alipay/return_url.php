<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */
echo '1';exit;
require_once(APPPATH."controllers/alipay/alipay.config.php");
require_once(APPPATH."controllers/alipay/lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//http://127.0.0.1:9999/alipay/payment/return_url.php?
//buyer_email=18667045184&
//buyer_id=2088502628798870&
//discount=0.00&
//gmt_create=2015-03-17+11%3A42%3A42&
//gmt_logistics_modify=2015-03-17+11%3A42%3A42&
//gmt_payment=2015-03-17+11%3A42%3A57&is_success=T&
//is_total_fee_adjust=N&logistics_fee=0.00&
//logistics_payment=SELLER_PAY&
//logistics_type=EXPRESS&
//notify_id=RqPnCoPT3K9%252Fvwbh3InTvPTOr%252Be7cAu%252BPJvptFrLSnWryiv2g9kMyv948BqRDoQi2UgF&notify_time=2015-03-17+11%3A43%3A00&notify_type=trade_status_sync&out_trade_no=1426563675818072&payment_type=1&price=0.01&quantity=1&receive_address=%E5%8C%97%E4%BA%AC%E7%9C%81%E5%B8%82%E8%BE%96%E5%8C%BA%E8%A5%BF%E5%9F%8E%E5%8C%BA212121&receive_mobile=13000000000&receive_name=qweee111&receive_zip=222222&seller_actions=SEND_GOODS&seller_email=yangjun%40c2mmall.com&seller_id=2088811561869234&subject=%E5%95%86%E5%9F%8E%E4%BA%A7%E5%93%81&total_fee=0.01&trade_no=2015031700001000870046647351&trade_status=WAIT_SELLER_SEND_GOODS&use_coupon=N&sign=8e9eed5dcbd57d785753eb16c2652f7f&sign_type=MD5

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号
	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];


    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序

        /*支付成功 更新订单状态*/
        $orderId                = $out_trade_no;

        $sql                    = "SELECT * FROM `dis_order` where order_id = '".$orderId."'";

        $result=mysql_db_query($database, $sql, $con);

        $row=mysql_fetch_row($result);
        //if($row)
        print_r($row);exit;
    }
	else if($_GET['trade_status'] == 'TRADE_FINISHED') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
		
	echo "验证成功<br />";
	echo "trade_no=".$trade_no;

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝标准双接口</title>
	</head>
    <body>
    </body>
</html>