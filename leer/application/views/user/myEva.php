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

        <div class="center_title">
          <div class="fl">我的评价</div>
          <div class="center_title_r fr">
<!--            <a href="javascript:;" class="myOrder_all_delete fr">删除</a>-->
<!--            <input type="checkbox" name="test"  id="action" value="action" onClick="ChkAllClick('chkSon','action')" />-->
<!--			<label for="action" class="label">全选</label>-->
            评价提醒：
            已点评<span class="purple">（<?php echo $isReview?>）</span>&nbsp;&nbsp;
            未点评<span class="purple">（<?php echo $noReview?>）</span>
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
          <div class="myOrder_main">
                <?php
                    foreach($value->goodsList as $k => $v){
                ?>
              <ul class="myOrder_list clearfix">
                <li style="width:335px;" class="myOrder_info">
                    <a href="<?php echo base_url('/goodsaction/goodsdetail/' . $v->goods_id) ?>">
                        <img src="<?php echo $v->goods_thumb ?>" width="100" height="77"/>
                        <h1><?php echo $v->goods_name ?></h1>
                        <p style="padding:5px 0 0 0;"><?php echo $v->goods_sn ?></p>
                    </a>
                </li>
                  <li style="width:118px;text-align:center;padding:30px 0 0 0;">2</li>
                  <li style="width:120px;text-align:center;padding:30px 0 0 0;">
                      <strong>￥</strong><span class="price"><?php echo number_format($v->goods_price,2)?></span>
                  </li>
                <li style="width:191px;text-align:center;padding:25px 0 0 0;" class="myOrder_state">
                  <a href="#" class="myOrder_jywc">交易完成</a>
                </li>

                  <li style="width:80px;padding:28px 0 0 0;text-align:center;position:relative;">
                      <?php if ($v->is_review) { ?>
                          已点评
                      <?php } else { ?>
                          <input type="hidden" value="<?php echo $v->goods_id?>">
                          <a href="javascript:;" class="addEva" rel="<?php echo $v->goods_id?>" relid="<?php echo $v->order_goods_id?>">未点评</a>
                      <?php } ?>

                  </li>
              </ul>
              <?php }?>
              <div class="myOrder_bottom">

                订单编号：<?php echo $value->order_sn?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下单时间：<?php echo date('Y/m/d H:i:s',$value->add_time)?>
              </div>
          </div>

          <div class="myOrder_line"></div>
            <?php }}?>

            <div class="page mgt40 clearfix">
                <?php echo $pageHtml?>
            </div>
        </div>
        <!--center_main end-->

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

<div id="goods_eva" style="display:none;">
  <div class="goods_remark_icon"></div>

  <table cellpadding="0" cellspacing="0" class="evaTable" align="left">
    <tr height="40">
      <td width="65"><font>产品评分：</font></td>
      <td><dl class="star purple_star selectStar">
			<dd onClick="selectStar(this)"></dd>
			<dd onClick="selectStar(this)"></dd>
			<dd onClick="selectStar(this)"></dd>
			<dd onClick="selectStar(this)"></dd>
			<dd onClick="selectStar(this)"></dd>
		  </dl>
          <div class="tips purple_tips fl" style="left:170px;top:14px;"><span></span></div>
          <input type="hidden" name="score" value="0"/>
       </td>
    </tr>
    <tr height="117">
      <td width="65" valign="top"><font>产品描述：</font></td>
      <td style="position:relative;"><textarea value="" onBlur="blurText(this,'产品描述')" onFocus="focusText(this,'产品描述')" class="invoiceText goods_remarkArea mgb18" id="evaCon" defaultVal="产品描述">产品描述</textarea></td>
    </tr>
    <tr height="57">
      <td width="65" valign="top"><font>上传图片：</font></td>
      <td align="left">
        <div class="imgShow_list"  id="evaImg">
        </div>
        <iframe frameborder="0"  src="<?php echo base_url('/useraction/loadIframe')?>" width="356" height="40"></iframe>

      </td>
    </tr>
    <tr height="57">
      <td width="65" valign="top"></td>
      <td align="left"><input type="submit" class="goods_remark_btn" value="保 存" onClick="myEvaForm('<?php echo base_url()?>',this)"/> </td>
    </tr>
  </table>

</div>
</body>
</html>