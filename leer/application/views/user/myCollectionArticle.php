<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
  <div class="container">
    <!--center_left start-->
      <?php include_once('center_nav.php') ?>
    <!--center_left end-->
    
    <!--center_right start-->
    <div class="centerRight fr" id="centerRight">
      <!--centerRight_top start-->
        <?php include_once('center_top.php') ?>
      <!--centerRight_top end-->
      
      <!--centerRight_main start-->
      <div class="centerRight_main centerRightBg myOrder" style="padding-top:0;">
        <div class="collection_top">
          <div class="collection_nav fl">
            <a href="<?php echo base_url('/useraction/getCollectList')?>">收藏的产品</a>
            <div class="collection_line"></div>
            <a href="<?php echo base_url('/useraction/myCollectionArticle')?>" class="cur">收藏的文章</a>
          </div>
          <div class="center_title_r fr">
            <a href="javascript:;" class="myOrder_all_delete fr" onClick="javascript:if(confirm('确认删除？')){deleteCollectArticle(this,'<?php echo base_url() ?>',1);}">删除</a>
            <input type="checkbox" name="all"  id="action" value="action" onClick="ChkAllClick('chkSon','action')" />
			<label for="action" class="label">全选</label>
          </div>
        </div>
        
        <div class="collection_main">
          <!--collectionArticle_list start-->
          <ul class="collectionArticle_list">
              <?php
              if(!empty($collectList)){
                  foreach($collectList as $key=>$value){
              ?>
            <li>
              <input type="checkbox"  name="collection" class="chkSon" id="actlist<?php echo($key+1) ?>" value="actlist<?php echo($key+1) ?>" onClick="ChkSonClick('chkSon','action')" rel="<?php echo $value->ct_id ?>"/><label class="label1" for="actlist<?php echo($key+1) ?>">&nbsp;</label>
              <a  href="<?php echo(base_url().'/articleaction/articleDetail/'.$value->goods_id)?>" target="_blank" class="collectionArticle_title fl"><?php echo $value->goods_title?></a>
              <div class="collectionArticle_date fl">[<?php echo date("Y-m-d",$value->add_time)?>]</div>
              <a href="javascript:void(0);" onClick="javascript:if(confirm('确认删除？')){deleteCollectArticle(this,'<?php echo base_url() ?>',0);}" rel="<?php echo $value->ct_id ?>" class="centerRight_right_car_det fr"><div class="centerRight_right_car_detTip">删除</div></a>
            </li>
              <?php }
              }?>
          </ul>
          
          <!--collectionArticle_list end-->
        </div>
        
        <div class="page mgt40 fr">
          <?php echo $pageHtml?>
        </div> 
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