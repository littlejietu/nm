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
                        <div class="aut_bti"><h3>作品管理</h3></div>
                        <div class="works malbums mworks">
                        	<div class="aut_bti mw_upload clearfix">
                            	<a class="fl addto ato_1" href="uploadworks.php"><i></i>上传照片</a>
                                <a class="fl addto" href="javascript:;" onclick="alertWin(this)"><i></i>创建相册</a>
                            </div>
                            <ul class="clearfix">
                                <?php for($i=0;$i<3;$i++){?>
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