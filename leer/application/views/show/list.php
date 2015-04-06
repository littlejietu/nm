<?php include_once(APPPATH.'views/publish/head.php') ?>

<body style="background:#ececec;">
<input type="hidden" value="<?php echo base_url()?>" id="bacsUrl"/>
<input type="hidden" value="<?php echo $hottype ?>" id="hottype"/>
<div class="showBg"></div>
<div class="showList_header">
  <div class="container">
    <a href="#" class="show_logo fl"></a>
    <ul class="show_nav fr">
      <li class="<?php echo empty($hottype)|| $hottype==0?'cur':''?>"><a href="<?php echo base_url().'/showaction/showIndex/0/1'?>">最新</a></li>
      <li class="show_nav_line"></li>
      <li class="<?php echo !empty($hottype)&& $hottype==1?'cur':''?>"><a href="<?php echo base_url().'/showaction/showIndex/1/1'?>">最热门</a></li>
      <li class="show_nav_line"></li>
      <li><a href="<?php echo base_url()?>">返回主站</a></li>
    </ul>
  </div>
</div>
<div class="showTop"></div>
<div class="showList">
  <div class="container">
      <?php if($hottype==0){?>
    <div class="showList_top"> </div>
        <?php }else{ ?>
   <div class="showList_top1"></div>
      <?php } ?>
    <div class="showList_main clearfix">
      <?php foreach($showList as $k => $v){?>
      <div class="showList_path">
        <a href="<?php echo base_url().'/showaction/getDetail/'.$hottype.'/'.$v->pre_id ?>" class="showList_img"><img src="<?php echo $v->pre_img ?>" /></a>
        <div class="showList_con"><a onClick="showlike(this,'<?php echo $v->pre_id?>','<?php echo base_url()?>')" href="javascript:;" class="show_like"><?php echo $v->pre_likes ?></a><div class="show_pl"><?php echo $v->pre_comment ?></div></div>
      </div>
      <?php }?>
    </div>
  </div>
</div>

</body>
</html>