<?php include_once(APPPATH.'views/publish/head.php') ?>

<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->

<div id="news">
  <div class="container">
    <!--news_left end-->
    <div class="news_left fl">
      <div class="middle_top"><div class="middle_title"><?php echo empty($catName)?'':$catName?></div></div>
        <div class="newsList">
            <?php
                if(!empty($artList)){
                    foreach($artList as $value){
            ?>
            <div class="newsList_main">
                <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id)?>" class="newsList_link"><img src="<?php echo $value->art_img?>"/>

                <div class="middle_act_main">
                    <h1><?php echo $value->art_title?></h1>

                    <div class="middle_act_con">
                        <?php
                            echo mb_substr($value->art_intro,0,100,'utf-8');
                            echo (mb_strlen($value->art_intro) > 100)?'...':'';
                        ?>
                    </div>
                </div>
                <div class="middle_news_date"><h2><?php echo date('d',$value->last_update)?></h2><h3><?php echo date('Y-m',$value->last_update)?></h3></div>
                </a>
                <div class="list_icon">
                  <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id)?>"  class="more fl">more</a>
                  <div class="view fl"><?php echo $value->art_views?> views</div>
                  <div class="like fl" onclick="like(this,'<?php echo $value->art_id?>','<?php echo base_url()?>')"><span><?php echo $value->art_likes?></span> like</div>
                </div>
            </div>
            <?php }} ?>
        </div>
        <div class="page clearfix" style="margin:5px 0 11px 0;">
          <?php echo empty($pageHtml)?'':$pageHtml?>
        </div>
    </div>  
    <!--news_left end-->
    
    <!--news_right start-->
    <?php include('right.php')?>
    <!--news_right_pic end-->
    
    <div class="clear"></div>
  </div>
</div>


<!--footer start-->
<?php include_once(APPPATH.'views/publish/footer.php') ?>
<!--footer end-->

</body>
</html>