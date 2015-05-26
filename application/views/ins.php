<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>机构-牛模网</title>
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
<div class="mainbody">
    <div class="insti inst_tion">
        <div class="container">
            <div class="our_insti">
                <ul class="clearfix">
                    <?php foreach ($list['rows'] as $key => $a): ?>
                    <li>
                        <a href="/i/index/<?=$a['id']?>" title="<?=$a['company']?>"><img src="<?=$a['showimg'];?>"/></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <br><br>
            <div class="page">
                <?=$list['pages']?>
            </div><!--page-->
            <br><br>
        </div>
    </div>
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>


<div id="share">
	<a id="totop" title="" href="javascript:void(0);">返回顶部</a>
</div></body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</html>