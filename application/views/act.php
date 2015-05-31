<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通告-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
	<div class="container">
        <div class="notlce">
            <div class="ne_title">
            	<ul class="clearfix">
                    <?php foreach ($oSysAct as $k => $v):?>
                	   <li<?php if( ($k==1 && !$this->input->get('type')) || $this->input->get('type')==$k ) echo ' class="ne_on"'; ?>><a href="?type=<?=$k?>"><em><?=$oSysAct_en[$k]?></em><span><?=$v?></span></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="ne_con">
            	<ul class="clearfix">
                    <?php foreach ($list['rows'] as $key => $a): ?>
                	<li>
                    	<a class="picimg" href="#"><img src="<?=$a['img'];?>"/></a>
                        <div class="clearfix">
                        	<p class="fl nebti"><?=$a['title'];?> <em><?=($a['innum']+$a['innumfake']);?>人 报名</em></p>
                            <?php if($a['endtime']>=time()):?>
                                <a class="fr status XT-enter" _val="<?=_get_key_val($a['id']);?>" title="<?=$a['title'];?>" href="javascript:;">报名</a>
                            <?php else:?>
                                <span class="fr status">已结束</span>
                            <?php endif?>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <br /><br />
            <div class="page">
                <?=$list['pages']?>
            </div><!--page-->
            <br /><br />
        </div>
    </div>
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>


<div id="share">
	<a id="totop" title="" href="javascript:void(0);">返回顶部</a>
</div></body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/act.js"></script>
</html>