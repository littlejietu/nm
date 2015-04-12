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
                	<div class="fl um_uitop">
                   	  <div class="authent">
                   	    <div class="aut_bti">服务价格</div>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="86" valign="top"><font>工作内容：</font></td>
                                <td colspan="3" valign="top" class="price">
                                	<span><input type="checkbox" name="Checkbox1" value="" id="cbox_1"/><label for="cbox_1">服装拍摄</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_2"/><label for="cbox_2">平面广告</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_3"/><label for="cbox_3">时尚杂志</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_4"/><label for="cbox_4">内衣泳装</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_5"/><label for="cbox_5">娱乐节目</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_6"/><label for="cbox_6">视频广告</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_7"/><label for="cbox_7">其他拍摄</label></span>
                                    <span><input type="checkbox" name="Checkbox1" value="" id="cbox_8"/><label for="cbox_8">其他活动</label></span>
                                </td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作场景：</font></td>
                                <td colspan="3" valign="top" class="price">
                                	<span><input type="radio" name="sort" value="" id="ebox_1"/><label for="ebox_1">外景</label></span>
                                    <span><input type="radio" name="sort" value="" id="ebox_2"/><label for="ebox_2">棚景</label></span>
                                </td>
                              </tr>
                              <tr>
                                <td width="86">计价方式：</td>
                                <td colspan="3" class="price">
                                	<span><input type="radio" name="sort2" value="" id="pbox_1"/><label for="pbox_1">天</label></span>
                                    <span><input type="radio" name="sort2" value="" id="pbox_2"/><label for="pbox_2">时</label></span>
                                    <span><input type="radio" name="sort2" value="" id="pbox_3"/><label for="pbox_3">场</label></span>
                                    <span><input type="radio" name="sort2" value="" id="pbox_4"/><label for="pbox_4">件</label></span>
                                </td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td style="height:80px">&nbsp;</td>
                                <td colspan="3">
                                    <input name="" type="button" class="but" value="提交"/>
                                    <input name="" type="button" class="but but_reset" value="重置"/>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">服装拍摄 + 外景 + 天 </td>
                                <td colspan="2" align="right"><input name="" type="text" class="txt txt_price" value="¥ 150.00"/></td>
                              </tr>
                          </table>
                        </div>
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