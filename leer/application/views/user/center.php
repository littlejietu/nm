<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
  <div class="container">
    <!--center_left start-->
    <?php include_once('center_nav.php')?>
    <!--center_left end-->
    
    <!--center_right start-->
    <div class="centerRight fr">
      <!--centerRight_top start-->
      <?php include_once('center_top.php')?>
      <!--centerRight_top end-->
      
      <!--centerRight_main start-->
      <div class="centerRight_main">
        <!--centerRight_left start-->
        <div class="centerRight_left fl">
          <!--centerRight_left_mes start-->
          <div class="centerRight_left_mes">
            <ul class="centerRight_left_mes_top">
              <li class="centerRight_left_name"><?php if($userInfo->user_nikename){echo $userInfo->user_nikename;}?></li>
              <li class="centerRight_left_time alignLeft">上一次登录时间：<?php if($userInfo->last_login){echo date('Y-m-d H:i:s',$userInfo->last_login);}?></li>
              <li class="centerRight_left_jf"><a href="#">积分余额：<strong><?php if($userInfo->user_integral){echo $userInfo->user_integral;}else{echo 0;}?></strong> 点</a></li>
              <li class="alignLeft"><a href="<?php echo(base_url().'/useraction/getCollectList') ?>" class="centerRight_left_sc">我的收藏<strong>（<?php echo($collectOrderNum)?>）</strong></a><a href="<?php echo base_url()?>/useraction/userOrder/<?php echo empty($page)?1:$page?>/0">待付款<strong>（<?php echo empty($orderTypeNum1)?0:$orderTypeNum1?>）</strong></a></li>
            </ul>
            
            <!--centerRight_left_add start-->
            <div class="centerRight_left_add">
              <h1>收货地址：</h1>
                <?php
                    if(empty($userDefaultAddress)){
                        echo '<p>无地址</p>';
                    }else{
                ?>
              <p><?php echo empty($userDefaultAddress)?'':$userDefaultAddress->province?>省 <?php echo empty($userDefaultAddress)?'':$userDefaultAddress->city?> <?php echo empty($userDefaultAddress)?'':$userDefaultAddress->area?> <?php echo empty($userDefaultAddress)?'':$userDefaultAddress->address?></p>
              <p><?php echo empty($userDefaultAddress)?'':$userDefaultAddress->user_real_name?> 收</p>
                <?php }?>
              <a href="<?php echo base_url('/useraction/address')?>" class="centerRight_left_add_btn">管理收货地址</a>
              <div class="centerRight_left_email">邮箱：<?php if($userInfo->user_mail){echo $userInfo->user_mail;}?></div>
              <div class="centerRight_left_email centerRight_left_tel">电话：<?php if($userInfo->user_tel){echo $userInfo->user_tel;}?></div>
            </div>
            <!--centerRight_left_add end-->
          </div>
          <!--centerRight_left_mes end-->
          
          <!--centerRight_left_img start-->
          <div id="vertical3" class="scrollbox3 clearfix">
  			<div class="slyWrap3 example2">
   			  <div class="scrollbar3">
        		<div class="handle"></div>
    		  </div>
   		     <div class="sly3" data-options='{ "scrollBy": 100, "startAt": 0 }'>
               <div>
                 <?php for($i=0;$i<4;$i++) {?>
                 <a href="#"><img src="<?php echo base_url()?>resources/img/centerimg1.jpg" width="206" height="163"/></a>
           	     <a href="#"><img src="<?php echo base_url()?>resources/img/centerimg2.jpg" width="165" height="163"/></a>
            	 <a href="#"><img src="<?php echo base_url()?>resources/img/centerimg3.jpg" width="165" height="163"/></a>
            	 <a href="#"><img src="<?php echo base_url()?>resources/img/centerimg4.jpg" width="206" height="191"/></a>
            	 <a href="#"><img src="<?php echo base_url()?>resources/img/centerimg5.jpg" width="330" height="191"/></a>
                 <?php }?>
          	   </div>
    	      </div>
            </div><!--slyWrap-->
          </div>
          <!--centerRight_left_img end-->
          
        </div>
        <!--centerRight_left end-->
        
        <!--centerRight_right start-->
        <div class="centerRight_right fr">
          <div class="centerRight_right_top"><h1 class="fl">我的购物车</h1><div class="centerRight_num fr"><?php echo empty($userCartListNum)?0:$userCartListNum?></div></div>
          <div class="centerRight_right_main">
			<div class="bd">
				<ul class="picList">
                    <?php
                        if(!empty($userCartList[0])){
                            foreach($userCartList as $value){
                    ?>
					<li>
					  <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>" class="centerRight_right_cart_img fl"><img src="<?php echo $value->goods_thumb?>" /></a>
             		  <div class="centerRight_right_cart_con fr">
                	    <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>" class="centerRight_right_cart_title"><?php echo $value->goods_name?></a>
                	    <div class="centerRight_right_cart_attr"><?php
                            if(!empty($value->goods_color)){
                                ?>
                                颜色分类：<?php echo $value->goods_color?>
                            <?php }?>
                            <?php
                            if(!empty($value->goods_size)){
                                ?>
                                尺码：<?php echo $value->goods_size?>
                            <?php }?>
                        </div>
                	    <div class="centerRight_right_cart_cz">
                          <div class="centerRight_right_car_money fl"><?php echo $value->goods_num?>×<strong>￥</strong><span><?php echo number_format($value->goods_price,2)?></span></div>
                  		  <a href="javascript:;" class="centerRight_right_car_det fr" onClick="centerCartDelete(this,'<?php echo $value->cart_id?>','<?php echo base_url()?>')" ><div class="centerRight_right_car_detTip" >删除</div></a>
                	    </div>
                      </div>
					</li>
					 <?php }}?>
				</ul>
			</div>
            <div class="hd">
                <a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>

		<script type="text/javascript">
		 jQuery(".centerRight_right_main").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:false,vis:4,scroll:4,trigger:"click",delayTime:1000,interTime:4000});
		</script>

        </div>
        <!--centerRight_right end-->
        <div clas="clear"></div>
      </div>
      <!--centerRight_main end-->
    </div>
    <!--center_right end-->
    <div class="clear"></div>
    
    <!--middle_second start-->
    <?php include_once('recommend.php')?>
    <!--middle_second end-->
  </div>
  
  
  
</div>


</body>
</html>