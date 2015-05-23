
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人主页-牛模网</title>
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
        
    <?php include_once(VIEWPATH."i/public/top.php");?>
    <div class="personal mrgB30">
            <div class="title">基本信息</div>
            <ul class="clearfix bainfo">
            	<li><span>姓名</span> <?=$oUser['nickname']?></li>
                <li><span>罩杯</span> <?=$oUser['cup']?>  B</li>
                <li><span>身高</span> <?=$oUser['height']?>  cm</li>
                <li><span>体重</span> <?=$oUser['weight']?>  kg</li>
                <li><span>三围</span> <?=$oUser['bust']?>-<?=$oUser['waist']?>-<?=$oUser['hips']?></li>
                <li><span>鞋码</span> <?=$oUser['shoes']?>  码</li>
            </ul>
            <br /><br /><br />
            <div class="title">个人经历</div>
            <div class="clearfix">
            	<div class="fl flpet">
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>平面拍摄</h3>
                        <div class="p_wzi"> <?=$oUser['planeshot']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>获得奖项</h3>
                        <div class="p_wzi"> <?=$oUser['awards']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>T台活动</h3>
                        <div class="p_wzi"> <?=$oUser['tactivity']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>影视广告</h3>
                        <div class="p_wzi"> <?=$oUser['telead']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>杂志拍摄</h3>
                        <div class="p_wzi"> <?=$oUser['magazine']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>视频地址</h3>
                        <div class="p_wzi"> <?=$oUser['video']?><br /></div>
                    </div>
                </div>
                <?php if($oUser['video']):?>
                <div class="fr p_video">
                    <iframe width="400px" height="260px" src="$oUser['video']" frameborder=0 allowfullscreen></iframe>
                </div>
                <?php endif?>
            </div>
            <br /><br /><br />
            <div class="title">服务说明</div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>模特费</h3>
                <div class="p_wzi"><?=$oUser['fee']?></div>
            </div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>服务时间</h3>
                <div class="p_wzi"><?=$oUser['servicetime']?></div>
            </div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>禁拍说明</h3>
                <div class="p_wzi"><?=$oUser['takenote']?></div>
            </div>
            <br /><br />
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