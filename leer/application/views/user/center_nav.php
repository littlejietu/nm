<div class="centerLeft fl">
      <!--centerLeft_top start-->
      <div class="centerLeft_top">
        <a href="#" class="centerLeft_phone"><img src="<?php if($userInfo->user_image){echo $userInfo->user_image;}else{echo base_url().'resources/img/phone.jpg';}?>" /><div class="phone_layer"></div></a>
        <div class="centerLeft_name"><?php if($userInfo->user_nikename){echo $userInfo->user_nikename;}?></div>
        <div class="centerLeft_set"><a href="<?php echo base_url('/useraction/manage')?>">【编辑资料】</a><span class="centerLeft_set_line"></span><a href="<?php echo base_url('/useraction/logout')?>">【退出】</a></div>
      </div>
      <!--centerLeft_top end-->
      
      <!--centerLeft_nav start-->
      <div class="centerLeft_nav">
        <a href="<?php echo base_url('/useraction/index')?>" class="centerLeft_nav1">我的首页</a>
        <a href="<?php echo base_url('/useraction/manage')?>" class="centerLeft_nav2">资料管理</a>
        <a href="<?php echo base_url('/useraction/safety')?>" class="centerLeft_nav3">安全设置</a>
        <a href="<?php echo base_url('/useraction/address')?>" class="centerLeft_nav4">送货地址</a>
      </div>
      <div class="centerLeft_nav">
        <a href="<?php echo base_url('/orderaction/cart')?>" class="centerLeft_nav5">我的购物车</a>
        <a href="<?php echo base_url('/useraction/userOrder')?>" class="centerLeft_nav6">交易管理</a>
        <a href="<?php echo base_url('/useraction/getCollectList')?>" class="centerLeft_nav7">我的收藏</a>
        <a href="<?php echo base_url('/useraction/myEva')?>" class="centerLeft_nav8">我的评价</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>" class="centerLeft_nav9">我的积分</a>
        <a href="<?php echo base_url('/useraction/muCoupon')?>" class="centerLeft_nav10">我的优惠券</a>
      </div>
      <div class="centerLeft_nav" style="border:none;">
        <a href="<?php echo base_url('/useraction/myshow')?>" class="centerLeft_nav11">秀空间</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>" class="centerLeft_nav12">我的定制</a>
      </div>
      <!--centerLeft_nav end-->
</div>