<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php");?>
<link href="css/base.css" type="text/css" rel="stylesheet" />
<link href="css/common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include("include/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include("include/uc_menu.php");?>
            <div class="fr uc_content">
            	<?php include("include/notice.php");?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti clearfix">
                        	<h3 class="fl">客户管理1</h3>
							<a class="fr addto" href="javascript:;" onclick="alertWin(this)"><i></i>添加客户</a>
                        </div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <th width="250">联系人</th>
                              <th width="110">联系方式</th>
                              <th>备注</th>
                              <th width="120">操作</th>
                            </tr>
                            <?php for($i=0;$i<5;$i++){?>
                            <tr>
                              <td>( 乐邦科技 ) 谢忠良</td>
                              <td>18989898989</td>
                              <td><div class="t_cont">做网站的，拍过宣传片</div></td>
                              <td class="operat"><a class="t_delete" href="##"><i></i>删除</a><a class="t_editor" href="##"><i></i>编辑</a></td>
                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include("include/footer.php");?>

<div class="popover-mask"></div>
<div class="popover complaint addcust">
	<div class="compl_top"><span class="fl">添加客户</span><a href="javascript:;" onclick="closeWin(this)" title="关闭" class="close fr">×</a></div>
	<div class="compl_con">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>联 系 人：</font></td>
              <td><input name="" type="text" class="txt"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td width="80"><font>联系方式：</font></td>
              <td><input name="" type="text" class="txt"/></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td valign="top"><font>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：</font></td>
              <td><textarea class="txt text" name="" cols="" rows=""></textarea></td>
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