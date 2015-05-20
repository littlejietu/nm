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
                    <div class="transa">
                        <div class="aut_bti">评论管理</div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <th>留言</th>
                              <th width="180">操作</th>
                            </tr>
                        </table>
                        <ul class="tran_tab">
                        	<?php for($i=0;$i<4;$i++){?>
                        	<li class="clearfix t_review">
                            	<div class="em_rit fl">
                                   <div class="apprtop">
                                       <div class="fl a_rev"><span>身材尺寸：</span><p class="star_on"><i class="star_5">5</i></p></div>
                                       <div class="fl a_rev"><span>专业技能：</span><p class="star_on"><i class="star_4">5</i></p></div>
                                       <div class="fl a_rev"><span>工作效率：</span><p class="star_on"><i class="star_3">5</i></p></div>
                                       <div class="fl a_rev" style="margin-right:0;"><span>服务态度：</span><p class="star_on"><i class="star_2">5</i></p></div>
                                   </div>
                                   <div class="apprcon">之前去过那边看赖声川的话剧---《十三角关系》，剧院风格很大方，而且内部也不错。不过就是之前买票买了中档的，并不觉和最低价的那一档有什么太大区别。但是附近，交通并不是很便利，出租车什么都较少。学生党晚上去那边的话，花费会较大些~</div>
                                   <div class="clearfix">
                                        <span class="fl">范萌</span><em class="fr">2015-2-13      13:32</em>       
                                   </div>
                                </div>
                                <div class="fl operat"><a class="t_delete" href="javascript:;"><i></i>回复</a></div>
                                <a class="t_editor fr" href="javascript:;" onclick="alertWin(this)"><i></i>投诉</a>
                                <div style="clear:both"></div>
                                <div class="fabiao reply">
                                	<textarea id="starcontent" name="content" cols="" class="texta" placeholder="谢谢哦，下次有机会继续合作哦~~"></textarea>
                                    <br /><br />
                                    <input name="" type="submit" class="but" value="创建" /><input name="" type="submit" class="but but_2" value="取消" />
                                </div>
                            </li>
                            <?php }?>
                        </ul>
                        
                        
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
	<div class="compl_top"><span class="fl">发起投诉</span><a href="javascript:;" onclick="closeWin(this)" title="关闭" class="close fr">×</a></div>
	<div class="compl_con">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="80"><font>投诉类型：</font></td>
              <td><select name="" class="txt sele" style="width:312px">
                    <option>未按照约定时间进行拍摄</option>
                    <option>景色取点</option>
                    <option>人物广告</option>
                </select></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
              <td valign="top"><font>投诉说明：</font></td>
              <td><textarea class="txt text" name="" cols="" rows=""></textarea></td>
            </tr>
            <tr><td height="10"></td></tr>
            <tr>
            	<td>&nbsp;</td>
               <td><input class="but" name="" type="button" value="提交"/></td>
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