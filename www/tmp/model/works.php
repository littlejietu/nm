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
	<div class="introd container">
        <?php include("include/agency.php")?>
        <div class="clearfix mrgB30">
        	<div class="fl wsti">
            	<ul>
                	<li class="cur"><a href="##">摄影系列</a></li>
                    <li><a href="##">模特系列</a></li>
                    <li><a href="##">广告系列</a></li>
                </ul>
            </div>
            <div class="fr works">
                <ul class="clearfix">
                	<?php for($i=0;$i<12;$i++){?>
                	<li>
                    	<a href="##">
                        	<img src="images/mt_11.jpg"/>
                        	<div class="wor_wzi">
                            	<h3>花与爱丽丝婚纱拍摄<span>（45张）</span></h3>
                            	<p>创建时间：2014-11-11</p>
                            </div>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        
    </div>
</div>
<!--mainbody-->
<?php include("include/footer.php")?>
</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</html>