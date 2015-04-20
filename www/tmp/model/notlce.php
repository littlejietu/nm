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
        <div class="notlce">
            <div class="ne_title">
            	<ul class="clearfix">
                	<li class="ne_on"><a href="##"><em>interview</em><span>模特面试</span></a></li>
                    <li><a href="##"><em>work</em><span>模特工作</span></a></li>
                    <li><a href="##"><em>game</em><span>模特比赛</span></a></li>
                </ul>
            </div>
            <div class="ne_con">
            	<ul class="clearfix">
                	<?php for($i=0;$i<8;$i++){?>
                	<li>
                    	<a class="picimg" href="#"><img src="images/mt_10.jpg"/></a>
                        <div class="clearfix">
                        	<p class="fl nebti">第八季 1~6-全美超模大赛 <em>2469人 报名</em></p>
                            <a class="fr status" href="##">已结束</a>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
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
</html>