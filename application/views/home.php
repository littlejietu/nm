<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>模特-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<!--banner start -->
<div id="slideBox" class="banner">
   <div class="hd">
    <?php if(count($adlist)>1):?>
      <a class="prev" title="上一页">上一页</a>
      <a class="next" title="下一页">下一页</a>
    <?php endif?>
      <ul></ul>
   </div>
   <div class="bd">
     <ul>
        <?php foreach ($adlist as $key => $a):?>
            <li _src="url(<?=$a['img']?>)"><a href="<?=$a['url']?>" target="_blank"></a></li>
        <?php endforeach;?>
     </ul>
   </div>
</div>
<!-- banner end-->
<div class="mainbody">
    <div class="recom">
    	<ul class="clearfix">
        	<?php foreach ($rmdlist1 as $key => $a):?>
            <li>
                <a href="/i/index/<?=$a['id']?>">
                    <img alt="<?=$a['nickname']?>" src="<?=_get_userlogo_url($a['userlogo'])?>"/>
                	<p><span><?=$a['nickname']?></span></p>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="women">
        <div class="container">
        	<div class="bti clearfix"><img class="fl" alt="women" src="<?php echo _get_cfg_path('images')?>bti_1.png"/><a class="fr more" href="/model?s=2">More +</a></div>
        	<ul class="clearfix">
            	<?php foreach ($rmdlist2 as $key => $a):?>
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
        </div>
    </div>
    <div class="recom">
    	<ul class="clearfix">
        	<?php foreach ($rmdlist3 as $key => $a):?>
            <li>
                <a href="/i/index/<?=$a['id']?>">
                    <img alt="<?=$a['nickname']?>" src="<?=_get_userlogo_url($a['userlogo'])?>"/>
                    <p><span><?=$a['nickname']?></span></p>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="women">
        <div class="container">
        	<div class="bti clearfix"><img class="fl" alt="MEN" src="<?php echo _get_cfg_path('images')?>bti_2.png"/><a class="fr more" href="/model?s=1">More +</a></div>
        	<ul class="clearfix">
                <?php foreach ($rmdlist4 as $key => $a):?>
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
        </div>
    </div>
    <div class="insti">
        <div class="container">
        	<div class="bti clearfix"><img class="fl" alt="institutions" src="<?php echo _get_cfg_path('images')?>bti_3.png"/><a class="fr more" href="/ins">More +</a></div>
        	<div class="our_insti">
            	<ul class="clearfix">
                    <?php foreach ($rmdlist5 as $key => $a): ?>
                    <li>
                        <a href="/i/index/<?=$a['id']?>" title="<?=$a['company']?>"><img src="<?=$a['showimg'];?>"/></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="advert">
    	<div class="container">
          <div class="slideTxtBox advert_stb">
                <div class="hd">
                    <ul>
                        <?php foreach ($oSysAct as $k => $v):?>
                           <li value="/home/model?type=<?=$k?>"><?=$v?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="bd">
                    <ul>
                      <li><iframe width="100%" height="304" frameborder="0" scrolling="no" allowtransparency="true" src=""></iframe></li>
                    </ul>
                  <ul>
                        <li><iframe width="100%" height="304" frameborder="0" scrolling="no" allowtransparency="true" src=""></iframe></li>
                    </ul>
                    <ul>
                        <li><iframe width="100%" height="304" frameborder="0" scrolling="no" allowtransparency="true" src=""></iframe></li>
                    </ul>
                </div>
            </div>
      </div>
    </div>
    
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript">
/* banner */
$(document).ready(function(){
	$(".banner").slide({
		titCell: ".hd ul",
		mainCell: ".bd ul",
		effect: "fold",
		autoPlay: true,
		autoPage: true,
		trigger: "click",
		startFun: function(i) {
			var curLi = jQuery(".banner .bd li").eq(i);
			if ( !! curLi.attr("_src")) {
				curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
			}
		}
	});
});

/* 外层tab切换 */
jQuery(".slideTxtBox").slide({
		startFun: function(i) {
			var curLi = jQuery(".slideTxtBox .hd li").eq(i).attr('value');
			jQuery(".slideTxtBox .bd ul").eq(i).find('iframe').attr('src',curLi);
		}
});
</script>
</html>