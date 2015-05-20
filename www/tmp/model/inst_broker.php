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
                        <div class="aut_bti clearfix">
                        	<h3 class="fl">经纪人管理</h3>
							<a class="fr addto" href="javascript:;" onclick="alertWin(this)"><i></i>添加经纪人</a>
                        </div>
                        <div class="ibrok_con">
                        	<ul class="clearfix">
                            	<?php for($i=0;$i<5;$i++){?>
                            	<li>
                                	<h3>萌萌哒是我<span>经纪人</span></h3>
                                    <p>联系方式：15888837421</p>
                                    <i class="ibrok_con_chua"></i>
                                    <div class="ibrok_show">
                                    	<a href="inst_broker_edit.php">编辑</a>
                                        <a href="##">删除</a>
                                    </div>
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

<div class="popover-mask"></div>
<div class="popover complaint addcust">
	<div class="compl_top"><span class="fl">添加客户</span><a href="javascript:;" onclick="closeWin(this)" title="关闭" class="close fr">×</a></div>
	<div class="compl_con ibrok_pop">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>联 系 人：</font></td>
              <td><input name="" type="text" class="txt" placeholder="添加联系人"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td width="80"><font>联系方式：</font></td>
              <td><input name="" type="text" class="txt" placeholder="添加联系方式"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td width="80"><font>管理权限：</font></td>
              <td>
              	<p><input type="radio" name="sort" value="" id="sort_1"/><label for="sort_1">模特</label></p>
                <p><input type="radio" name="sort" value="" id="sort_2"/><label for="sort_2">化妆师</label></p>
              </td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td valign="top"><font>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</font></td>
              <td><textarea class="txt text" name="" cols="" rows="" placeholder="备注"></textarea></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
            	<td>&nbsp;</td>
               <td><input class="but" name="" type="button" value="添加"/></td>
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