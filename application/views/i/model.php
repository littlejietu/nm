
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>机构主页-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>

<div class="mainbody" id="mainbody">
	<div class="introd container">
        
    <?php
      if($oUser['usertype']==1)
        include_once(VIEWPATH."i/public/top.php");
      if($oUser['usertype']==2)
        include_once(VIEWPATH."i/public/top_ins.php");?>
        <div class="women artistes">
            <ul class="clearfix">
                <?php foreach ($list['rows'] as $key => $a):?>
                <li>
                    <a href="/i/index/<?=$a['id']?>" target="_blank" title="<?=$a['nickname']?>">
                        <div class="mtimg">
                            <img class="show" alt="<?=$a['nickname']?>" originalsrc="<?=$a['showimg']?>"/>
                            <img class="hide" alt="<?=$a['nickname']?>" originalsrc="<?=$a['showimg2']?>"/>
                        </div>
                        <span class="womzi"><?=$a['nickname']?></span>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>

            <div class="page">
              <?=$list['pages']?>
            </div>
        </div>

    </div>
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>main.js"></script>
</html>