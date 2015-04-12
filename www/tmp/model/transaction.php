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
                        	<h3 class="fl">交易管理</h3>
                            <div class="fr t_sosu">
                            	<span class="fl">请选择：</span>
                                <select name="" class="txt sele fl">
                                    <option>不限状态</option>
                                    <option>景色取点</option>
                                    <option>人物广告</option>
                                </select>
                                <input name="" type="text" class="txt fl" placeholder="请输入关键词"/>
                                <input name="" class="but fr" type="button" value="搜 索"/>
                            </div>
                        </div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <th width="120">订单编号</th>
                              <th>服务项目</th>
                              <th width="90">总价</th>
                              <th width="90">下单时间</th>
                              <th width="90">预约时间</th>
                              <th width="80">交易状态</th>
                              <th width="70">操作</th>
                            </tr>
                            <?php for($i=0;$i<5;$i++){?>
                            <tr>
                              <td>2021027727</td>
                              <td><div class="t_cont">拍摄内容：内衣   场景：外景   拍摄方式：普通</div></td>
                              <td>￥98.00</td>
                              <td>2015-10-21</td>
                              <td>2015-10-25</td>
                              <td>已付款</td>
                              <td><a class="t_delete" href="##">删除</a></td>
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
<?php include("include/footer.php")?>
</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
</html>