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
                	<div class="fl um_uitop">
                    	<div class="authent">
                        	<div class="aut_bti">经纪人管理</div>
                            <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="86">真实姓名</td>
                                  <td><input name="" type="text" class="txt" placeholder="请输入姓名"/></td>
                                </tr>
                                <tr>
                                  <td>密码</td>
                                  <td>
                                      <input name="" type="text" class="fl txt" placeholder="请输入密码"/>
                                      <input name="" type="button" class="fl but but_3" value="重置密码"/>
                                      <p class="fl inst_brok">重置后默认密码123456</p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>手机号</td>
                                  <td><input name="" type="text" class="txt" placeholder="请输入手机号码"/></td>
                                </tr>
                                <tr>
                                  <td>性别</td>
                                  <td class="reg-sort">
                                      <p><input type="radio" name="sort" value="" id="sort_1"/><label for="sort_1">男</label></p>
                                      <p><input type="radio" name="sort" value="" id="sort_2"/><label for="sort_2">女</label></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td valign="top"><font>备注</font></td>
                                  <td><textarea class="txt text" placeholder="备注"  name="" cols="" rows=""></textarea></td>
                                </tr>
                                <tr style="border-bottom:none;">
                                  <td style="height:80px">&nbsp;</td>
                                  <td><input name="" type="button" class="but" value="确认修改"/></td>
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