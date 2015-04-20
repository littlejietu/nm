<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php")?>
<link href="css/base.css" type="text/css" rel="stylesheet"/>
<link href="css/common.css" type="text/css" rel="stylesheet"/>
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include("include/header.php")?>
<div class="mainbody" id="mainbody">
	<div class="container">
        <div class="pay_title">提交订单</div>
        <div id="subOrder">
            <div class="subOrder">
                <div class="subOrder1">
                    <h1>订单提交成功！还差一步，请继续完成在线支付！</h1>
                    <p>订单号：<span>90421134641171</span> </p>
                    <p>订单查询：您可通过“<a href="##">会员中心</a>”>>“<a href="##">我的订单</a>”查询您的订单状态。</p>
                </div>
                <div class="subOrder2"><input name="radio" type="radio" value="" class="radio" /><img src="images/pay_1.jpg" /><p>支付￥<span>986</span></p></div>
                <div class="subOrder2"><input name="radio" type="radio" value="" class="radio"/><img src="images/pay_2.jpg" /><i>（推荐）</i><p>支付￥<span>986</span></p></div>
                <div class="subOrder3"><input type="button" class="but zf-btn" value="确认支付"/></div>
            </div>
        </div>
    </div>
</div>
<?php include("include/footer.php")?>
</body>
<script type="text/javascript" src="js/jquery-1.42.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script>
/* 付款提交 */
$('.subOrder2').live('click',function() {
	//$('input:radio').eq[0].removeAttr("checked");
	$('.subOrder2').css('background','url(images/brand.jpg) no-repeat');
	$('.subOrder2 p').hide();
	$('input:radio').val('');
	$('input:radio',this).val('text');
	$.each($("input[name='radio']"),function(){
		if($(this).val() =="text")
		{
			$(this).attr("checked","checked");
		}
	});
	   
	$(this).css('background','url(images/branda.jpg) no-repeat');
	$('p',this).show();
});
//var domHeight=document.body.clientHeight;
//var winHeight=$(window).height();
//if(winHeight>domHeight){
//	var pad=(winHeight-domHeight)/2;
//	$('#subOrder').css({'margin-top':pad+50+'px','margin-bottom':pad+50+'px'});
//}
//else
//{
//	$('#subOrder').css({'margin-top':'50px','margin-bottom':'50px'});
//}
</script>
</html>