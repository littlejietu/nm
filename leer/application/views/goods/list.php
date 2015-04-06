<?php include_once(APPPATH.'views/publish/head.php') ?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->

<div id="main">
  <div class="container" id="list">
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
          <li class="listLeft_hot<?php echo ($key + 1)?>">
              <a href="<?php echo base_url('/goodsaction/index/'.$value->cat_id)?>">
                  <h1><?php echo $value->cat_name?></h1>
                  <h2><?php echo $value->cat_name_en?></h2>
              </a>
          </li>
            <?php }}?>
        
        </ul>
      </div>
      <!--listLeft_hot end-->
      
      <div class="listLeft_adv"><a href="<?php echo base_url('/isbuildingaction/index')?>"><img src="<?php echo base_url()?>resources/img/add.jpg" /></a></div>
      
      <!--listLeft_preSale start-->
      <div class="listLeft_preSale">
        <div class="listLeft_title"><img src="<?php echo base_url()?>resources/images/title/ysk_title.jpg" /></div>
        <div class="listLeft_preSale_main">
          <?php foreach($yushoukuan as $item) {?>
          <a href="<?php echo base_url('/goodsaction/goodsdetail/'.$item->goods_id)?>">
            <img src="<?php echo $item->goods_thumb?>" />
            <h1><?php echo $item->goods_name ?></h1>
            <h2><?php echo $item->goods_intro  ?></h2>
            <h3>￥<strong></strong><span><?php echo $item->shop_price?></span></h3>
          </a>
          <?php }?>
        </div>
      </div>
      <!--listLeft_preSale end-->
    </div>
    <!--listLeft end-->
    
    <!--listRight start-->
    <div class="listRight fr">
      <!--yourChoice start-->
      <div class="yourChoice">
        <div class="filletTop"></div>
        <div class="filletMiddle">
          <div class="yourChoice_title fl">你的选择：</div>
          <div class="yourChoice_main fl">
            <!--<a href="javascript:;">
              <div class="filletLeft"></div>
              <div class="filletCenter">史努比snoopy</div>
              <div class="filletRight"></div>
              <div class="listDelete"></div>
            </a>
            <div class="yourChoice_line"></div>-->
          </div>
          <div class="clear"></div>
        </div>
        <div class="filletBottom"></div>
      </div>
      <!--yourChoice end-->
      
      <!--listChoice start-->
      <div class="listChoice">
        <div class="filletTop"></div>
        <div class="filletMiddle">
         <!-- listChoiceBox start-->
          <div class="listChoiceBox brandAttr" id="brand">
            <div class="listChoice_title fl">品牌：</div>
            <div class="listChoice_main fl">
              <?php
                if(!empty($brandList)){
                    foreach($brandList as $value){
              ?>
              <a href="javascript:;" rel="<?php echo $value->brand_id?>"  id="brandAttr<?php echo $value->brand_id?>"><?php echo $value->brand_name?> </a>
              <div class="yourChoice_line"></div>
              <?php }}?>
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
          </div>

            <div class="listChoiceBox brandAutAttr" id="brandAut">
                <div class="listChoice_title fl">产品品牌：</div>
                <div class="listChoice_main fl">
                    <?php
                    if(!empty($brandAuthorizeList)){
                        foreach($brandAuthorizeList as $value){
                            ?>
                            <a href="javascript:;" rel="<?php echo $value->brand_id?>"  id="brandAutAttr<?php echo $value->brand_id?>"><?php echo $value->brand_name?> </a>
                            <div class="yourChoice_line"></div>
                        <?php }}?>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>

          <!-- listChoiceBox end-->
          <?php
            if(!empty($searchSku)){
                foreach($searchSku as $key => $value){
          ?>
          <!-- listChoiceBox start-->
          <div class="listChoiceBox otherAttr">
            <div class="listChoice_title fl"><?php echo $key?>：</div>
            <div class="listChoice_main fl">
              <?php foreach($value as $k => $v){?>
              <a href="javascript:;" rel="<?php echo $k?>"  id="otherAttr<?php echo $k?>"><?php echo $v?> </a>
              <div class="yourChoice_line"></div>
              <?php }?>
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
          </div>
          <!-- listChoiceBox end-->
          <?php }}?>
          
        </div>
        <div class="filletBottom"></div>
      </div>
      <!--listChoice end-->
      
      <!--yourChoice1 start-->
      <div class="yourChoice1">
        <div class="yourChoice_title fl">你的选择：</div>
        <!--yourChoice1_select start-->
        <div class="yourChoice1_select fl"  style="z-index:10;">
          <div class="yourChoice1_select_top">
            <div class="filletLeft"></div>
            <div class="filletCenter">请选择</div>
            <div class="filletRight"></div>
            <div class="listSelect"></div>
          </div>
          <div class="yourChoice1_select_main sort1">
            <a href="javascript:;" id="1" rel="1">人气</a>
            <a href="javascript:;" id="2" rel="2">销量</a>
 
          </div>
        </div>
        <!--yourChoice1_select start--> 
        
        <div class="yourChoice_title fl" style="width:44px;">价格：</div>
        <!--yourChoice1_select start-->
        <div class="yourChoice1_select fl">
          <div class="yourChoice1_select_top">
            <div class="filletLeft"></div>
            <div class="filletCenter" style="width:75px;">请选择</div>
            <div class="filletRight"></div>
            <div class="listSelect"></div>
          </div>
          <div class="yourChoice1_select_main sort2" style="width:118px;">
            <a href="javascript:;" class="1" rel="1">价格从高到低</a>
            <a href="javascript:;" class="2" rel="2">价格从低到高</a>
          </div>
        </div>
        <!--yourChoice1_select start--> 
        
        <div class="yourChoice_title fl" style="width:44px;">区间：</div>
        <!--yourChoice_price start-->
        <div class="yourChoice_price fl"><div class="filletLeft"></div>
            <div class="filletCenter"><input type="text" placeholder="￥" onKeyUp="num(this);" id="moneyStart"></div>
        <div class="filletRight"></div></div>
        <div class="yourChoice_price_line fl"></div>
        <div class="yourChoice_price fl"><div class="filletLeft"></div>
            <div class="filletCenter"><input type="text" placeholder="￥" onKeyUp="num(this);"  id="moneyOver"></div>
        <div class="filletRight"></div></div>
        
        <a href="javascript:;" class="price_btn" id="sort3">确定</a>
        <!--yourChoice_price start--> 
        
        <div class="comparison fr">产品对比</div>
      </div>
      <!--yourChoice1 end-->
      
      <!--list start-->
      <div class="list">
        <ul class="picList product">
            <?php
                if(!empty($goodsList)){
                    $srtarrayid = implode(',',$GoodsProComArray);
                    foreach($goodsList as$key=> $value){
             ?>
		    <li><a href="<?php echo base_url('/goodsaction/goodsdetail/'.$value->goods_id)?>" class="product">
			  <div class="middle_new_img"><img src="<?php echo empty($value->goods_thumb)?base_url('resources/img/new.jpg'):$value->goods_thumb;?>" /></div>
              <div class="middle_new_title"><?php echo $value->goods_short_name?></div>
              <div class="middle_new_price">￥<span><?php echo $value->shop_price_money?></span></div>
              <div class="middle_new_con"><?php echo empty($value->goods_intro)?'':$value->goods_intro?></div>
              <dl class="star">
                <dd <?php if(empty($value->shop_num) or $value->shop > 0){echo 'class="cur"';}?>></dd>
                <dd <?php if(empty($value->shop_num) or $value->shop > 1){echo 'class="cur"';}?>></dd>
                <dd <?php if(empty($value->shop_num) or $value->shop > 2){echo 'class="cur"';}?>></dd>
                <dd <?php if(empty($value->shop_num) or $value->shop > 3){echo 'class="cur"';}?>></dd>
                <dd <?php if(empty($value->shop_num) or $value->shop > 4){echo 'class="cur"';}?>></dd>
              </dl>
               <input type="checkbox" <?php  if(!empty($srtarrayid) && strstr(','.$srtarrayid.',',','.$value->goods_id.',')){echo 'checked';} ?> name="test"   id="actionlist<?php echo $value->goods_id ?>" value="<?php echo $value->goods_id ?>" onClick="proCom('<?php echo base_url()?>','<?php echo $value->goods_id ?>','<?php echo $value->cat_id ?>',this)"/><label  for="actionlist<?php echo $value->goods_id ?>" class="label">添加对比</label>
			</a></li>
            <?php }}?>
            <div class="clear"></div>	
		  </ul>
      </div>
      <!--list end-->
      
      <!--list_page start-->
      <div class="list_page">
        <!--yourChoice1_select start-->
        <div class="yourChoice1_select fl">
          <div class="yourChoice1_select_top">
            <div class="filletLeft"></div>
            <div class="filletCenter" style="width:75px;">请选择</div>
            <div class="filletRight"></div>
            <div class="listSelect"></div>
          </div>
          <div class="yourChoice1_select_main sort2" style="width:118px;">
            <a href="javascript:;" class="1"  rel="1">价格从高到低</a>
            <a href="javascript:;" class="2" rel="2">价格从低到高</a>
          </div>
        </div>
        <!--yourChoice1_select start-->
        
        <div class="page fr">
            <?php echo empty($pageHtml)?'':$pageHtml;?>
        </div> 
      </div>
      <!--list_page start-->
    </div>
    <!--listRight end-->
    <div class="clear"></div>
  </div>
</div>

<?php include_once('proComPop.php') ?>
<!--footer start-->
<?php include_once(APPPATH.'views/publish/footer.php') ?>
<!--footer end-->
<input type="hidden" name="pageNum"  id="pageNum" value="<?php echo (empty($page))?1:$page?>">
<input type="hidden" name="baseUrl"  id="baseUrl" value="<?php echo base_url()?>">
</body>
</html>