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
                   	    <div class="aut_bti">个人资料</div>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                           	  <tr>
                               	  <td colspan="4">基本信息</td>
                              </tr>
                              <tr>
                                <td width="86">昵  称</td>
                                <td colspan="3"><input name="" type="text" class="txt" placeholder="请输入昵称"/></td>
                              </tr>
                              <tr>
                                <td width="86">头  像</td>
                                <td colspan="3">
                                    <div id="previews" class="drsMoveHandle">
                                   	    <img id="imghead" border=0 src='images/imghead.jpg'>
                                    </div>
                                    <div class="f_note">
                                        <p>尺寸：90×90像数<br />仅支持JPEG，上传图片大小不能超过1M。</p>
                                        <div class="file_but">
                                            <input class="inp_btn" type="button" name="" value="选择照片" />
                                            <input type="file" class="inp_file" name="file" onchange="previewImage(this)"/>
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="86">真实姓名</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入姓名"/></td>
                                <td>身 高</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入身高"/></td>
                              </tr>
                              <tr>
                                <td>性别</td>
                                <td class="reg-sort">
                                	<p><input type="radio" name="sort" value="" id="sort_1"/><label for="sort_1">男</label></p>
                        			<p><input type="radio" name="sort" value="" id="sort_2"/><label for="sort_2">女</label></p>
                                </td>
                                <td>体重</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入体重"/></td>
                              </tr>
                              <tr>
                                <td>所在城市</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入你所在城市"/></td>
                                <td>三围</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入你的三围"/></td>
                              </tr>
                              <tr>
                                <td>罩杯</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入你的罩杯"/></td>
                                <td>鞋码</td>
                                <td><input name="" type="text" class="txt" placeholder="请输入你的鞋码"/></td>
                              </tr>
                               <tr>
                               	  <td colspan="4">个人经历</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>拍摄品牌</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="" cols="" rows=""></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>品牌类型</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌类型"  name="" cols="" rows=""></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>获得奖项</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你获得的奖项" name="" cols="" rows=""></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>模特费</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="" cols="" rows=""></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>服务时间</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="" cols="" rows=""></textarea></td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td width="86" valign="top"><font>禁拍说明</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="" name="" cols="" rows=""></textarea></td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td style="height:80px">&nbsp;</td>
                                <td colspan="3">
                                    <input name="" type="button" class="but" value="提交"/>
                                    <input name="" type="button" class="but but_reset" value="重置"/>
                                </td>
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