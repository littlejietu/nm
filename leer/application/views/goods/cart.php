<?php include_once(APPPATH.'views/publish/head.php') ?>

<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->

<div id="main">
  <div class="container">
    <div class="cart"> 
      <!--payProcess start-->
      <div class="payProcess">
        <div class="payProcess_main cur">
          <h1>1</h1>
          <h2>查看购物车</h2>
        </div> 
        <div class="payProcess_main">
          <div class="payProcess_line"></div>
          <h1>2</h1>
          <h2>填写订单</h2>
        </div>
        <div class="payProcess_main">
          <div class="payProcess_line"></div>
          <h1>3</h1>
          <h2>付款，完成购买</h2>
        </div>
      </div>
      <!--payProcess end-->
      
      <div class="cart_mian">
        <ul class="cart_title">
          <li style="width:142px;">产品</li>
          <li style="width:239px;">产品描述</li>
          <li style="width:281px;">属性</li>
          <li style="width:160px;">数量</li>
          <li style="width:140px;">小计</li>
          <li style="width:134px;">操作</li>
        </ul>
        <?php
            if(!empty($userCartList)){
                foreach($userCartList as $key => $value){
        ?>
        <ul class="cart_list clearfix">
          <li style="width:42px;">
            <input type="checkbox"  name="cartId" class="chkSon" id="actlist<?php echo $key?>" value="actlist" onClick="ChkSonClick('chkSon','action')" rel="<?php echo $value->cart_id?>"/><label class="label1" for="actlist<?php echo $key?>">&nbsp;</label>
          </li>
          <li style="width:100px;">
           <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>"> <img src="<?php echo $value->goods_thumb?>" width="100" height="77"/></a>
          </li>
          <li style="width:219px;padding:0 0 0 20px;">
            <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>"><?php echo $value->goods_name?></a>
            <p style="padding:5px 0 0 0;"><?php echo $value->goods_sn?></p>
          </li>
          <li style="width:281px;">
            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                <?php
                    if(!empty($value->goods_color)){
                ?>
                    <tr><td>颜色：<?php echo $value->goods_color?></td></tr>
                <?php }?>
                <?php
                    if(!empty($value->goods_size)){
                ?>
                    <tr><td>尺码：<?php echo $value->goods_size?></td></tr>
                <?php }?>
                <?php
                    if(!empty($value->goods_sku_key)){
                        $goodsSkuValue              = $value->goods_sku_value;
                        foreach($value->goods_sku_key as $k => $v){
                ?>
              <tr><td><?php echo $v?>：<?php echo $goodsSkuValue[$k]?></td></tr>
                <?php }}?>
            </table>
      
          </li>
          <li style="width:160px;padding:28px 0 0 0;">
            <div class="chooseNum cart_chooseNum">
                <a href="javascript:;" class="chooseNum_jian" onClick="numjian(this,'<?php echo base_url()?>');"></a>
                <input type="text" value="<?php echo $value->goods_num?>" class="chooseNum_text" onKeyUp="num(this,'<?php echo base_url()?>');" maxnum="10"/>
                <a href="javascript:;" class="chooseNum_jia" onClick="numjia(this,'<?php echo base_url()?>');"  maxnum="10"></a>
            </div>
          </li>
          <li style="width:140px;text-align:center;padding:30px 0 0 0;">
            <strong>￥</strong><span class="price" price="<?php echo $value->goods_price?>"><?php echo number_format($value->goods_price * $value->goods_num,2)?></span>
          </li>
          <li style="width:134px;padding:28px 0 0 0;"><a href="javascript:;" onClick="cartDelete(this,0,'<?php echo base_url()?>')" class="cartDelete"></a></li>
        </ul>
        <?php }}?>

        
        <div class="cart_all">
          <div class="cart_all_left fl">
            <input type="checkbox" style="width:1px; height:1px;" name="test"  id="action" value="action" onClick="ChkAllClick('chkSon','action')" />
			<label for="action" class="label">全选</label>
            <a href="javascript:;" class="cart_all_delete fl" onClick="cartDelete(this,1,'<?php echo base_url()?>')">删除</a>
          </div>
          <div class="cart_all_right fr">
            已选商品 <span class="allNum red">0</span> 件&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            商品总金额（不含运费）：<strong class="red">￥</strong><span class="allPrice red">0</span>
          </div>
        </div>
        
        <div class="detialTop_btn fr">
          <a href="<?php echo base_url('/goodsaction/index')?>/" class="goBuy fl">继续购物</a>
            <form action="<?php echo base_url('/orderaction/orderPage')?>" method="post">
                <input type="hidden" name="goOrder_cartId" value="">
                <input type="submit" class="addCart fl" onClick="return cartForm();" value="填写订单" />
            </form>
        </div>
        <div class="clear"></div>

      </div>
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