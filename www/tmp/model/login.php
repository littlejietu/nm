<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php")?>
<link href="css/base.css" type="text/css" rel="stylesheet" />
<link href="css/common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body class="resize">
<div class="header">
    <div class="container clearfix">
       <div class="fl logo"><a href="index.php" title="返回首页"><img alt="牛模网logo" src="images/logo.png" height="30"/></a></div>
       <div class="fr nav">
          <ul class="clearfix">
             <li>
                <a class="<?php if($url == "models.php") echo "nav_on"?>" href="models.php">
                    <p>
                        <span class="navimg"><img alt="模特" src="images/nav_1.jpg" height="16"/></span>
                        <span class="navzi">模特</span>
                    </p>
                </a>
             </li>
             <li>
                 <a class="<?php if($url == "institutions.php") echo "nav_on"?>" href="institutions.php">
                    <p>
                         <span class="navimg"><img alt="机构" src="images/nav_2.jpg" height="16"/></span>
                         <span class="navzi">机构</span>
                     </p>
                 </a>
             </li>
             <li>
                 <a class="<?php if($url == "notlce.php") echo "nav_on"?>" href="notlce.php">
                    <p>
                        <span class="navimg"><img alt="通告" src="images/nav_3.jpg" height="16"/></span>
                        <span class="navzi">通告</span>
                    </p>
                 </a>
             </li>
             <li>
                <a class="<?php if($url == "news.php") echo "nav_on"?>" href="news.php">
                    <p>
                        <span class="navimg"><img alt="新闻" src="images/nav_4.jpg" height="16"/></span>
                        <span class="navzi">新闻</span>
                    </p>
                </a>
             </li>
             <li class="nav_search">
                <a href="##" title="搜索"><img alt="搜索" src="images/nsos.jpg" height="20"/></a>
             </li>
          </ul>
       </div>
    </div>
    <div class="header_bg"></div>
</div>
<div id="slideBox" class="ibanner">
	<div class="iban">
		<h3>登录账号</h3>
		<div class="fl iban_form">
			<form>
				<ul>
					<li>
						<img src="images/iban_formimg1.jpg" />
						<input id="name" name="name" type="text" placeholder="用户名"/>
                        <img src="images/iban_formtt.jpg" />
					</li>
					<li>
						<img src="images/iban_formimg2.jpg" />
						<input id="password" name="password" type="password" placeholder="密码"/>
                        <img src="images/iban_formtt.jpg" /></li>
					<li>
						<img src="images/iban_formimg3.jpg" />
						<input class="iban_foin" name="" type="text" placeholder="验证码"/>
                        <img class="mrgR10" src="images/iban_formtt.jpg" />
						<img src="images/yzm.jpg" /></li>
					<li>
						<input checked="checked" type="checkbox"  name="rem" id="rem" value="rem" />
						<label for="rem">记住帐号</label>
                        <p class="fr f_prompt" id="prompt">请输入正确的密码</p>
					</li>
					<li class="iban_forin">
						<input class="but" name="" value="登   录" type="submit" onclick="return formC();"/>
					</li>
					<li>
                        <p class="logmm fl">忘记密码？<a href="##">点击这里</a></p>
						<a class="iban_forma fr" href="register.php" title="免费注册">免费注册</a>
					</li>
				</ul>
			</form>
		</div>
		<div class="iban_bot"><span>社交账号直接登录</span>
			<a class="iban_bota" href="#">微博</a><a class="iban_qq" href="#">QQ</a>
		</div>
	</div>
	<div class="hd">
		<ul></ul>
        <a class="prev" title="上一页">上一页</a>
    	<a class="next" title="下一页">下一页</a>
	</div>
	<div class="bd">
		<ul>
			<li _src="url(img/banner2.jpg)"><a href="##"></a></li>
            <li _src="url(img/banner3.jpg)"><a href="##"></a></li>
		</ul>
	</div>
</div>
<div class="ifooter">
    <div class="container clearfix">
        <a class="fl" href="index.php"><img src="images/logo.png" alt="logo"/></a>
        <p class="fr">
            <a href="#" title="服务条款">服务条款</a>牛模网版权所有&copy;2004-2015
        </p>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".ibanner").slide({
		titCell: ".hd ul",
		mainCell: ".bd ul",
		effect: "fold",
		autoPlay: true,
		autoPage: true,
		trigger: "click",
		startFun: function(i) {
			var curLi = jQuery(".ibanner .bd li").eq(i);
			if ( !! curLi.attr("_src")) {
				curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
			}
		}
	});
});

$(function(){
	$('.iban_form input').customInput();
});
</script>
</body>
</html>
