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
<body>
<?php include("include/header.php")?>
<div class="mainbody" id="mainbody">
    <div class="women">
        <div class="container">
        	<div class="bti"><img alt="women" src="images/bti_1.png"/></div>
        	<ul class="clearfix">
            	<?php for($i=0;$i<100;$i++){?>
            	<li>
                    <a href="##" title="美少妇模特秀">
                        <div class="mtimg">
                        	<img class="show" alt="美少妇模特秀" originalsrc="images/mt_1.jpg"/>
                        	<img class="hide" alt="美少妇模特秀" originalsrc="images/mt_4.jpg"/>
                        </div>
                        <span class="womzi">美少妇模特秀</span>
                    </a>
                </li>
                <?php }?>
            </ul>
            <br /><br />
            <div class="page"><a href="#" class="prev_s">上一页</a><a href="#" class="page-v current">1</a><a href="#" class="page-v">2</a><a href="#" class="page-v">3</a><a href="#" class="page-v">4</a><a href="#" class="next_x">下一页</a></div><!--page-->
            <br /><br />
        </div>
    </div>    
</div>
<!--mainbody-->
<?php include("include/footer.php")?>
</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/lyz.delayLoading.min.js"></script>
<script type="text/javascript">
$(function () {
	$("img").delayLoading({
		defaultImg: "images/loading.jpg",   // 预加载前显示的图片
		errorImg: "",                       // 读取图片错误时替换图片(默认：与defaultImg一样)
		imgSrcAttr: "originalSrc",          // 记录图片路径的属性(默认：originalSrc，页面img的src属性也要替换为originalSrc)
		beforehand: 0,                      // 预先提前多少像素加载图片(默认：0)
		event: "scroll",                    // 触发加载图片事件(默认：scroll)
		duration: "normal",                 // 三种预定淡出(入)速度之一的字符串("slow", "normal", or "fast")或表示动画时长的毫秒数值(如：1000),默认:"normal"
		container: window,                  // 对象加载的位置容器(默认：window)
		success: function (imgObj) {},      // 加载图片成功后的回调函数(默认：不执行任何操作)
		error: function (imgObj) {}         // 加载图片失败后的回调函数(默认：不执行任何操作)
	});
});
</script>
</html>