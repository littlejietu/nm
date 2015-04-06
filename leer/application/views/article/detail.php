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
      <div class="news_detial">
        <div class="news_detial_title"><?php echo empty($articleInfo[0])?'':$articleInfo[0]->art_title?></div>
        <div class="news_detial_date">
          <div class="date mrgR20 fl"><?php echo empty($articleInfo[0])?'':date('Y-m-d',$articleInfo[0]->add_time)?></div>
          <div class="view mrgR20 fl"><?php echo empty($articleInfo[0])?'':$articleInfo[0]->art_views?> views</div>
          <div class="like mrgR20 fl"  onclick="like(this,'<?php echo $articleInfo[0]->art_id?>','<?php echo base_url()?>')"><span><?php echo empty($articleInfo[0])?'':$articleInfo[0]->art_likes?></span> like</div>
          <div class="clear"></div>
        </div>
        <div class="news_detial_main">
            <?php echo empty($articleInfo[0])?'':htmlspecialchars_decode($articleInfo[0]->art_content)?>
        </div>
        
        <div class="news_detial_share clearfix">
          <a href="javascript:history.go(-1)" class="goback fl">返回列表</a>
            <a href="javascript:void(0)" class="goback fl" onclick="Collection('<?php echo base_url() ?>','2','<?php echo $articleInfo[0]->art_id ?>')" >收藏文章</a>
            <!-- JiaThis Button BEGIN -->
          <div class="jiathis_style_32x32 fr">
                <span class="fl">分享至：</span>
                <a class="jiathis_button_tsina"></a>
                <a class="jiathis_button_renren"></a>
                <a class="jiathis_button_weixin"></a>
                <a class="jiathis_button_qzone"></a>
                <a class="jiathis_button_douban"></a>
          </div>
          <!-- JiaThis Button END -->
        </div>
        
        <div class="news_detial_fanye">
            <?php
                if(!empty($articleInfo['prev'])){
                    $prev       = $articleInfo['prev'];
            ?>
          <p>上一篇：<a href="<?php echo base_url('/articleaction/articleDetail/'.$prev->art_id)?>"><?php echo $prev->art_title?></a></p>
            <?php }?>
            <?php
            if(!empty($articleInfo['next'])){
                $next       = $articleInfo['next'];
                ?>
                <p class="news_detial_down">下一篇：<a href="<?php echo base_url('/articleaction/articleDetail/'.$next->art_id)?>"><?php echo $next->art_title?></a></p>
            <?php }?>
        </div>
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
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
</body>
</html>