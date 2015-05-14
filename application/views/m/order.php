<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>客户管理-个人中心-牛模网</title>
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
            <?php include_once(VIEWPATH."m/public/left_menu.php");?>
            <div class="fr uc_content">
            	<?php include_once(VIEWPATH."m/public/notice.php");?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti clearfix">
                          <h3 class="fl">我的订单</h3>
                            <div class="fr t_sosu">
                              
                                <p class="fl sele sele_ta"><a href="##">代付款</a><a href="##">已完成</a><a href="##">待完成</a></p>
                                <input name="" type="text" class="txt fl" placeholder="请输入关键词">
                                <input name="" class="but fr" type="button" value="搜 索">
                            </div>
                        </div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <th width="120">订单编号</th>
                              <th>服务项目</th>
                              <th width="90">总价</th>
                              <th width="90">预约时间</th>
                              <th width="90">下单时间</th>
                              <th width="80">订单状态</th>
                              <th width="110">操作</th>
                            </tr>
                            <?php foreach ($list['rows'] as $key => $a): ?>
                            <tr>
                              <td><a href="orderdeta.php"><?php echo $a['no'];?></a></td>
                              <td><div class="t_cont"><?php echo $a['title'];?></div></td>
                              <td><?php echo $a['totalprice'];?></td>
                              <td><?php //echo $a['title'];?></td>
                              <td><?php echo $a['addtime'];?></td>
                              <td><a href="#">待付款</a></td>
                              <td><a class="t_delete" href="##">拒绝</a><a class="t_delete" href="##">编辑</a><a class="t_delete" href="##">删除</a></td>
                            </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>





                   
                </div>

            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/info.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

</html>