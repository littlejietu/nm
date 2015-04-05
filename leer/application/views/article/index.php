<?php include_once(APPPATH.'views/publish/head.php') ?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH.'views/publish/header.php') ?>
<!--header end-->

<div class="whiteBg">
  <div class="container pdTB65123 clearfix">
    <div class="zixun_first clearfix">
      <!--zixun_left-->
      <div class="zixun_left fl">
        <!--资讯banner-->
        <div id="slideBox" class="zixunSlide">
            <div class="hd">
                <ul><li></li><li></li><li></li></ul>
            </div>
            <div class="bd">
                <ul>
                    <li><a href="#" target="_blank"><img src="<?php echo base_url() ?>resources/img/centerimg5.jpg" /><div class="zixunSlide_con">殿堂升级版“史努比花生漫画家族绚丽艺术之旅”女神驾到！</div></a></li>
                    <li><a href="#" target="_blank"><img src="<?php echo base_url() ?>resources/img/centerimg5.jpg" /><div class="zixunSlide_con">殿堂升级版“史努比花生漫画家族绚丽艺术之旅”女神驾到！</div></a></li>
                    <li><a href="#" target="_blank"><img src="<?php echo base_url() ?>resources/img/centerimg5.jpg" /><div class="zixunSlide_con">殿堂升级版“史努比花生漫画家族绚丽艺术之旅”女神驾到！</div></a></li>
                </ul>
            </div>
        </div>

        <script type="text/javascript">
        jQuery(".zixunSlide").slide({mainCell:".bd ul",autoPlay:true});
        </script>

        <!--国际同步-->
        <div class="zixun_gjtb mrgT18">
          <div class="middle_top">
            <div class="middle_title fl">国际同步</div>
            <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/12'?>">MORE+</a>
          </div>
          <div class="zixun_gjtb_main">
            <div class="left fl">
              <!--zixun_gjtb_first-->
              <div class="zixun_gjtb_first">
                <div class="zixun_gjtb_first_top clearfix">
                  <a href="<?php echo base_url('/articleaction/articleDetail/'.$inteSynch[0]->art_id) ?>" class="zixun_gjtb_img fl">
                 <img src="<?php echo $inteSynch[0]->art_img ?>" /></a>
                  <div class="zixun_gjtb_first_con fr">
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.$inteSynch[0]->art_id) ?>"><?php echo mb_substr($inteSynch[0]->art_title,0,18) ?></a>
                    <p><?php echo mb_substr($inteSynch[0]->art_intro,0,50) ?></p>
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.$inteSynch[0]->art_id) ?>" class="zixun_gjtb_first_more"></a>
                  </div>
                </div>
                <a class="more fl mrgR16" href="<?php echo base_url().'/articleaction/index/12'?>">more</a>
                <div class="view fl mrgR16"><?php echo $inteSynch[0]->art_views ?> views</div>
                <div class="like fl mrgR16" onClick="like(this,'<?php echo $inteSynch[0]->art_id ?>','<?php echo base_url() ?>')"><span><?php echo $inteSynch[0]->art_likes ?></span>like</div>
              </div>

              <div class="middle_hot_list">
                <?php
                $inteSynch6 = array_slice($inteSynch,1,7);
                foreach($inteSynch6 as $value){?>
                <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
                <?php }?>
              </div>
            </div>

            <div class="right fr">
              <div class="middle_hot_list">
                <?php
                $inteSynch18 = array_slice($inteSynch,8,18);
                foreach($inteSynch18 as $value){?>
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
                <?php }?>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--zixun_right-->
      <div class="zixun_right fr">
        <!--最新动态-->
        <div class="zixun_zxdt">
          <div class="middle_top">
            <div class="middle_title fl">最新动态</div>
            <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/54'?>">MORE+</a>
          </div>
          <div class="zixun_zxdt_main">
            <?php foreach($latestNews as $value){?>
            <div class="zixun_zxdt_path">
              <a target="_blank" href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>" class="zixun_gjtb_img fl"><img src="<?php echo $value->art_img ?>" /></a>
              <div class="zixun_gjtb_first_con fr">
                <a target="_blank" href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,16) ?></a>
                <p><?php echo mb_substr($value->art_intro,0,35)?></p>
                <a target="_blank" href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>" class="zixun_gjtb_first_more"></a>
              </div>
            </div>
            <?php }?>
          </div>
        </div>

        <!--专家评测-->
        <div class="zixun_zjpc mrgT18">
          <div class="middle_top">
            <div class="middle_title fl">专家评测</div>
            <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/52' ?>">MORE+</a>
          </div>
          <div class="zixun_zxdt_main">
            <?php foreach($expertReviews as $value){?>
            <div class="zixun_zxdt_path">
              <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>" class="zixun_gjtb_img fl"><img src="<?php echo $value->art_img ?>" /></a>
              <div class="zixun_gjtb_first_con fr">
                <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,16) ?></a>
                <p><?php echo mb_substr($value->art_intro,0,35)?></p>
                <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>" class="zixun_gjtb_first_more"></a>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
      <!--zixun_right-->
    </div>

    <a href="<?php echo !empty($advCentral)&&!empty($advCentral[0])?$advCentral[0]->adv_url:'' ?>" class="zixun_adv"><img src="<?php echo !empty($advCentral)&&!empty($advCentral[0])?$advCentral[0]->adv_imgs:'' ?>" /></a>
    <div class="zixun_second clearfix">
      <div class="zixun_left fl">
        <div class="zixun_second1">
          <!--粉丝会-->
          <div class="left fl">
            <div class="middle_top">
              <div class="middle_title fl">粉丝会</div>
              <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/17' ?>">MORE+</a>
            </div>
            <div class="middle_hot_list pdt14">
			  <?php foreach($fanswill as $value){?>
                  <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
              <?php }?>
            </div>
          </div>

          <!--粉丝会-->
          <div class="right fr">
            <div class="middle_top">
              <div class="middle_title fl">新品活动</div>
              <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/51' ?>">MORE+</a>
            </div>
            <div class="middle_hot_list pdt14">
			  <?php foreach($newEvents as $value){?>
                  <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
              <?php }?>
            </div>
          </div>
        </div>

        <div class="zixun_second3">
          <div class="middle_top">
              <div class="middle_title fl">活动视频</div>
              <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/53'?>">MORE+</a>
          </div>
          <div class="zixun_sphd_main">
            <?php foreach($activeVideo as $value){?>
            <div class="zixun_sphd_path">
              <a href="<?php echo $value->art_url ?>" class="zixun_sphd_img"><img src="<?php echo $value->art_img ?>" /><div class="zixun_sphd_play"></div></a>
              <a href="<?php echo $value->art_url ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
              <div>
<!--                <div class="view fl mrgR16">--><?php //echo $designers[0]->art_views ?><!-- views</div>-->
                <div class="like fl mrgR16" onClick="like(this,'<?php echo $value->art_id  ?>','<?php echo base_url() ?>')"><span><?php echo $value->art_likes ?></span>like</div>
              </div>
            </div>
            <?php }?>
          </div>
        </div>

        <div class="zixun_second4">
          <div class="left fl">
            <div class="middle_top">
              <div class="middle_title fl">设计师</div>
              <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/50'?>">MORE+</a>
            </div>
            <div class="zixun_gjtb_first">
                <div class="zixun_gjtb_first_top clearfix">
                  <a href="<?php echo base_url().'/articleaction/articleDetail/'?><?php echo (!empty($designers) && !empty($designers[0]))?$designers[0]->art_id:'' ?>" class="zixun_gjtb_img fl" ><img src="<?php echo !empty($designers)&& !empty($designers[0])?$designers[0]->art_img:'' ?>" /></a>
                  <div class="zixun_gjtb_first_con fr">
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.!empty($designers)&& !empty($designers[0])?$designers[0]->art_id:'') ?>"><?php echo !empty($designers)&& !empty($designers[0])?mb_substr($designers[0]->art_title,0,18):'' ?></a>
                    <p><?php echo !empty($designers)&& !empty($designers[0])? mb_substr($designers[0]->art_intro,0,50):'' ?></p>
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.!empty($designers)&& !empty($designers[0])?$designers[0]->art_id:'') ?>" class="zixun_gjtb_first_more"></a>
                  </div>
                </div>
                <a class="more fl mrgR16" href="<?php echo base_url().'/articleaction/index/50'?>">more</a>
                <div class="view fl mrgR16"><?php echo !empty($designers)&& !empty($designers[0])?$designers[0]->art_views:'' ?> views</div>
                <div class="like fl mrgR16" onClick="like(this,'<?php echo !empty($designers)&& !empty($designers[0])?$designers[0]->art_id:''  ?>','<?php echo base_url() ?>')"><span><?php  echo !empty($designers)&& !empty($designers[0])? $designers[0]->art_likes:'' ?></span>like</div>
              </div>

              <div class="middle_hot_list">
                <?php
                $designers6 = array_slice($designers,1,7);
                foreach($designers6 as $item){?>
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
                <?php }?>
              </div>
          </div>

          <div class="right fr">
            <div class="middle_top">
              <div class="middle_title fl">明星</div>
              <a class="more1 fr" href="<?php echo base_url().'/articleaction/index/15'?>">MORE+</a>
            </div>
            <div class="middle_hot_list">
                <?php foreach($starArticle as $value){?>
                    <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
                <?php }?>
              </div>
          </div>
        </div>
        <a href="<?php echo !empty($advBottom)&&!empty($advBottom[0])?$advBottom[0]->adv_url:'' ?>" class="zixun_adv1"><img src="<?php echo !empty($advBottom)&&!empty($advBottom[0])?$advBottom[0]->adv_imgs:'' ?>" /></a>
      </div>

      <div class="zixun_right fr">
        <!--news_right_area start-->
        <div class="news_right_area mrgTB2416">
          <a href="#" class="news_right_area1 clearfix">
            <div class="news_right_area_l fl"><img src="/resources/images/news_area1.jpg" /></div>
            <div class="news_right_area_r fr"><div class="news_right_areaText1">艺术家专区</div><div class="news_right_areaText2">艺术家专区</div></div>
          </a>

          <a href="#" class="news_right_area2 clearfix">
            <div class="news_right_area_l fl"><img src="/resources/images/news_area2.jpg" /></div>
            <div class="news_right_area_r fr"><div class="news_right_areaText1">艺术家专区</div><div class="news_right_areaText2">时尚发布网</div></div>
          </a>

          <a href="#" class="news_right_area3 clearfix">
            <div class="news_right_area_l fl"><img src="/resources/images/news_area3.jpg" /></div>
            <div class="news_right_area_r fr"><div class="news_right_areaText1">艺术家专区</div><div class="news_right_areaText2">卡通活动</div></div>
          </a>
        </div>
        <!--news_right_area end-->

        <!--大家都在买什么-->
        <div class="zixun_msm">
          <div class="middle_top">
            <div class="middle_title fl">大家都在买什么</div>
          </div>
          <div class="zixun_msm_main clearfix">
            <ul class="zixun_msm_left fl">
              <li class="cur"><a href="#">全部</a></li>
              <li><a href="#">史努比</a></li>
              <li><a href="#">米菲兔</a></li>
              <li><a href="#">大力水手</a></li>
              <li><a href="#">七喜小子</a></li>
              <li><a href="#">水滴娃娃</a></li>
              <li><a href="#">白雪公主</a></li>
              <li><a href="#">超人</a></li>
            </ul>
            <div class="zixun_msm_right fl">
              <?php for($i=0;$i<8;$i++){?>
              <div class="zixun_msm_path">
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">01</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">02</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">03</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">04</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">05</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">06</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">07</h1><h2>十二种色彩环保袋</h2></a>
                <a href="#" class="zixun_msm_hot"><h1 class="zixun_msm_num">08</h1><h2>十二种色彩环保袋</h2></a>
              </div>
              <?php }?>
            </div>
          </div>
        </div>

        <!--热门专区-->
        <div class="zixun_nwwd">
          <div class="middle_top">
            <div class="middle_title fl">热门专区</div>
          </div>
          <div class="zixun_nwwd_main">
            <div class="middle_hot_list">
              <?php foreach($hotArea as $value){?>
                  <a href="<?php echo base_url('/articleaction/articleDetail/'.$value->art_id) ?>"><?php echo mb_substr($value->art_title,0,30) ?></a>
              <?php }?>
            </div>
          </div>
        </div>

        <!--活动征集-->
        <div class="zixun_hdzj">
          <div class="middle_top">
            <div class="middle_title fl">活动征集</div>
          </div>
          <!--slideBoxIsme start-->
          <div id="slideBox" class="slideBoxIsme">
			<div class="hd">
				<ul><li></li><li></li><li></li></ul>
			</div>
			<div class="bd">
				<ul>
                  <?php for($i=0;$i<3;$i++) {?>
				  <li><a href="#">
                    <img src="<?php echo base_url() ?>resources/img/isme.jpg" />
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
      </div>

    </div>
  </div>
</div>


<!--footer start-->
<?php include_once(APPPATH.'views/publish/footer.php') ?>
<!--footer end-->

</body>
</html>