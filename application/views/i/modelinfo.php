
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$oUser['nickname']?>-机构主页-<?=_get_config('sitename')?></title>
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
        
    <?php include_once(VIEWPATH."i/public/top_ins.php");?>
    <div class="personal mrgB30">
            <div class="title">基本信息</div>
            <ul class="clearfix bainfo">
            	<li><span>姓名</span> <?=$oInfo['nickname']?></li>
                <li><span>罩杯</span> <?=$oInfo['cup']?>  B</li>
                <li><span>身高</span> <?=$oInfo['height']?>  cm</li>
                <li><span>体重</span> <?=$oInfo['weight']?>  kg</li>
                <li><span>三围</span> <?=$oInfo['bust']?>-<?=$oInfo['waist']?>-<?=$oInfo['hips']?></li>
                <li><span>鞋码</span> <?=$oInfo['shoes']?>  码</li>
            </ul>
            <br /><br /><br />
            <div class="title">个人说明</div>
            <div class="clearfix">
            	<div class="fl flpet">
                    
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>拍摄经历</h3>
                        <div class="p_wzi"> <?=$oInfo['brand']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>工作经历</h3>
                        <div class="p_wzi"> <?=$oInfo['brandtype']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>平面拍摄</h3>
                        <div class="p_wzi"> <?=$oInfo['planeshot']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>获得奖项</h3>
                        <div class="p_wzi"> <?=$oInfo['awards']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>T台活动</h3>
                        <div class="p_wzi"> <?=$oInfo['tactivity']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>影视广告</h3>
                        <div class="p_wzi"> <?=$oInfo['telead']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>杂志拍摄</h3>
                        <div class="p_wzi"> <?=$oInfo['magazine']?><br /></div>
                    </div>
                    <div class="per_con">
                        <h3 class="p_bti"><i></i>视频地址</h3>
                        <div class="p_wzi"> <?=$oInfo['video']?><br /></div>
                    </div>
                </div>
                <?php if($oInfo['video']):?>
                <div class="fr p_video">
                    <iframe width="400px" height="260px" src="$oInfo['video']" frameborder=0 allowfullscreen></iframe>
                </div>
                <?php endif?>
            </div>
            <br /><br /><br />
            <div class="title">工作说明</div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>工作报价</h3>
                <div class="p_wzi"><?=$oInfo['fee']?></div>
            </div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>工作时间</h3>
                <div class="p_wzi"><?=$oInfo['servicetime']?></div>
            </div>
            <div class="per_con">
                <h3 class="p_bti"><i></i>注意事项</h3>
                <div class="p_wzi"><?=$oInfo['takenote']?></div>
            </div>
            <?php if($oInfo['card']):?>
            <br /><br />
            <div class="title">模特卡</div>
            <br />
            <div class="per_advert">
                <a href="/<?=$oInfo['card']?>" target="_blank"><img style="width:1070px;height:500px;" src="/<?=$oInfo['card']?>"/></a>
            </div>
            <?php endif?>
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