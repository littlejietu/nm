<?php include_once(APPPATH.'views/publish/head.php') ?>

<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->

<div id="main">
  <div class="container">
    <div class="payment"> 
      <!--payProcess start-->
      <div class="payProcess">
        <div class="payProcess_main over">
          <h1></h1>
          <h2>查看购物车</h2>
        </div> 
        <div class="payProcess_main over">
          <div class="payProcess_line"></div>
          <h1></h1>
          <h2>填写订单</h2>
        </div>
        <div class="payProcess_main cur">
          <div class="payProcess_line"></div>
          <h1>3</h1>
          <h2>付款，完成购买</h2>
        </div>
      </div>
      <!--payProcess end-->
      <form name="alipayment" action="<?php echo base_url().'/alipay/alipayapi'?>" method="post" target="_blank">
          <input type="hidden" size="30" name="WIDseller_email" value="yangjun@c2mmall.com" />
          <input type="hidden" size="30" name="WIDout_trade_no"  value="<?php echo empty($orderInfo)?'':$orderInfo->order_sn?>" />
          <input type="hidden" size="30" name="WIDsubject" value="商城产品" />
          <input type="" size="30" name="WIDprice" value="<?php echo empty($orderInfo)?'':$orderInfo->order_price?>" />
          <input type="hidden" size="30" name="WIDbody" value="产品A001描述" />
          <input type="hidden" size="30" name="WIDshow_url" value="" />

          <input type="hidden" size="30" name="WIDreceive_name" value="<?php echo (empty($orderInfo) or empty($orderInfo->userAddressInfo))?'':$orderInfo->userAddressInfo->user_real_name?>" />
          <input type="hidden" size="30" name="WIDreceive_address" value="<?php echo (empty($orderInfo) or empty($orderInfo->userAddressInfo))?'':$orderInfo->userAddressInfo->province.'省'.$orderInfo->userAddressInfo->city.$orderInfo->userAddressInfo->area.$orderInfo->userAddressInfo->address?>" />
          <input type="hidden" size="30" name="WIDreceive_zip" value="<?php echo (empty($orderInfo) or empty($orderInfo->userAddressInfo))?'':$orderInfo->userAddressInfo->email_code?>" />
          <input type="hidden" size="30" name="WIDreceive_phone" value="<?php echo (empty($orderInfo) or empty($orderInfo->userAddressInfo))?'':$orderInfo->userAddressInfo->user_phone?>" />
          <input type="hidden" size="30" name="WIDreceive_mobile" value="<?php echo (empty($orderInfo) or empty($orderInfo->userAddressInfo))?'':$orderInfo->userAddressInfo->user_tel?>" />
      <div class="payment_main">
        <div class="payment_top">订单已提交成功，请尽快完成在线支付！</div>
        <div class="payment_list">
          <input type="radio"  name="bank" id="bank1" value="" checked /><label for="bank1"><img src="<?php echo base_url()?>resources/images/bank/zfb.jpg" /></label>
           <div class="clear"></div><br />
<!--          <input type="radio"  name="bank" id="bank2" value="" /><label for="bank2"><img src="--><?php //echo base_url()?><!--resources/images/bank/ny.jpg" /></label>-->
<!--          <input type="radio"  name="bank" id="bank3" value="" /><label for="bank3"><img src="--><?php //echo base_url()?><!--resources/images/bank/gs.jpg" /></label>-->
<!--          <input type="radio"  name="bank" id="bank4" value="" /><label for="bank4"><img src="--><?php //echo base_url()?><!--resources/images/bank/yz.jpg" /></label>-->
<!--          <input type="radio"  name="bank" id="bank5" value="" /><label for="bank5"><img src="--><?php //echo base_url()?><!--resources/images/bank/js.jpg" /></label>-->
<!--          <div class="clear"></div>-->
        </div>
        <button type="submit" class="order_btn mgt28" onclick="tipsPop({title:'请您在新打开的页面完成支付！',content:'支付完成前请不要关闭此窗口。完成后，请选择：',buttons:{'支付成功':'urlTips(\'<?php echo base_url()?>/useraction/userOrder\')','支付失败':'closePop()'}})">确认支付</button>
      </div>
      </form>
    </div>
    
    <!--middle_second start-->
    <?php include_once('hotRecommend.php') ?>
    <!--middle_second end-->
  </div>
</div>


<!--footer start-->
<?php include_once(APPPATH.'views/publish/footer.php') ?>
<!--footer end-->
</body>
</html>