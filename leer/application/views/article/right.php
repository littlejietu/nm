<div class="news_right fr">
  <!--news_right_area start-->
  <div class="news_right_area mrgB25">
    <a href="#" class="news_right_area1 clearfix">
      <div class="news_right_area_l fl"><img src="<?php echo base_url()?>resources/images/news_area1.jpg" /></div>
      <div class="news_right_area_r fr"><div class="news_right_areaText1">艺术家专区</div><div class="news_right_areaText2">艺术家专区</div></div>
    </a>
    
    <a href="#" class="news_right_area2 clearfix">
      <div class="news_right_area_l fl"><img src="<?php echo base_url()?>resources/images/news_area2.jpg" /></div>
      <div class="news_right_area_r fr"><div class="news_right_areaText1">时尚发布网</div><div class="news_right_areaText2">时尚发布网</div></div>
    </a>
    
    <a href="#" class="news_right_area3 clearfix">
      <div class="news_right_area_l fl"><img src="<?php echo base_url()?>resources/images/news_area3.jpg" /></div>
      <div class="news_right_area_r fr"><div class="news_right_areaText1">卡通活动</div><div class="news_right_areaText2">卡通活动</div></div>
    </a>
  </div>
  <!--news_right_area end-->
  
  
  <!--middle_hot start-->
    <div class="middle_hot">
        <div class="middle_top"><div class="middle_title fl"><img src="<?php echo base_url()?>resources/images/title/rmzq_title.jpg"></div><a href="<?php echo base_url('/articleaction/index/24')?>" class="more1 fr">MORE+</a></div>
        <div class="middle_hot_main">
            <div class="middle_hot_first">
                <a href="<?php echo base_url('/articleaction/articleDetail/')?>/<?php echo empty($remenList_1)?'':$remenList_1->art_id?>">
                    <h1><?php echo empty($remenList_1)?'':$remenList_1->art_title?></h1>
                    <div class="middle_hot_con">
                        <?php
                        if(!empty($remenList_1)){
                            echo mb_substr($remenList_1->art_intro,0,45,'utf-8');
                            echo (mb_strlen($remenList_1->art_intro) > 45)?'...':'';
                        }
                        ?>
                    </div>
                </a>
                <a href="<?php echo base_url('/articleaction/articleDetail/')?>/<?php echo empty($remenList_1)?'':$remenList_1->art_id?>" class="more fl">more</a>
                <div class="view fl"><?php echo empty($remenList_1)?'':$remenList_1->art_views?> views</div>
                <div class="like fl" onclick="like(this,'<?php echo empty($remenList_1)?'':$remenList_1->art_id?>','<?php echo base_url()?>')"><span><?php echo empty($remenList_1)?'':$remenList_1->art_likes?></span> like</div>
                <div class="clear"></div>
            </div>
            <div class="middle_hot_list">
                <?php
                if(!empty($remenList_6[0])){
                    foreach($remenList_6 as $value){
                        ?>
                        <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id)?>"><?php echo $value->art_title?></a>
                    <?php }}?>
            </div>
        </div>
    </div>
  <!--middle_hot end-->

  <!--news_right_adv start-->
  <div class="news_right_adv mrgB25">
    <!--slideBoxIsme start-->
    <div id="slideBox" class="slideBoxIsme">
        <div class="hd">
            <ul><li></li><li></li><li></li></ul>
        </div>
        <div class="bd">
            <ul>
              <?php for($i=0;$i<3;$i++) {?>
              <li><a href="#">
                <img src="<?php echo base_url()?>resources/img/isme.jpg" />
                <div class="slideBoxIsme_layer">
                  <p>骑行到户外</p>
                  <p>带你穿越体验大自然美景</p>
                </div>
              </a></li>
              <?php }?>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
    jQuery(".slideBoxIsme").slide({mainCell:".bd ul",autoPlay:true,interTime:3000,delayTime:1000});
    </script>
    <!--slideBoxIsme start-->
  </div>
  <!--news_right_adv end-->
  
  <!--news_right_pic start-->
  <div class="news_right_pic">
    <div class="middle_top"><div class="middle_title"><img src="<?php echo base_url()?>resources/images/title/mtxs_title.jpg" /></div></div> 
    <!--slideBoxIsme start-->
    <div id="slideBox" class="slideBoxIsme">
        <div class="hd">
            <ul><li></li><li></li><li></li></ul>
        </div>
        <div class="bd">
            <ul>
              <?php for($i=0;$i<3;$i++) {?>
              <li><a href="#">
                <img src="<?php echo base_url()?>resources/img/isme.jpg" />
              </a></li>
              <?php }?>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
    jQuery(".slideBoxIsme").slide({mainCell:".bd ul",autoPlay:true,interTime:3000,delayTime:1000});
    </script>
    <!--slideBoxIsme start-->
    
    <div class="news_right_pic_list">
      <a href="#">014春季时装展示节</a>
      <a href="#">努比新款T恤新品展示</a>
      <a href="#">014春季时装展示节</a>
      <a href="#">努比新款T恤新品展示</a>
    </div>
  </div>
  <!--news_right_adv end-->
</div>