<div class="middle_second hotRecommon">
      <div class="middle_top">热门推荐</div> 
      <div class="middle_new">
	    <div class="hd">
          <a class="prev"></a>
		  <a class="next"></a>
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
                              <dl class="star purple_star">
                                  <dd <?php if(empty($value->shop_num) or $value->shop > 0){echo 'class="cur"';}?>></dd>
                                  <dd <?php if(empty($value->shop_num) or $value->shop > 1){echo 'class="cur"';}?>></dd>
                                  <dd <?php if(empty($value->shop_num) or $value->shop > 2){echo 'class="cur"';}?>></dd>
                                  <dd <?php if(empty($value->shop_num) or $value->shop > 3){echo 'class="cur"';}?>></dd>
                                  <dd <?php if(empty($value->shop_num) or $value->shop > 4){echo 'class="cur"';}?>></dd>
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