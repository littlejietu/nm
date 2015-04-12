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
        <?php include("include/model.php")?>
        <div class="malbumdeta">
        	<div class="brand-list" id="brand-waterfall">
            	<?php for($i=0;$i<5;$i++){?>
                <div class="item"><img src="images/ta_1.jpg" /></div>
                <div class="item"><img src="images/ta_2.jpg" /></div>
                <div class="item"><img src="images/ta_3.jpg" /></div>
                <div class="item"><img src="images/ta_4.jpg" /></div>
                <?php }?>
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
<script type="text/javascript" src="js/waterfall.js"></script>
</html>