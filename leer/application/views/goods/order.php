<?php include_once(APPPATH.'views/publish/head.php') ?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->

<div id="main">
  <div class="container">
    <div class="order"> 
      <!--payProcess start-->
      <div class="payProcess">
        <div class="payProcess_main over">
          <h1></h1>
          <h2>查看购物车</h2>
        </div> 
        <div class="payProcess_main cur">
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
      
      <div class="order_main">
        <!--order_left start-->
        <div class="order_left fl">
          <div class="order_top">
            <h1>收货地址</h1>
            <h2>请输入详细的收获地址，以保证物件及时到达！</h2>
          </div>
          <div class="order_address">
              <?php
              if(!empty($addressList[0])){
                  $defaultAddress       = '';
              foreach($addressList as $key =>  $value){
                  if($value->is_default){
                      $defaultAddress       = $value->address_id;
              ?>
            <!--order_address_selected start-->
            <div class="order_address_selected mgb20">
              <div class="addressInfo_top" rel="<?php echo $value->address_id?>" provinceId="<?php echo $value->provinceId?>"><?php echo $value->province?>省 <?php echo $value->city?> <?php echo $value->area?>&nbsp;&nbsp;<span class="red">(<?php echo $value->user_real_name?>收)</span></div>
               <div class="addressInfo_main">
                   <?php echo $value->address?>&nbsp;&nbsp;<?php echo $value->user_tel?> <?php echo $value->user_phone?>
               </div>
               <a href="<?php echo base_url('/orderaction/orderPage/'.(empty($cartId)?'':$cartId)).'/'.$value->address_id?>" class="changeAddress red">[修改本地址]</a>
            </div>
            <!--order_address_selected start-->
              <?php
                      unset($addressList[$key]);
                  }
              }
              }?>

              <?php
                if(empty($defaultAddress) && !empty($addressList[0])){
                    $defaultAddress     = $addressList[0]->address_id;
              ?>
                    <!--order_address_selected start-->
                    <div class="order_address_selected mgb20">
                        <div class="addressInfo_top" rel="<?php echo $value->address_id?>" provinceId="<?php echo $value->provinceId?>"><?php echo $addressList[0]->province?>省 <?php echo $addressList[0]->city?> <?php echo $addressList[0]->area?>&nbsp;&nbsp;<span class="red">(<?php echo $addressList[0]->user_real_name?>收)</span></div>
                        <div class="addressInfo_main">
                            <?php echo $addressList[0]->address?>&nbsp;&nbsp;<?php echo $addressList[0]->user_tel?> <?php echo $addressList[0]->user_phone?>
                        </div>
                        <a href="<?php echo base_url('/orderaction/orderPage/'.(empty($cartId)?'':$cartId)).'/'.$addressList[0]->address_id ?>" class="changeAddress red">[修改本地址]</a>
                    </div>
                    <!--order_address_selected start-->
              <?php
                unset($addressList[0]);
                }?>
              <?php
              foreach($addressList as $value){
              ?>
            <div class="order_address_list mgb20">
              <a href="javascript:;" class="order_address_list_check fl" onClick="selectAddress(this);"></a>
              <div class="order_address_list_main fl">
                <div class="addressInfo_main"><?php echo $value->address?>&nbsp;&nbsp;<?php echo $value->user_tel?> <?php echo $value->user_phone?></div>
                  <div class="addressInfo_top" rel="<?php echo $value->address_id?>" provinceId="<?php echo $value->provinceId?>"><?php echo $value->province?>省 <?php echo $value->city?> <?php echo $value->area?>&nbsp;&nbsp;<span class="red">(<?php echo $value->user_real_name?>收)</span></div>
                  <a href="<?php echo base_url('/orderaction/orderPage/'.(empty($cartId)?'':$cartId)).'/'.$value->address_id ?>" class="changeAddress red">[修改本地址]</a>
              </div>
              <a href="javascript:;" class="order_address_list_xl fr"></a>
            </div>
              <?php }?>
            
            
          </div>
          
          <a href="javascript:;" class="addAddress" id="addAddress">添加新地址</a>

            <div id="addressForm" <?php if(!empty($addressInfo)){echo 'style="display:block"';}?>>
                <form action="<?php echo base_url('/useraction/addEditAddress/'.(empty($cartId)?'':$cartId))?>" method="post">
                    <input name="act" value="<?php if(!empty($addressInfo)){echo 'edit';}else{echo 'add';}?>" type="hidden">
                    <?php if(!empty($addressId)){?>
                        <input name="addressId" value="<?php echo $addressId;?>" type="hidden">
                    <?php }?>
                    <table cellpadding="0" cellspacing="0" class="centerTable">
                        <tr height="58" style="position:relative;z-index:40;">
                            <td width="78" valign="top"><font>所在地区 <span class="red">*</span></font></td>
                            <td style="position:relative;z-index:40;"><div id="sjld">
                                    <div class="m_zlxg" id="shenfen">
                                        <p title="<?php if(!empty($addressInfo) && $addressInfo->province){echo $addressInfo->province;}?>"><?php if(!empty($addressInfo) && $addressInfo->province){echo $addressInfo->province;}?></p>
                                        <div class="m_zlxg2">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m_zlxg" id="chengshi">
                                        <p title="<?php if(!empty($addressInfo) && $addressInfo->city){echo $addressInfo->city;}?>"><?php if(!empty($addressInfo) && $addressInfo->city){echo $addressInfo->city;}?></p>
                                        <div class="m_zlxg2">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m_zlxg" id="quyu">
                                        <p title="<?php if(!empty($addressInfo) && $addressInfo->area){echo $addressInfo->area;}?>"><?php if(!empty($addressInfo) && $addressInfo->area){echo $addressInfo->area;}?></p>
                                        <div class="m_zlxg2">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>

                                    <input id="sfdq_num" type="hidden" value="" />
                                    <input id="csdq_num" type="hidden" value="" />
                                    <input id="sfdq_tj"  name="province" type="hidden" value="<?php if(!empty($addressInfo) && $addressInfo->province){echo $addressInfo->province;}?>" />
                                    <input id="csdq_tj"  name="city" type="hidden" value="<?php if(!empty($addressInfo) && $addressInfo->city){echo $addressInfo->city;}?>" />
                                    <input id="qydq_tj"  name="quyu" type="hidden" value="<?php if(!empty($addressInfo) && $addressInfo->area){echo $addressInfo->area;}?>" />
                                </div>
                            </td>
                        </tr>
                        <tr height="139">
                            <td width="78" valign="top"><font>详细地址 <span class="red">*</span></font></td>
                            <td><textarea name="address" class="centerArea fl" onBlur="blurText(this,'不需要重复写省市区，必须大于5个字符')" onFocus="focusText(this,'不需要重复写省市区，必须大于5个字符')" id="add" onKeyUp="keyupText(this)"><?php if(!empty($addressInfo) && $addressInfo->address){echo $addressInfo->address;}else{echo '不需要重复写省市区，必须大于5个字符';}?></textarea><div class="tips black_tips fl"><span></span></div></td>
                        </tr>
                        <tr height="58">
                            <td width="72" valign="top"><font>邮政编码  <span class="red">*</span></font></td>
                            <td><input name="email_code" type="text" value="<?php if(!empty($addressInfo) && $addressInfo->email_code){echo $addressInfo->email_code;}?>" class="centerText fl" id="zip" style="width:388px;" onKeyUp="keyupText(this)"/>
                                <div class="tips black_tips fl"><span></span></div></td>
                        </tr>
                        <tr height="58">
                            <td width="72" valign="top"><font>收货人  <span class="red">*</span></font></td>
                            <td><input type="text" name="user_real_name" value="<?php if(!empty($addressInfo) && $addressInfo->user_real_name){echo $addressInfo->user_real_name;}else{echo '长度不超过25个字符';}?>" class="centerText  nofocus fl" onBlur="blurText(this,'长度不超过25个字符')" onFocus="focusText(this,'长度不超过25个字符')" id="name" style="width:388px;" onKeyUp="keyupText(this)"/>
                                <div class="tips black_tips fl"><span></span></div></td>
                        </tr>
                        <tr height="58">
                            <td width="72" valign="top"><font>手机号码</font></td>
                            <td><input type="text" name="user_tel" value="<?php if(!empty($addressInfo) && $addressInfo->user_tel){echo $addressInfo->user_tel;}else{echo '电话号码、手机号码必须填一项';}?>" class="centerText  nofocus fl" onBlur="blurText(this,'电话号码、手机号码必须填一项')" onFocus="focusText(this,'电话号码、手机号码必须填一项')" id="phone" style="width:388px;" onKeyUp="keyupText(this)"/>
                                <div class="tips black_tips fl"><span></span></div></td>
                        </tr>
                        <tr height="58">
                            <td width="72" valign="top"><font>电话号码 </font></td>
                            <td><input type="text" name="user_phone_1" value="<?php if(!empty($addressInfo) && $addressInfo->user_phone){echo $addressInfo->user_phone1;}else{echo '区号';}?>" class="centerText nofocus fl" onBlur="blurText(this,'区号')" onFocus="focusText(this,'区号')" id="quhao" style="width:97px;" onKeyUp="keyupText(this)"/>
                                <div class="fl tel_line">-</div>
                                <input type="text" name="user_phone_2" value="<?php if(!empty($addressInfo) && $addressInfo->user_phone){echo $addressInfo->user_phone2;}else{echo '电话号码';}?>" class="centerText nofocus fl" onBlur="blurText(this,'电话号码')" onFocus="focusText(this,'电话号码')" id="dianhua" style="width:97px;" onKeyUp="keyupText(this)"/>
                                <div class="fl tel_line">-</div>
                                <input type="text" name="user_phone_3" value="<?php if(!empty($addressInfo) && $addressInfo->user_phone){echo $addressInfo->user_phone3;}else{echo '分机';}?>" class="centerText nofocus fl" onBlur="blurText(this,'分机')" onFocus="focusText(this,'分机')" id="fenji" style="width:97px;" onKeyUp="keyupText(this)"/>
                                <div class="tips black_tips fl"><span></span></div></td>
                        </tr>
                        <tr height="42">
                            <td></td>
                            <td><div class="defaultAdd"><input type="checkbox" <?php if(!empty($addressInfo) && $addressInfo->is_default){echo 'checked="checked"';}?> name="is_default" id="defaultAdd" value="1" /><label for="defaultAdd">设置为默认收货地址</label></div></td></td>
                        </tr>
                        <tr><td></td><td><input type="submit" class="centerBtn" value="保 存" onClick="return addressForm();"/></td></tr>
                    </table>
                </form>
            </div>
        </div>
        <!--order_left end-->
        <form action="<?php echo base_url('/orderaction/addOrder')?>" method="post" onSubmit="submitonce(this);">
        <!--order_right start-->
            <div class="order_right fr">
              <div class="order_top">
                <h1>确认订单信息</h1>
                <h2>请确认每一个商品的信息，以防收货之后不必要的麻烦！</h2>
              </div>
              <div class="order_goods_list">

                  <?php
                    if(!empty($cartList)){
                        $tempAllMoney       = 0;
                        $cartIds            = array();
                        foreach($cartList as $value){
                            $tempAllMoney       += (float)$value->all_price;
                            $cartIds[]      = $value->cart_id;
                  ?>

                <div class="order_goods" goods_weight="<?php echo $value->goods_weight?>" goods_num="<?php echo $value->goods_num?>">
                  <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>" class="order_goods_img fl"><img src="<?php echo $value->goods_thumb?>" /></a>
                  <div class="order_goods_mes fr">
                    <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>" class="order_goods_mes_title"><?php echo $value->goods_name?></a>
                    <h1><?php echo $value->goods_sn?></h1>
                    <h2> <?php if($value->goods_color){?>颜色分类：<?php echo $value->goods_color?>&nbsp;&nbsp;<?php }?>      <?php if($value->goods_size){?>尺寸：<?php echo $value->goods_size?>&nbsp;&nbsp;<?php }?>数量：<?php echo $value->goods_num?></h2>
                    <h1>单价：<strong class="red"></strong><span class="red"><?php echo $value->goods_price_money?></span><a href="javascript:;" class="addRemark fr">添加备注</a><input type="hidden" name="goods_remark[<?php echo $value->cart_id?>]" value=""/></h1>
                  </div>
                </div>
                  <?php }
                        $allMoney           = number_format($tempAllMoney,2);
                        $cartStr            = implode(',',$cartIds);
                        echo '<input type="hidden" name="order_goods" value="'.$cartStr.'">';
                    }?>

              </div>
              <div class="order_score">
                <div class="order_score_left fl">
                  <div class="fl">可以用积分抵现金哟，快来使用吧！</div>
                  <div class="fr">积分余额：0 点</div>
                </div>
                <a href="javascript:;" class="order_score_btn fr" score="0">使  用</a>
              </div>
              <div class="order_invoice mgb18 clearfix">
                <input type="checkbox" checked  name="orderInvoice1" id="orderInvoice" value="1" /><label for="orderInvoice">索要发票</label>
                <input type="text" name="orderInvoice" value="发票抬头名称" onBlur="blurText(this,'发票抬头名称')" onFocus="focusText(this,'发票抬头名称')" class="invoiceText" disabled="disabled"/>
              </div>

              <div class="order_invoice mgb18 clearfix">
                <input type="checkbox" checked name="orderRemarks1" id="orderRemarks" value="1" /><label for="orderRemarks">添加备注</label>
                <textarea value=""  name="orderRemarks" onBlur="blurText(this,'声明：填写有关收货人信息以及配送方式')" onFocus="focusText(this,'声明：填写有关收货人信息以及配送方式')" class="invoiceText remarksArea" disabled="disabled">声明：填写有关收货人信息以及配送方式</textarea>

              </div>

              <div class="order_express fr">
                <div class="select ">
                  <div class="select_selected"><p class="fl">快递配送</p><div class="select_btn fr"></div></div>
                  <ul class="option">
                      <?php
                        if(!empty($expressList)){
                            foreach($expressList as $value){
                      ?>
                    <li rel="<?php echo $value->express_id?>" onClick="orderExpress(this,'<?php echo base_url() ?>')"><?php echo $value->express_name?></li>
                      <?php }}?>
                  </ul>
                  <input type="hidden" name="express_id" value=""/>
                </div>
              </div>
              <div class="clear"></div>
              <div class="order_price">
                商品总金额（<font id="order_price_express">不含运费</font>）：<strong class="red">￥</strong><span class="red" id="order_price_all"  rel="<?php echo $tempAllMoney?>"><?php echo $allMoney;?></span>&nbsp;&nbsp;&nbsp;&nbsp;可获得积分：<strong class="red" style="font-size:15px;">0</strong>点
              </div>

              <button type="submit" class="order_btn fr" onClick="return orderForm();" style="width:180px;">立即购买</button>
            </div>

            <input type="hidden" name="user_address_id" value="<?php echo empty($defaultAddress)?0:$defaultAddress;?>">
        </form>
        <!--order_right start-->
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