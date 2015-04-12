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
        <div class="women artistes">
            <ul class="clearfix">
                <?php for($i=0;$i<12;$i++){?>
                <li>
                    <a href="##" title="美少妇模特秀">
                        <div class="mtimg">
                            <img class="show" alt="美少妇模特秀" src="images/mt_1.jpg"/>
                            <img class="hide" alt="美少妇模特秀" src="images/mt_4.jpg"/>
                        </div>
                        <span class="womzi">美少妇模特秀</span>
                    </a>
                </li>
                <?php }?>
            </ul>
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