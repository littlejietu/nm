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
            <?php include("include/uc_menu.php")?>
            <div class="fr uc_content">
            	<?php include("include/notice.php")?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti">互动总览</div>
                        <div class="brotop inter_top">
                        	<div class="fl broad"><span class="b_num"><em>2150</em> <a href="##">关注</a></span></div>
                            <div class="fl broad"><span class="b_num"><em>32314</em> <a href="##">粉丝</a></span></div>
                            <div class="fl broad b_gain"><span class="b_num"><em>12234</em> <a href="##">拍片次数</a></span></div>
                        </div>
                        <div class="inter_con">
                        	<div class="clearfix">
                            	<h3 class="fl ic_bti">我的关注</h3>
                            	<div class="search fr">
            						<form><input type="text" onblur="if (this.value ==''){this.value='输入关键字'}" onfocus="if (this.value =='输入关键字'){this.value =''}" value="输入关键字" name=""><input class="search1" type="submit" value="" name=""></form>
                                </div>
                            </div>
                            <div class="inter_li">
                            	<ul class="clearfix">
                                	<?php for($i=0;$i<9;$i++){?>
                                	<li>
                                    	<div class="intimg fl"><img src="images/intimg.jpg"/></div>
                                        <div class="imtcon fr">
                                        	<h3><span>范萌</span><em>&radic;已关注</em></h3>
                                            <h4>平面模特</h4>
                                            <p>通过 <a href="##">平台找人</a> 关注</p>
                                        </div>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
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