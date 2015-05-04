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
                        <div class="aut_bti clearfix"><h3>评价交易</h3></div>
                        <div class="fabiao ordapp">
                        	<div class="clearfix scor_star">
                                <div class="op_rate fl">
                                    <span class="fl">身材尺寸：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="jobs_name" id="jobs_name" value="0" type="hidden" />
                                </div>
                                <div class="op_rate fl">
                                    <span class="fl">专业技能：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="jobs_name" id="jobs_name" value="0" type="hidden" />
                                </div>
                                <div class="op_rate fl">
                                    <span class="fl">工作效率：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="jobs_name" id="jobs_name" value="0" type="hidden" />
                                </div>
                                <div class="op_rate fl">
                                    <span class="fl">配合度：</span>
                                    <a href="javascript:;" onclick="filt(this)" name="1">非常差<i class="one_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="2">很差<i class="two_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="3">一般<i class="three_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="4">很好<i class="four_rate"></i></a>
                                    <a href="javascript:;" onclick="filt(this)" name="5">非常好<i class="five_rate"></i></a>
                                    <input name="jobs_name" id="jobs_name" value="0" type="hidden" />
                                </div>
                            </div>
                            <textarea id="starcontent" name="content" cols="" rows="" class="texta" placeholder="亲，你的评价很重要哦~~"></textarea>
                            <br /><br />
                            <input name="" type="submit" class="but" value="提交评论" />
                            <br /><br />
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
<script>
function filt(a){
	$(a).addClass('licur').siblings().removeClass('licur');
	$(a).siblings('input#jobs_name').val($(a).attr('name'));
}
</script>
</html>