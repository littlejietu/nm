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
	<div class="container">
        <div class="mode_title clearfix">
            <a class="fl picimg" href="##"><img src="images/models_1.jpg"/></a>
            <a class="fr picimg" href="##"><img src="images/models_2.jpg"/></a>
        </div>
        <div class="m_sort">
        	<ul class="clearfix" style="width:100%">
            	<li style="width:48.5%"><a href="##">亚洲模特</a></li>
                <li style="width:48.5%;float:right;margin-right:0;"><a href="##">欧美模特</a></li>
                <!--<li><a href="##">平面模特</a></li>
                <li><a href="##">T台模特</a></li>
                <li><a href="##">影视模特</a></li>
                <li><a href="##">新人模特</a></li>
                <li><a href="##">活动模特</a></li>-->
            </ul>
        </div>
        <div class="m_filter">
        	<div class="filterBox">
                <div class="values"><span class="label">类型：</span>
                    <p class="clearfix"><a href="##" class="curr" title="不限">不限</a><a href="##" title="韩系名媛">韩系名媛</a><a href="##" title="气场欧美">气场欧美</a><a href="##" title="优雅复古">优雅复古</a><a href="##" title="清新文艺">清新文艺</a><a href="##" title="英伦学院">英伦学院</a><a href="##" title="甜美日系">甜美日系</a><a href="##" title="OL通勤">OL通勤</a><a href="##" title="接头混搭">接头混搭</a><a href="##" title="性感诱惑">性感诱惑</a></p>
                </div>
                <div class="values"><span class="label">风格：</span>
                <p class="clearfix"><a href="##" class="curr" title="不限">不限</a><a href="##" title="韩系名媛">韩系名媛</a><a href="##" title="气场欧美">气场欧美</a><a href="##" title="优雅复古">优雅复古</a><a href="##" title="清新文艺">清新文艺</a><a href="##" title="英伦学院">英伦学院</a><a href="##" title="甜美日系">甜美日系</a><a href="##" title="OL通勤">OL通勤</a><a href="##" title="接头混搭">接头混搭</a><a href="##" title="性感诱惑">性感诱惑</a></p>
            </div>
                <div class="values"><span class="label">地区：</span>
                        <p class="clearfix"><a href="##" class="curr" title="不限">不限</a><a href="##" title="160-170cm ">160-170cm</a><a href="##" title="170-180cm">170-180cm</a><a href="##" title="＞180cm">＞180cm</a></p>
                    </div>
                <div class="values"><span class="label">身高：</span>
                    <p class="clearfix"><a href="##" class="curr" title="不限">不限</a><a href="##" title="160-170cm ">160-170cm</a><a href="##" title="170-180cm">170-180cm</a><a href="##" title="＞180cm">＞180cm</a></p>
                </div>
            </div>
            <div class="control_bar">
            	<a class="button_less" href="javascript:void(0);">更多选项<span class="ifont"></span></a>
            </div>
        </div>
    </div>
    <div class="women models">
        <div class="container">
        	<ul class="clearfix">
            	<?php for($i=0;$i<100;$i++){?>
            	<li>
                    <a href="malbums.php" title="美少妇模特秀">
                        <div class="mtimg">
                        	<img class="show" alt="美少妇模特秀" originalsrc="images/mt_9.jpg"/>
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