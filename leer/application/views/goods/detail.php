<?php include_once(APPPATH.'views/publish/head.php') ?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->
<div id="main">
  <div class="container">
    <div style="background:#fff;">
    <!--detialTop start-->
    <div class="detialTop">
      <!--detialTop_left start-->
      <div class="detialTop_left fl">
        <!--detialTopImg start-->
        <div class="detialTopImg">
          <div class="detialTopImg_big small">
            <img src="<?php if(!empty($goodsInfo->goods_thumb)){echo $goodsInfo->goods_thumb;}?>" />
            <div class="range"></div>
          </div>
          <div class="imgList">
            <ul class="detialTopImg_small">
              <?php
                if(!empty($imageList)){
                    foreach($imageList as $key => $value){
              ?>
            <li <?php if($key == 0){echo 'class="cur"';}?>><a href="javascript:;">
              <img src="<?php if(!empty($imageList)){echo $value;}?>" />
              <div class="detialTopImg_small_layer"></div>
            </a></li>
              <?php }}?>
            </ul>
          </div>
          <div class="big"><img src="<?php if(!empty($imageList)){echo $imageList[0];}?>" alt=""></div>
        </div>
        <!--detialTopImg end-->
        <!--detialTop_left_bottom start-->
        <div class="detialTop_left_bottom">
          <div class="detialTopImg_btn fl">
            <a href="javascript:;" class="detialTopImg_prev"></a>
            <a href="javascript:;" class="detialTopImg_next"></a>
          </div>
          <a href="javascript:;" class="detialTop_left_bottom_sc fl" onClick="Collection('<?php echo base_url() ?>','1','<?php echo $goodsInfo->goods_id ?>')">我的收藏</a>
          <a href="javascript:;" class="detialTop_left_bottom_sc detialTop_left_bottom_db fl"  onClick="proCom('<?php echo base_url()?>','<?php echo $goodsInfo->goods_id ?>','<?php echo $goodsInfo->cat_id ?>')">添加对比</a>
          <!-- JiaThis Button BEGIN -->
            <div class="jiathis_style_24x24 fr">
                <span class="fl">分享至：</span>
                <a class="jiathis_button_tsina"></a>
                <span class="fl">/</span>
                <a class="jiathis_button_weixin"></a>
                <span class="fl">/</span>
                <a class="jiathis_button_qzone"></a>
                <span class="fl">/</span>
                <a class="jiathis_button_douban"></a>
            </div>
        </div>
        <!--detialTop_left_bottom end-->
      </div>
      <!--detialTop_left end-->
      
      <!--detialTop_right end-->
      <div class="detialTop_right fr">
        <div class="detialTop_right_top" style="height:36px;">
          <h1><?php echo (empty($goodsInfo)?'':$goodsInfo->goods_name)?></h1>
          <!--<h2>同城门店：浙江省 - 杭州市 - 西湖区  华盛东街118号<span>（史努比精品专卖店）</span></h2>-->
        </div>
        <div class="detialTop_right_middle">
          <dl class="detial_attr clearfix">
            <dt class="fl">乐而价：</dt>
            <dd class="detial_price fl"><strong>￥</strong><span><?php echo (empty($goodsInfo)?'0.00':$goodsInfo->shop_price_money)?></span></dd>
          </dl>
          <dl class="detial_attr clearfix">
            <dt class="fl">商品编号：</dt>
            <dd class="fl"><?php echo (empty($goodsInfo)?'':$goodsInfo->goods_sn)?></dd>
          </dl>
          <dl class="detial_attr clearfix">
            <dt class="fl">商品评分：</dt>
            <dd class="fl">
              <dl class="star fl">
                  <dd <?php if(empty($goodsInfo) or empty($goodsInfo->shop_num) or $goodsInfo->shop > 0){echo 'class="cur"';}?>></dd>
                  <dd <?php if(empty($goodsInfo) or empty($goodsInfo->shop_num) or $goodsInfo->shop > 1){echo 'class="cur"';}?>></dd>
                  <dd <?php if(empty($goodsInfo) or empty($goodsInfo->shop_num) or $goodsInfo->shop > 2){echo 'class="cur"';}?>></dd>
                  <dd <?php if(empty($goodsInfo) or empty($goodsInfo->shop_num) or $goodsInfo->shop > 3){echo 'class="cur"';}?>></dd>
                  <dd <?php if(empty($goodsInfo) or empty($goodsInfo->shop_num) or $goodsInfo->shop > 4){echo 'class="cur"';}?>></dd>
              </dl>	
              <a  class="red fl" id="goPl" href="javascript:;">（已有<?php echo empty($reviewNum)?0:$reviewNum?>人评价）</a>
              <a href="#" class="lxkf fl">联系QQ</a>
            </dd>         
          </dl>
          <dl class="detial_attr clearfix">
            <dt class="fl">快递运费：</dt>
            <dd class="fl">
              <div class="fl">杭州 至 </div>
              <div id="sjld" class="deliveryAdd fl">
    			<div class="m_zlxg" id="shenfen">
        		  <p title=""><?php echo empty($userAddress)?'':$userAddress['province']?></p>
       			  <div class="m_zlxg2">
        			<ul>
        			</ul>
        		  </div>
    			</div>
                <input id="sfdq_tj"  name="province" type="hidden" value="" />
              </div>
              <div class="fl"> 快递：<span id="detail_express"><?php echo empty($expressCost)?10.00:$expressCost;?></span>  </div>
            </dd>         
          </dl>
          <dl class="detial_attr clearfix">
            <dt class="fl">服&nbsp;&nbsp;&nbsp;&nbsp;务：</dt>
            <dd class="fl">由 乐而 发货并提供售后服务。</dd>            
          </dl>
        </div>

        <div class="detialTop_right_bottom">
            <?php if(!empty($searchSku['size'])){?>
          <dl class="detial_attr clearfix"  id="detail_size">
            <dt class="fl">选择尺码：</dt>
            <dd class="fl">
              <ul class="detial_attr_list">
                  <?php foreach($searchSku['size'] as $key => $value){?>
                <li><a rel="<?php echo $key?>" href="javascript:;" onClick="detial(this);" id="<?php echo $key?>" class="have"><span><?php echo $value?></span></a></li>
                  <?php }?>
              </ul>
            </dd>            
          </dl>
            <?php }?>

            <?php if(!empty($searchSku['color'])){?>
          <dl class="detial_attr clearfix" id="detail_color">
            <dt class="fl">选择颜色：</dt>
            <dd class="fl">
              <ul class="detial_attr_list goodsType" >
                  <?php foreach($searchSku['color'] as $key => $value){?>
                <li><a rel="<?php echo $key?>" href="javascript:;" style="background-color:#<?php echo $value;?>;width:67px;" onClick="detial(this); " id="<?php echo $key?>"  class="have"><span></span></a></li>
                  <?php }?>
              </ul>
            </dd>            
          </dl>
            <?php }?>

            <?php
                if(!empty($searchSku)){
                    foreach($searchSku as $key => $value){
                        if($key != 'color' && $key != 'size'){
            ?>
          <dl class="detial_attr clearfix detail_other">
            <dt class="fl">选择<?php echo $key?>：</dt>
            <dd class="fl">
              <ul class="detial_attr_list goodsType ">
                  <?php foreach($value as $k =>$val){?>
                      <li><a rel="<?php echo $k?>" href="javascript:;"  onclick="detial(this);" id="<?php echo $k?>"  class="have"><span><?php echo $val?></span></a></li>
                  <?php }?>
              </ul>
            </dd>
          </dl>
            <?php }}}?>
          
          <dl class="detial_attr clearfix">
            <dt class="fl">购买数量：</dt>
            <dd class="fl">
              <div class="chooseNum fl">
                <a href="javascript:;" class="chooseNum_jian" onClick="numjian(this);"></a>
                <input type="text" value="1" class="chooseNum_text" onKeyUp="num(this);" maxNum="100" id="detail_num"/>
                <a href="javascript:;" class="chooseNum_jia" onClick="numjia(this);"></a>
              </div>
              <div class="fl"> （库存<?php echo $skuNumber?>）</div>
            </dd>
          </dl>
           
                <input type="hidden" name="goods_id" value="<?php echo empty($goodsId) ? '' : $goodsId ?>">
                <!--<input type="hidden" name="goods_sku_color" value="">
                <input type="hidden" name="goods_sku_size" value="">-->
                <input type="hidden" name="goods_sku_id" value="3,4,5">
               <!-- <input type="hidden" name="goods_sku" value="">
                <input type="hidden" name="goods_num" value="1">-->

                <div class="detialTop_btn">
                  <?php if(!empty($goodsInfo)&&!empty($goodsInfo->cat_id) &&$goodsInfo->cat_id==49){ ?>
                    <a href="<?php echo base_url().'/goodsaction/addGoodsSale/'.$goodsInfo->goods_id ?>" class="goBuy fl" >预定</a>
                    <?php }else{?>
                    <a href="javascript:;" class="goBuy fl" onClick="detailBuyForm('<?php echo base_url() ?>');">立即购买</a><div class="detail_tips detail_tips1">请选择您的商品信息！</div>
                   <input type="button" class="addCart fl" value="加入购物车" onClick="detailForm('<?php echo base_url() ?>');"/><div class="detail_tips detail_tips2">请选择您的商品信息！</div>
                    <?php }?>
                 </div>
           
        </div>
      </div>
      <!--detialTop_right end-->
      <div class="clear"></div>
    </div>
    <!--detialTop end-->
    </div>
    
    <!--package start-->
    <div class="package">
      <div class="package_goods fl">
        <a href="detail.php" class="package_goods_main ">
          <img src="<?php echo base_url()?>resources/img/recommoned.jpg" />
          <h1>秋冬装加绒加厚T恤男长袖头...</h1>
        </a>
        <div>
          <a href="javascript:;" class="package_select fl" oldPrice="100" newPrice="50"></a>
          <div class="package_goods_price fr">价格：<span>¥100.00</span></div>
        </div>
      </div>
      <div class="package_add fl"></div>
      <div class="package_goods fl">
        <a href="detail.php" class="package_goods_main ">
          <img src="<?php echo base_url()?>resources/img/recommoned.jpg" />
          <h1>秋冬装加绒加厚T恤男长袖头...</h1>
        </a>
        <div>
          <a href="javascript:;" class="package_select fl"  oldPrice="168" newPrice="100"></a>
          <div class="package_goods_price fr">价格：<span>¥168.00</span></div>
        </div>
      </div>
      <div class="package_add fl"></div>
      <div class="package_goods fl">
        <a href="detail.php" class="package_goods_main ">
          <img src="<?php echo base_url()?>resources/img/recommoned.jpg" />
          <h1>秋冬装加绒加厚T恤男长袖头...</h1>
        </a>
        <div>
          <a href="javascript:;" class="package_select fl" oldPrice="200" newPrice="150"></a>
          <div class="package_goods_price fr">价格：<span>¥200.00</span></div>
        </div>
      </div>
      
      <div class="package_all fl">
        <h1>秋冬装加绒加厚T恤男长袖头衫三件套</h1>
        <div class="package_all_main">
          <div class="fl">
            <div class="package_all_price package_all_price1">套餐价：<strong class="red">￥</strong>
            <span class="red packagePrice">3,250.00</span></div>
            <div class="package_all_price">价格：<div class="package_all_price_oriPrice">￥
            <span class="oriPrice">664.00</span><div class="horLine"></div></div></div>
          </div>
          <div class="package_sheng fl">省¥
          <span class="savePrice">274.00</span></div>
          <div class="clear"></div>
        </div>
        <a href="#" class="package_buy">购买套装</a>
      </div>
    </div>
    <!--package end-->
    
    <!--detial_main start-->
    <div class="detial_main">
       <!--listLeft start-->
       <div class="listLeft fl">
         <!--listLeft_hot start-->
         <div class="listLeft_hot">
           <div class="listLeft_title"><img src="<?php echo base_url()?>resources/images/title/rmlb_title.jpg" /></div>
           <ul class="listLeft_hot_main">
               <?php
               if(!empty($hotCategory)){
                   foreach($hotCategory as $key => $value){
                       ?>
                       <li class="listLeft_hot<?php echo ($key + 1)?>"><a href="<?php echo base_url('/goodsaction/index/'.$value->cat_id)?>"><h1><?php echo $value->cat_name?></h1><h2><?php echo $value->cat_name_en?></h2></a></li>
                   <?php }}?>

            </ul>
          </div>
         <!--listLeft_hot end-->
         <!--listLeft_hot start-->
         <div class="listLeft_hot mgt27">
           <div class="listLeft_title"><img src="<?php echo base_url()?>resources/images/title/tlpp_title.jpg" /></div>
           <div class="sameBrand">
               <?php foreach($brandInfoList as $item) {?>
               <a href="<?php echo base_url('/goodsaction/index/3/1/'.$item->brand_id.'/0/0/0-0-0-0/')?>"><img src="<?php echo $item->brand_img ?>?>" /></a>
               <?php }?>
              <div class="clear"></div> 
           </div>
          </div>
         <!--listLeft_hot end-->
       </div>
       <!--listLeft end-->
       
       <!--listRight start-->
       <div class="detialInfo fr">
         <div class="detialInfo_nav">
           <a href="javascript:;" class="cur fl">商品详情</a>
           <a href="javascript:;" class="detialInfo_nav_zycs fl">专业参数</a>
           <!--<a href="javascript:;" class="detialInfo_nav_rqzh fl">人气组合</a>-->
         </div>
         <div class="detialInfo_mian">
           <!--宝贝详情-->
           <div class="detialInfo_bbxq" style="display:block;">
               <?php echo(empty($goodsInfo))?'':htmlspecialchars_decode($goodsInfo->goods_detail)?>
           </div>
           <!--宝贝详情-->
           
           <!--专业参数-->
           <div class="detialInfo_zycs">
             <!--参数-->
             <div class="detialInfo_zycs_attr">
                 <?php echo(empty($goodsInfo))?'':htmlspecialchars_decode($goodsInfo->goods_parm)?>
             </div>
             <!--参数-->
             
             <!--国际权威认证-->
             <div class="detialInfo_zycs_auth">
               <div class="detialInfo_title"><span>国际权威认证</span></div>
               <div class="detialInfo_zycs_auth_main">
                 <?php for($i=0;$i<6;$i++){?>
                 <div class="demoBox"><div class="demoImg"><img src="<?php echo base_url()?>resources/img/qwrz.jpg" /></div></div>              
                 <?php }?>
                 <div class="clear"></div>
               </div>
             </div>
             <!--国际权威认证-->
             
             
           </div>
           <!--专业参数-->
         </div>
         <!--评价-->
             <div class="detialInfo_zycs_eva mgt27">
               <div class="adv mgb20"><img src="<?php echo base_url()?>resources/img/adv.jpg" /></div>
               
               <div class="detialInfo_zycs_eva_top">
                 <h1 class="fl">用户点评</h1>
                 <dl class="star fl">
                     <dd <?php if(empty($value->shop_num) or $value->shop_num > 0){echo 'class="cur"';}?>></dd>
                     <dd <?php if(empty($value->shop_num) or $value->shop_num > 1){echo 'class="cur"';}?>></dd>
                     <dd <?php if(empty($value->shop_num) or $value->shop_num > 2){echo 'class="cur"';}?>></dd>
                     <dd <?php if(empty($value->shop_num) or $value->shop_num > 3){echo 'class="cur"';}?>></dd>
                     <dd <?php if(empty($value->shop_num) or $value->shop_num > 4){echo 'class="cur"';}?>></dd>
              	 </dl>	
                 <div class="fl">（<?php echo empty($aveNum)?'5.0':$aveNum?>分）&nbsp;&nbsp;<strong class="red"><?php echo empty($reviewNum)?0:$reviewNum?>名</strong> 网友点评</div>
               </div>
               
               <div class="detialInfo_zycs_eva_main">
                 <?php
                    if(!empty($goodsReviewList[0])){
                        foreach($goodsReviewList as $key => $value){
                 ?>
                 <div class="eva">
                     <?php if($value->is_cream){?>
                   <div class="eva_jh"></div>
                    <?php }?>
                   <div class="eva_user">
                     <img src="<?php echo (empty($value->user_image))?base_url().'resources/img/phone.jpg':$value->user_image?>" />
                     <div class="eva_user_mes fl">
                       <h1><?php echo $value->user_nikename?></h1>
                       <h2><?php echo $value->user_address?></h2>
                       <dl class="star fl">
                           <dd <?php if(empty($value->review_score) or $value->review_score > 0){echo 'class="cur"';}?>></dd>
                           <dd <?php if(empty($value->review_score) or $value->review_score > 1){echo 'class="cur"';}?>></dd>
                           <dd <?php if(empty($value->review_score) or $value->review_score > 2){echo 'class="cur"';}?>></dd>
                           <dd <?php if(empty($value->review_score) or $value->review_score > 3){echo 'class="cur"';}?>></dd>
                           <dd <?php if(empty($value->review_score) or $value->review_score > 4){echo 'class="cur"';}?>></dd>
                       </dl>	
                     </div>
                   </div>
                   <div class="eva_des">
                       <strong class="red">描述：</strong>
                       <?php echo $value->review_content?>
                   </div>
                     <?php
                     if(!empty($value->review_pics)){
                     ?>
                   <div class="eva_img">
                            <?php
                                $reviewPics     = explode(',',$value->review_pics);
                                foreach($reviewPics as $v){
                            ?>
                            <a href="javascript:;">
                                <img src="<?php echo $v?>"/>

                                <div class="eva_img_layer"></div>
                                <div class="eva_img_Big"><img src="<?php echo $v?>"/>
                                </div>
                            </a>
                        <?php } ?>
                   </div>
                         <?php }?>
                   <div class="like" onClick="evaLike(this,'<?php echo base_url()?>','<?php echo $value->review_id?>')"><span><?php echo $value->review_zan_num?></span> like</div>
                 </div>
                 <?php }}?>
                 <div class="page clearfix">
                  <?php echo $pageHtml?>
                </div> 
               </div>
             </div>
         <!--评价-->
         <div class="middle_second mgt30">
           <div class="middle_top"><div class="middle_title fl"><img src="<?php echo base_url()?>resources/images/title/rmtj_title.jpg" /></div><a href="list.php" class="more1 fr">MORE+</a></div> 
           <div class="detail_recommend">
             <div class="hd">
               <a class="next"></a>
               <a class="prev"></a>
             </div>
             <div class="bd">
               <ul class="picList product">
                 <?php
                 if(!empty($rmdList)){
                 foreach($rmdList as $key => $value) {?>
                 <li><a href="<?php echo base_url('/goodsaction/goodsDetail/'.$value->goods_id)?>" class="product">
                   <img src="<?php echo $value->goods_thumb?>" />
                   <div class="middle_new_title"><?php echo $value->goods_short_name?></div>
                   <div class="middle_new_price">￥<span><?php echo $value->shop_price_money?></span></div>
                   <div class="middle_new_con"><?php echo  $value->goods_short_intro?></div>
                   <dl class="star">
                       <dd <?php if(empty($value->shop_num) or $value->shop_num > 0){echo 'class="cur"';}?>></dd>
                       <dd <?php if(empty($value->shop_num) or $value->shop_num > 1){echo 'class="cur"';}?>></dd>
                       <dd <?php if(empty($value->shop_num) or $value->shop_num > 2){echo 'class="cur"';}?>></dd>
                       <dd <?php if(empty($value->shop_num) or $value->shop_num > 3){echo 'class="cur"';}?>></dd>
                       <dd <?php if(empty($value->shop_num) or $value->shop_num > 4){echo 'class="cur"';}?>></dd>
                   </dl>	
                 </a></li>
                 <?php }}?>
               </ul>
             </div>
           </div>

	       
         </div>
       </div>
       <!--listRight end-->
       <div class="clear"></div>
    </div>
    <!--detial_main end-->
  </div>
</div>

<!--添加购物车成功-->
<div id="tipsPop" class="cartTips" style="display:none;">
   <a href="javascript:;" class="tipsPop_close" onClick="hidePop()"></a>
   <div class="tipsPop_top">
     <div class="tipsPop_top_left fl">成功加入购物车！</div>
     <div class="tipsPop_top_right fr">您可以<a href="<?php echo base_url()?>/orderaction/cart">去购物车结算</a></div>
   </div>
   <div class="tipsPop_btn" style="padding:10px 0 0 0;">
      <a href="javascript:;" style="width:150px;padding:0;" onClick="hidePop()">继续购物</a>
      <a href="<?php echo base_url()?>index.php"  class="tipsPop_btn1"  style="width:150px;padding:0;">返回首页</a>
   </div>
</div>
<div id="layer" style="display:none;"></div>
<!--添加购物车成功-->

<?php include_once('proComPop.php') ?>
<!--footer start-->
<?php include_once(APPPATH.'views/publish/footer.php') ?>
<!--footer end-->

<!--放大镜 start-->
<script type="text/javascript" src="<?php echo base_url()?>resources/js/magnifier.js"></script>
<script type="text/javascript">
$('.small').mag({
	box:".small",//小图框架
	box2:".big",//大图框架
	box2_w:1500,//大图宽
	box2_h:1157,//大图高
	range:".range",//放大镜框架
	range_w:100,//小图放大镜范围宽度
	range_h:100//小图放大镜范围高度
})
</script>
<!--放大镜 end-->

<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>

<input type="hidden" id="baseUrl" value="<?php echo base_url()?>">

<?php
    if(!empty($skuValueArr)){
        foreach($skuValueArr as $k=>$value){
?>
<input type="hidden" class="skuValueArr" value="<?php echo $value?>" id="skuString<?php echo $k?>"/>
<?php }}?>
<script type="text/javascript">
	       jQuery(".detail_recommend").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",vis:4,scroll:4,interTime:4000,delayTime:1000});</script>
</body>
</html>