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
<div class="mainbody">
	<div class="insti inst_tion">
        <div class="container">
        	<div class="our_insti">
            	<ul class="clearfix">
                	<?php for($i=0;$i<15;$i++){?>
                	<li>
                    	<a href="introduction.php" title="机构"><img alt="机构" src="images/mt_5.jpg"/></a>
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