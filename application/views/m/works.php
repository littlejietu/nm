<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>服务价格-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <div class="fl uc_menu">
    <div class="menu_head">
        <a class="m_himg" href="##">
            <img src="images/head.jpg"/>
            <div class="head_bj"></div>
        </a>
        <h3 class="m_name"><a href="member.php">范萌</a></h3>
        <p class="m_prompt">哈尼，喝杯下午茶，精神精神！</p>
    </div>
    <div class="menu_box">
        <ul>
            <li class=""><a href="interactive.php">互动总览<i></i></a></li>
            <li class="current"><a href="profile.php">个人资料<i></i></a></li>
            <li class=""><a href="price.php">服务价格<i></i></a></li>
            <li><a href="authent.php">我的认证<i></i></a></li>
            <li><a href="mworks.php">作品管理<i></i></a></li>
            <li><a href="order.php">交易管理<span class="o_mete">8</span><i></i></a></li>
            <li><a href="##">资金账户<i></i></a></li>
            <li style="display:none"><a href="transaction.php">交易管理<i></i></a></li>
            <li><a href="review.php">评论管理<i></i></a></li>
            <li><a href="client.php">客户管理<i></i></a></li>
            <li><a href="letter.php">站内信<i></i></a></li>
        </ul>
    </div>
    <div class="m_level">
        <h3 class="clearfix ml_bti"><font class="fl">账户安全级别：</font><em class="fr">中</em></h3>
        <div class="level"><span class="rating_2"></span></div>
    </div>
</div>            <div class="fr uc_content">
            	<div class="txtScroll-top help_notice">
    <div class="bd">
        <span class="not_ico"></span>
        <ul class="infoList">
            <li><a href="##">3月5日开始，模特档期管理开放，请大家及时更新自己的档期~么么哒</a></li>
        </ul>
    </div>
    <div class="close" onclick="helpClose(this)">关闭</div>
</div>                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti"><h3>作品管理</h3></div>
                        <div class="works malbums mworks">
                        	<div class="aut_bti mw_upload clearfix">
                            	<a class="fl addto ato_1" href="uploadworks.php"><i></i>上传照片</a>
                                <a class="fl addto" href="javascript:;" onclick="alertWin(this)"><i></i>创建相册</a>
                            </div>
                            <ul class="clearfix">
                                                                <li>
                                    <a href="##">
                                        <img src="images/ma_3.jpg"/>
                                        <div class="mwk_hover">
                                        	<p>
                                                <span class="mh_1"></span>
                                                <span class="mh_2"></span>
                                            </p>
                                        </div>
                                        <div class="wor_wzi">
                                            <h3>花与爱丽丝婚纱拍摄<span>（45张）</span></h3>
                                            <p>创建时间：2014-11-11</p>
                                        </div>
                                    </a>
                                </li>
                                                                <li>
                                    <a href="##">
                                        <img src="images/ma_3.jpg"/>
                                        <div class="mwk_hover">
                                        	<p>
                                                <span class="mh_1"></span>
                                                <span class="mh_2"></span>
                                            </p>
                                        </div>
                                        <div class="wor_wzi">
                                            <h3>花与爱丽丝婚纱拍摄<span>（45张）</span></h3>
                                            <p>创建时间：2014-11-11</p>
                                        </div>
                                    </a>
                                </li>
                                                                <li>
                                    <a href="##">
                                        <img src="images/ma_3.jpg"/>
                                        <div class="mwk_hover">
                                        	<p>
                                                <span class="mh_1"></span>
                                                <span class="mh_2"></span>
                                            </p>
                                        </div>
                                        <div class="wor_wzi">
                                            <h3>花与爱丽丝婚纱拍摄<span>（45张）</span></h3>
                                            <p>创建时间：2014-11-11</p>
                                        </div>
                                    </a>
                                </li>
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
<?php include_once(VIEWPATH."public/footer.php");?>

<div class="popover-mask"></div>
<div class="popover complaint">
	<div class="compl_top"><span class="fl">创建相册</span><a href="javascript:;" onclick="closeWin(this)" title="关闭" class="close fr">×</a></div>
	<div class="compl_con">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>相册名称：</font></td>
              <td><input style="width:300px" class="txt" name="" type="text" placeholder="请输入相册名称"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td valign="top"><font>相册描述：</font></td>
              <td><textarea class="txt text" name="" cols="" rows="" placeholder="请添加相册描述"></textarea></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
            	<td>&nbsp;</td>
               <td><input class="but" name="" type="button" value="创建"/></td>
            </tr>
        </table>
    </div>
</div>

</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
</html>