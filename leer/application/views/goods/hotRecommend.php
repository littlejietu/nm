<div class="middle_second mgt30">
      <div class="middle_top"><div class="middle_title fl"><img src="<?php echo base_url()?>resources/images/title/rmtj_title.jpg" /></div><a href="<?php echo base_url('/isbuildingaction/index')?>" class="more1 fr">MORE+</a></div>
      <div class="middle_new">
	    <div class="hd">
		  <a class="next"></a>
		  <a class="prev"></a>
	    </div>
		<div class="bd">
		  <ul class="picList product">
              <?php
                if(!empty($hotGoods[0])){
                    foreach($hotGoods as $value){
              ?>
                <li><a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>" class="product">
                        <img src="<?php echo empty($value->goods_thumb)?base_url('resources/img/new.jpg'):$value->goods_thumb;?>" />
                        <div class="middle_new_title"><?php echo $value->goods_short_name?></div>
                        <div class="middle_new_price">￥<span><?php echo $value->shop_price_money?></span></div>
                        <div class="middle_new_con" title="<?php echo empty($value->goods_intro)?'':$value->goods_intro?>"><?php echo empty($value->goods_intro)?'':mb_substr($value->goods_intro,0,30,'utf-8')?></div>
                        <dl class="star">
                            <dd <?php if(empty($value->shop_num) or $value->shop_num > 0){echo 'class="cur"';}?>></dd>
                            <dd <?php if(empty($value->shop_num) or $value->shop_num > 1){echo 'class="cur"';}?>></dd>
                            <dd <?php if(empty($value->shop_num) or $value->shop_num > 2){echo 'class="cur"';}?>></dd>
                            <dd <?php if(empty($value->shop_num) or $value->shop_num > 3){echo 'class="cur"';}?>></dd>
                            <dd <?php if(empty($value->shop_num) or $value->shop_num > 4){echo 'class="cur"';}?>></dd>
                        </dl>
                    </a>
                </li>
            <?php }}?>
		  </ul>
		</div>
	  </div>

	  <script type="text/javascript">
	  jQuery(".middle_new").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",vis:5,scroll:5,interTime:4000,delayTime:1000});
	  </script>
    </div>