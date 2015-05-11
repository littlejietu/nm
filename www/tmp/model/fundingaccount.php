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
                        <div class="aut_bti clearfix">
                        	<h3 class="fl">资金账户</h3>
                            <div class="fr t_sosu">
                                <p class="fl sele sele_ta"><a href="##">代付款</a><a href="##">已完成</a><a href="##">待完成</a></p>
                                <input name="" type="text" class="txt fl" placeholder="请输入关键词"/>
                                <input name="" class="but fr" type="button" value="搜 索"/>
                            </div>
                        </div>
                        <div class="brotop clearfix fund_brot">
                            <div class="fl broad"><p class="b_pti">本月总订单数</p><span class="b_num"><em>2</em> <a href="##">查看</a></span></div>
                            <div class="fl broad b_gain"><p class="b_pti">本月收益总额</p><span class="b_num"><em>356.00</em> <a href="##">提现</a></span></div>
                        </div>
						<div class="fund_list">
                        	<div class="dl_title">正在交易中 （5）</div>
                            <ul class="fund_uli">
                            	<?php for($i=0;$i<4;$i++){?>
                            	<li>
                                	<div class="fl">
                                        <p><i>2021027727</i>   <em>拍摄内容：普通服饰</em><em>场景：外景</em><em>计价方式：普通</em></p>
                                        <p><strong>预约时间： 2015-10-21</strong>    <strong>下单时间： 2015-10-21</strong></p>
                                    </div>
                                    <span class="fr">已付款</span>
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