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
            <?php include("include/uc_menu_consume.php")?>
            <div class="fr uc_content">
            	<?php include("include/notice.php")?>
                <div class="clearfix uitopg">
                	<div class="fl um_uitop">
                    	<div class="brotop clearfix">
                        	<div class="fl broad"><p class="b_pti">今日订单播报</p><span class="b_num"><em>2</em> <a href="##">查看</a></span></div>
                            <div class="fl broad b_gain"><p class="b_pti">本月收益总额</p><span class="b_num"><em>356.00</em> <a href="##">提现</a></span></div>
                            <div class="fr beye"><a href="##">更多</a></div>
                        </div>
                        <div class="umbcon"><img src="images/um_con.jpg"/></div>
                    </div>
                    <div class="fr um_wind">
                    	<div class="uw_help">
                        	<div class="uwh_title"><h3></h3><span><i></i>我的档期</span></div>
                            <div class="u_circle">
                            	<a href="##"><h3>档期小助手</h3><p>方便 快捷 明确</p></a>
                            </div>
                        </div>
                        <div class="uw_help">
                        	<div class="uwh_title"><h3></h3><span><i></i>热门推荐</span></div>
                            <div class="u_recom">
                            	<ul class="clearfix">
                                	<?php for($i=0;$i<6;$i++){?>
                                	<li><a href="##"><img src="images/h_1.jpg"/></a></li>
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