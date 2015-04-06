<?php include_once('publish/head.php') ?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once('publish/header.php') ?>
<!--header end-->
<div id="slideBox" class="banner">
    <div class="bd">
        <ul>
            <li><a href="<?php echo base_url('/isbuildingaction/index')?>"><img src="<?php echo base_url()?>resources/img/banner6.jpg" /></a></li>
            <li><a href="<?php echo base_url('/isbuildingaction/index')?>"><img src="<?php echo base_url()?>resources/img/banner7.jpg" /></a></li>
            <li><a href="<?php echo base_url('/isbuildingaction/index')?>"><img src="<?php echo base_url()?>resources/img/banner8.jpg" /></a></li>
        </ul>
    </div>
</div>
<script type="text/javascript">
jQuery("#slideBox").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,interTime:3000});
</script>
<div class="container prgB82">
  <!--新品发布 start-->
  <div class="shopNew">
    <div class="shopNew_top">
      <div class="shopNew_top_title fl">新品发布</div>
      <div class="shopNew_top_type fl">
        <a href="<?php echo base_url()?>/goodsaction/index/3">T恤</a>
        <div class="shopNew_top_line"></div>
        <a href="<?php echo base_url()?>/goodsaction/index/4">POLO</a>
        <div class="shopNew_top_line"></div>
        <a href="<?php echo base_url()?>/goodsaction/index/5">绒衫</a>
        <div class="shopNew_top_line"></div>
        <a href="<?php echo base_url()?>/goodsaction/index/6">移动电源</a>
        <div class="shopNew_top_line"></div>
        <a href="<?php echo base_url()?>/goodsaction/index/12">布袋</a>
        <div class="shopNew_top_line"></div>
        <a href="<?php echo base_url()?>/goodsaction/index/8">生活百货</a>
      </div>
      <a href="#" class="shopNew_top_more fr">更多&nbsp;&nbsp;&gt;</a>
    </div>
    <div class="shopNew_main clearfix">
      <a href="#"><img src="<?php echo base_url()?>resources/img/new1.jpg" width="370" height="370"/></a>
      <a href="#"><img src="<?php echo base_url()?>resources/img/new2.jpg" width="370" height="370"/></a>
      <a href="#"><img src="<?php echo base_url()?>resources/img/new3.jpg" width="370" height="370"/></a>
      <a href="#"><img src="<?php echo base_url()?>resources/img/new4.jpg" width="565" height="280"/></a>
      <a href="#"><img src="<?php echo base_url()?>resources/img/new5.jpg" width="565" height="280"/></a>
    </div>
  </div>
  <!--新品发布 end-->
  
  <!--热卖推荐 start-->
  <div class="shopHot">
    <div class="shopNew_top">
      <div class="shopNew_top_title fl">热卖推荐</div>
      <a href="#" class="shopNew_top_more fr">更多&nbsp;&nbsp;&gt;</a>
    </div>
    <div class="shopHot_main clearfix">
      <?php
      if(!empty($rmdGoods)){
      foreach($rmdGoods as $key => $value){?>
      <div class="shopHot_path">
        <a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>">
          <div class="shopHot_img"><img src="<?php echo $value->goods_thumb?>" /></div>
          <div class="shopHot_title"><?php echo $value->goods_short_name?></div>
          <div class="shopHot_con"><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span>销售量：<span><?php echo $value->goods_sell_num?></span></div>
         </a>
      </div>
      <?php }}?>
    </div>
  </div>
  <!--热卖推荐 end-->
  
  <!--楼层T-恤 start-->
  <div class="shopFloor">
    <div class="shopFloor_left fl">
      <div class="shopFloor_num"></div>
      <div class="shopFloor_left_main">
        <h1>推荐品牌</h1>
        <div class="shopFloor_brand">
			<div class="hd">
				<a class="next"></a>
				<ul></ul>
				<a class="prev"></a>
				<span class="pageState"></span>
			</div>
			<div class="bd">
				<ul class="picList">
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand3.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand1.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
				</ul>
			</div>
		</div>

		<script type="text/javascript">
		jQuery(".shopFloor_brand").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",vis:1});
		</script>
      </div>
    </div>
    <div class="shopFloor_banner fl"><img src="<?php echo base_url()?>resources/img/floor1Adv.jpg" /></div>
    <div class="shopFloor_right fl">
        <?php
        if(!empty($tshirtList)){
            foreach($tshirtList as $key=>$value){?>
                <a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name?></h1>
                        <h2><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span></h2>
                        <img src="<?php echo $value->goods_thumb?>" />
                    </div>
                </a>
            <?php }}?>
    </div>
  </div>
  <!--楼层 end-->
  
  <!--楼层POLO start-->
  <div class="shopFloor">
    <div class="shopFloor_left fl">
      <div class="shopFloor_num shopFloor_num1"></div>
      <div class="shopFloor_left_main">
        <h1>推荐品牌</h1>
        <div class="shopFloor_brand">
			<div class="hd">
				<a class="next"></a>
				<ul></ul>
				<a class="prev"></a>
				<span class="pageState"></span>
			</div>
			<div class="bd">
				<ul class="picList">
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand3.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand1.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
				</ul>
			</div>
		</div>

		<script type="text/javascript">
		jQuery(".shopFloor_brand").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",vis:1});
		</script>
      </div>
    </div>
    <div class="shopFloor_banner fl"><img src="<?php echo base_url()?>resources/img/floor2Adv.jpg" /></div>
    <div class="shopFloor_right fl">
        <?php
        if(!empty($polpList)){
            foreach($polpList as $key=>$value){?>
                <a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name?></h1>
                        <h2><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span></h2>
                        <img src="<?php echo $value->goods_thumb?>" />
                    </div>
                </a>
            <?php }}?>
    </div>
  </div>
  <!--楼层 end-->
  
  <!--楼层冒衫 start-->
  <div class="shopFloor">
    <div class="shopFloor_left fl">
      <div class="shopFloor_num shopFloor_num2"></div>
      <div class="shopFloor_left_main">
        <h1>推荐品牌</h1>
        <div class="shopFloor_brand">
			<div class="hd">
				<a class="next"></a>
				<ul></ul>
				<a class="prev"></a>
				<span class="pageState"></span>
			</div>
			<div class="bd">
				<ul class="picList">
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand3.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand1.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
				</ul>
			</div>
		</div>

		<script type="text/javascript">
		jQuery(".shopFloor_brand").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",vis:1});
		</script>
      </div>
    </div>
    <div class="shopFloor_banner fl"><img src="<?php echo base_url()?>resources/img/floor3Adv.jpg" /></div>
    <div class="shopFloor_right fl">
        <?php
        if(!empty($fleeceList)){
            foreach($fleeceList as $key=>$value){?>
                <a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name?></h1>
                        <h2><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span></h2>
                        <img src="<?php echo $value->goods_thumb?>" />
                    </div>
                </a>
            <?php }}?>
    </div>
  </div>
  <!--楼层 end-->
  
  <!--楼层移动电源 start-->
  <div class="shopFloor">
    <div class="shopFloor_left fl">
      <div class="shopFloor_num shopFloor_num3"></div>
      <div class="shopFloor_left_main">
        <h1>推荐品牌</h1>
        <div class="shopFloor_brand">
			<div class="hd">
				<a class="next"></a>
				<ul></ul>
				<a class="prev"></a>
				<span class="pageState"></span>
			</div>
			<div class="bd">
				<ul class="picList">
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand3.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand1.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
				</ul>
			</div>
		</div>

		<script type="text/javascript">
		jQuery(".shopFloor_brand").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",vis:1});
		</script>
      </div>
    </div>
    <div class="shopFloor_banner fl"><img src="<?php echo base_url()?>resources/img/floor4Adv.jpg" /></div>
    <div class="shopFloor_right fl">
        <?php
        if(!empty($mobileList)){
            foreach($mobileList as $key=>$value){?>
                <a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name?></h1>
                        <h2><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span></h2>
                        <img src="<?php echo $value->goods_thumb?>" />
                    </div>
                </a>
            <?php }}?>
    </div>
  </div>
  <!--楼层 end-->
  
  <!--楼层布袋 start-->
  <div class="shopFloor">
    <div class="shopFloor_left fl">
      <div class="shopFloor_num shopFloor_num4"></div>
      <div class="shopFloor_left_main">
        <h1>推荐品牌</h1>
        <div class="shopFloor_brand">
			<div class="hd">
				<a class="next"></a>
				<ul></ul>
				<a class="prev"></a>
				<span class="pageState"></span>
			</div>
			<div class="bd">
				<ul class="picList">
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand3.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand1.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
				</ul>
			</div>
		</div>

		<script type="text/javascript">
		jQuery(".shopFloor_brand").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",vis:1});
		</script>
      </div>
    </div>
    <div class="shopFloor_banner fl"><img src="<?php echo base_url()?>resources/img/floor5Adv.jpg" /></div>
    <div class="shopFloor_right fl">
        <?php
        if(!empty($bagList)){
            foreach($bagList as $key=>$value){?>
                <a href="#">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name?></h1>
                        <h2><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span></h2>
                        <img src="<?php echo $value->goods_thumb?>" />
                    </div>
                </a>
            <?php }}?>
    </div>
  </div>
  <!--楼层 end-->
  
  <!--楼层生活百货 start-->
  <div class="shopFloor">
    <div class="shopFloor_left fl">
      <div class="shopFloor_num shopFloor_num5"></div>
      <div class="shopFloor_left_main">
        <h1>推荐品牌</h1>
        <div class="shopFloor_brand">
			<div class="hd">
				<a class="next"></a>
				<ul></ul>
				<a class="prev"></a>
				<span class="pageState"></span>
			</div>
			<div class="bd">
				<ul class="picList">
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand3.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
					<li>
					  <a href="#"><img src="<?php echo base_url()?>resources/img/brand.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand1.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
                      <a href="#"><img src="<?php echo base_url()?>resources/img/brand2.jpg" /></a>
					</li>
				</ul>
			</div>
		</div>

		<script type="text/javascript">
		jQuery(".shopFloor_brand").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",vis:1});
		</script>
      </div>
    </div>
    <div class="shopFloor_banner fl"><img src="<?php echo base_url()?>resources/img/floor6Adv.jpg" /></div>
    <div class="shopFloor_right fl">
        <?php
        if(!empty($livingList)){
            foreach($livingList as $key=>$value){?>
                <a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name?></h1>
                        <h2><span class="red15">￥</span><span class="red19"><?php echo $value->shop_price_money?></span></h2>
                        <img src="<?php echo $value->goods_thumb?>" />
                    </div>
                </a>
            <?php }}?>
    </div>
  </div>
  <!--楼层 end-->
</div>

<!--footer start-->
<?php include_once('publish/footer.php') ?>
<!--footer end-->


</body>
</html>