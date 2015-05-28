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
                	<li<?php if( !$this->input->get('type') || $this->input->get('type')==1 ) echo ' class="ne_on"'; ?>><a href="?type=1"><em>interview</em><span>模特面试</span></a></li>
                    <li<?php if( $this->input->get('type')==2 ) echo ' class="ne_on"'; ?>><a href="?type=2"><em>work</em><span>模特工作</span></a></li>
                    <li<?php if( $this->input->get('type')==3 ) echo ' class="ne_on"'; ?>><a href="?type=3"><em>game</em><span>模特比赛</span></a></li>
                </ul>
            </div>
            <div class="ne_con">
            	<ul class="clearfix">
                    <?php foreach ($list['rows'] as $key => $a): ?>
                	<li>
                    	<a class="picimg" href="#"><img src="<?=$a['img'];?>"/></a>
                        <div class="clearfix">
                        	<p class="fl nebti"><?=$a['title'];?> <em><?=($a['innum']+$a['innumfake']);?>人 报名</em></p>
                            <a class="fr status" href="##">
                            <?php if($a['endtime']>=time())
                                    echo date('Y-m-d',$a['endtime']);
                                else
                                    echo '已结束';?></a>
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
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</html>