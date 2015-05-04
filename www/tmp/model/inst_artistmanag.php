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
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include("include/uc_menu_inst.php")?>
            <div class="fr uc_content">
            	<?php include("include/notice.php")?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti"><h3>艺人管理</h3></div>
                        <div class="works malbums mworks inst_arti">
                        	<div class="aut_bti mw_upload">摄影师</div>
                            <ul class="clearfix">
                                <?php for($i=0;$i<4;$i++){?>
                                <li>
                                    <a href="##">
                                        <img src="images/mt_1.jpg"/>
                                        <div class="mwk_hover">
                                        	<p>
                                                <span class="mh_1"></span>
                                                <span class="mh_2"></span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                            <div class="aut_bti mw_upload">模特</div>
                            <ul class="clearfix">
                                <?php for($i=0;$i<3;$i++){?>
                                <li>
                                    <a href="##">
                                        <img src="images/mt_1.jpg"/>
                                        <div class="mwk_hover">
                                        	<p>
                                                <span class="mh_1"></span>
                                                <span class="mh_2"></span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                            <div class="aut_bti mw_upload">化妆师</div>
                            <ul class="clearfix">
                                <?php for($i=0;$i<3;$i++){?>
                                <li>
                                    <a href="##">
                                        <img src="images/mt_1.jpg"/>
                                        <div class="mwk_hover">
                                        	<p>
                                                <span class="mh_1"></span>
                                                <span class="mh_2"></span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include("include/footer.php")?>
</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
</html>