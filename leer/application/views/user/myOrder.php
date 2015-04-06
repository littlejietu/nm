<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
  <div class="container">
    <!--center_left start-->
    <?php include_once('center_nav.php')?>
    <!--center_left end-->
    
    <!--center_right start-->
    <div class="centerRight fr" id="centerRight">
      <!--centerRight_top start-->
      <?php include_once('center_top.php')?>
      <!--centerRight_top end-->
      
      <!--centerRight_main start-->
      <div class="centerRight_main centerRightBg myOrder" >
      <form>
        <div class="center_title">
          <div class="fl">交易管理</div>
          <div class="center_title_r fr">
            <a href="javascript:;" class="myOrder_all_delete fr" onClick="OrderDelete(this,'<?php echo base_url() ?>',1)">删除</a>
            <input type="checkbox" name="test"  id="action" value="action" onClick="ChkAllClick('chkSon','action')" />
			<label for="action" class="label">全选</label>
            订单提醒：
            <a href="<?php echo base_url()?>/useraction/userOrder/3/<?php echo empty($page)?1:$page?>">已完成<span class="purple">（</span><span class="purple" id="orderState1"><?php echo empty($orderTypeNum3)?0:$orderTypeNum3?></span><span class="purple">）</span></a>&nbsp;&nbsp;
            <a href="<?php echo base_url()?>/useraction/userOrder/1/<?php echo empty($page)?1:$page?>">已付款<span class="purple">（</span><span class="purple" id="orderState2"><?php echo empty($orderTypeNum2)?0:$orderTypeNum2?></span><span class="purple">）</span></a>&nbsp;&nbsp;
            <a href="<?php echo base_url()?>/useraction/userOrder/2/<?php echo empty($page)?1:$page?>">已发货<span class="purple">（</span><span class="purple" id="orderState2"><?php echo empty($orderTypeNum4)?0:$orderTypeNum4?></span><span class="purple">）</span></a>&nbsp;&nbsp;
            <a href="<?php echo base_url()?>/useraction/userOrder/0/<?php echo empty($page)?1:$page?>">待付款<span class="purple">（</span><span class="purple" id="orderState3"><?php echo empty($orderTypeNum1)?0:$orderTypeNum1?></span><span class="purple">）</span></a>
          </div>
        </div>
        <!--center_main start-->
        <div class="center_main">
          <ul class="myOrder_title">
            <li style="width:310px;padding:0 0 0 25px;text-align:left;">产品信息</li>
            <li style="width:118px;">数量</li>
            <li style="width:120px;">单价</li>
            <li style="width:191px;">订单状态</li>
            <li style="width:80px;">操作</li>
          </ul>
            <?php
                if(!empty($orderList[0])){
                    foreach($orderList as $key => $value){
            ?>
                        <?php if($key > 0){?>
            <div class="myOrder_line"></div>
                        <?php }?>
            <div class="myOrder_main">
               <div class="myOrder_main_left fl">
                <?php
                    foreach($value->goodsList as $k => $v){
                ?>
                <ul class="myOrder_list clearfix" >
                    <li style="width:335px;" class="myOrder_info">
                        <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$v->goods_id)?>"> <img src="<?php echo $v->goods_thumb?>" width="100" height="77"/>

                            <div class="myOrder_list_right fl">
                              <h1><?php echo $v->goods_name?></h1>

                              <p style="padding:5px 0 0 0;"><?php echo $v->goods_sn?></p>
                              <div class="myOrder_attr fl">
                                 <div class="clearfix"><div class="fl">颜色：</div><div class="myOrder_color fl" style="background:#<?php echo $v->goods_color?>;"></div><div class="fl">尺寸：<?php echo $v->goods_size?></div></div>
                                 <div class="myOrder_allAttr">
                                     <?php
                                        $goodsSkuKeyArr         = explode(',',$v->goods_sku_key);
                                        $goodsSkuValueArr       = explode(',',$v->goods_sku_value);
                                        foreach($goodsSkuKeyArr as $skuKey => $skuValue){
                                     ?>
                                     <div class="fl"><?php echo $skuValue?>：<?php echo $goodsSkuValueArr[$skuKey]?></div>
                                    <?php }?>
                                 </div>
                              </div>
                            </div>
                        </a>
                    </li>
                    <li style="width:118px;text-align:center;padding:30px 0 0 0;"><?php echo $v->goods_num?></li>
                    <li style="width:120px;text-align:center;padding:30px 0 0 0;">
                        <strong>￥</strong><span class="price"><?php echo number_format($v->goods_price,2)?></span>
                    </li>
                    
                </ul>
                <?php }?>
                </div>
                <ul class="myOrder_main_right fl">
                    <li style="width:190px;text-align:center;padding:25px 0 0 0;" class="myOrder_state">
                        <?php
                        switch ($value->order_type) {
                            case 0:
                                echo '<a href="' . base_url('/orderaction/payPage/' . $value->order_id) . '" class="myOrder_ddfh">我要付款</a>';
                                break;
                            case 1:
                                echo '<a href="javascript:;" class="myOrder_ddfh">等待发货</a>';
                                break;
                            case 2:
                        ?>
                            <a href="javascript:;" onclick="javascript:if(confirm('请确保您收到货物之后点击！')){receiveGoods(<?php echo $value->order_id ?>,'<?php echo base_url(); ?>');}" class="myOrder_ddfh">确认收货<div class="logistics">正在加载物流信息......</div></a>
                        <?php
                                break;
                            case 3:
                                echo '<a href="javascript:;" class="myOrder_jywc">交易完成</a>';
                                break;
                            case 8:
                                echo '<a href="javascript:;" class="myOrder_jywc">交易完成</a>';
                                break;
                            default:
                                echo '<a href="javascript:;" class="myOrder_jywc">交易完成</a>';
                        }
                        ?>
                    </li>

                    <li style="width:80px;padding:28px 0 0 0;">
                        <a href="javascript:;" class="cartDelete" onClick="OrderDelete(this,'<?php echo base_url() ?>',0)"></a>
                    </li>
                </ul>
                <div class="clear"></div>
                <div class="myOrder_bottom">
                    <input type="checkbox" name="orderId" class="chkSon" id="actlist<?php echo $key?>" value="actlist<?php echo $key?>" onClick="ChkSonClick('chkSon','action')" rel="<?php echo $value->order_id ?>"/><label class="label1" for="actlist<?php echo $key?>">&nbsp;</label>
                    订单编号：<?php echo $value->order_sn?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下单时间：<?php echo date('Y/m/d H:i:s',$value->add_time)?>
                </div>
            </div>
            <?php }}?>

          <div class="page mgt40 clearfix fr">
            <?php echo $pageHtml?>
          </div> 
          <div class="clear"></div>
        </div>
        <!--center_main end-->
      </form>
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