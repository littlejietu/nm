<?php include_once(APPPATH.'views/publish/head.php') ?>
<body style="background:#ececec;">
<div class="showBg"></div>
<div class="showList_header">
  <div class="container">
    <a href="#" class="show_logo fl"></a>
    <ul class="show_nav fr">
        <li class="<?php echo empty($hottype)|| $hottype==0?'cur':''?>"><a href="<?php echo base_url().'/showaction/showIndex/0/1'?>">最新</a></li>
        <li class="show_nav_line"></li>
        <li class="<?php echo !empty($hottype)&& $hottype==1?'cur':''?>"><a href="<?php echo base_url().'/showaction/showIndex/1/1'?>">最热门</a></li>
        <li class="show_nav_line"></li>
        <li><a href="<?php echo base_url()?>">返回主站</a></li>
    </ul>
  </div>
</div>
<div class="container">
  <div class="showDet">
    <a href="#" class="showDet_close"></a>
    <a href="#" class="showDet_prev"></a>
    <a href="#" class="showDet_next"></a>
    <div class="showDet_main clearfix">
      <div class="showDet_left fl">
        <div class="showDet_img"><img src="<?php echo $perShow->pre_img ?>" /></div>
        <div class="showDet_mes">
          <img src="<?php echo base_url() ?>resources/img/centerimg3.jpg"  class="showDet_photo fl" />
          <div class="showDet_mes_con fl"><h1><?php echo $perShow->user_name ?></h1><h2><?php echo $perShow->user_province ?> — <?php echo $perShow->user_area ?></h2></div>
          <div class="show_pl fr mrgT19"><?php echo $perShow->pre_comment ?></div>
          <a href="javascript:;" class="show_like fr mrgT19"><?php echo $perShow->pre_likes ?></a>
        </div>
      </div>
      <div class="showDet_right fl">
        <div class="showDet_right_top"><?php echo $perShow->pre_title ?></div>
        <div class="showDet_right_see">
          <h1>谁看过我</h1>
          <div class="showDet_right_see_main">
              <?php if(!empty($personalShowBrowse)){
                  foreach($personalShowBrowse as $value)
                  {
               ?>
              <img src="<?php echo $value->user_photo ?>" />
          <?php
                  }
              }?>
          </div>
        </div>
        <div class="showDet_right_pl">
           <form action="<?php echo base_url(); ?>/showaction/addPersonalShowGuestbook">
               <input type="hidden" name="preId" value="<?php echo $perShow->pre_id ?>" />
               <input type="hidden" name="hottype" value="<?php echo $hottype ?>" />
               <input type="hidden" name="psgid" value="" />
          <!--已有评论-->
          <div id="vertical3" class="scrollbox3 clearfix">
  			<div class="slyWrap3 example2">
   			  <div class="scrollbar3">
        		<div class="handle"></div>
    		  </div>
   		     <div class="sly3" data-options='{ "scrollBy": 100, "startAt": 0 }'>
               <div>
                 <?php foreach($personalshowguestbook as $value) {?>
                 <div class="showDet_right_pl_path clearfix">
                   <img src="<?php echo $value->user_image ?>" class="showDet_right_pl_photo fl"/>
                   <div class="showDet_right_pl_con fl">
                     <div><span class="pl_name"><?php echo $value->user_name ?></span><span class="showDet_right_pl_date"><?php echo date('y-d-m',$value->add_time) ?></span></div>
                     <div><?php echo $value->psg_comment ?></div>
                   </div>
                     <?php if(empty($value->psg_reply) && $perShow->user_id==$_SESSION['user_id']){ ?>
                   <a href="javascript:;" onclick="showDetHf('<?php echo $value->user_name ?>','<?php echo $value->psg_id ?>')"  class="showDet_right_pl_btn" >回 复</a>
                     <?php } ?>
                 </div>
                    <?php  if(!empty($value->psg_reply)){?>
                 <div class="showDet_right_pl_path clearfix">
                   <img src="<?php echo base_url() ?>resources/img/add.jpg" class="showDet_right_pl_photo fl"/>
                   <div class="showDet_right_pl_con fl">
                     <div><?php echo $perShow->user_name ?><span class="showDet_right_pl_date">回复<?php echo $value->user_name ?></span></div>
                     <div><?php echo $value->psg_reply ?></div>
                   </div>
<!--                   <a href="javascript:;" onclick="showDetHf('玻璃球丶')" class="showDet_right_pl_btn">回 复</a>-->
                 </div>
                 <?php }}?>
          	   </div>
    	      </div>
            </div>
          </div>
          <!--已有评论-->
          <!--评论-->
          <div class="showDet_pl">
              <input type="text" name="txtcontent" value="我要留言" onBlur="blurText(this,'我要留言')" onFocus="focusText(this,'我要留言')" class="showDet_pl_text fl" id="lyText"/>
              <input type="submit" value="回复" class="showDet_pl_btn fl"/>
          </div>
          <!--评论-->
           </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>