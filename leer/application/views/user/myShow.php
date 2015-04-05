<?php include_once(APPPATH . 'views/publish/head.php') ?>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/jquery.imgareaselect.js"></script>
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
            <div class="centerRight_main centerRightBg" >
              <div class="center_title">秀空间</div>
              <!--center_main start-->
              <div class="center_main">
              <div class="myShow_upload">
                  <form id="crop_form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>/useraction/addMyShow">
                  <input type="hidden" name="act" value="<?php echo !empty($act)?'edit':'add'  ?>">
                  <input type="hidden" name="preid" value="<?php echo !empty($preid)?$preid:''  ?>">
                <div class="myShow_Text clearfix">
                  <h1 class="fl">标题：</h1><input name="pretitle" class="centerText fl" type="text" value=""><div class="tips purple_tips fl" id="titleTips"><span></span></div>
                </div>
                  <div class="myShow_img clearfix">
                    <div class="portrait_left">
                    <div id="localImag"><img id="preview" src="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/images/4.png"  /></div>
                     <!--通过生成尺寸和旋转角度 后台获取尺寸和旋转角度再进行裁剪-->
                    <input id="id_top" type="hidden" name="top" value="90">  <!--y轴-->
                    <input id="id_left" type="hidden" name="left" value="55"><!--x轴-->
                    <input id="id_right" type="hidden" name="right" value="270"><!--w轴-->
                    <input id="id_bottom" type="hidden" name="bottom" value="165"><!--h轴-->
                    <input id="rotation" type="hidden" value="0" name="rotation">
                    <div class="setup_but">
                    <input type="submit" class="baseinf_but1" onClick="return uploadForm();" value="确定"/>
                    </div>

                  </div>
                  <div class="myShow_btn fl">
                    <div class="tips purple_tips" id="imgTips"><span></span></div>
                    <div class="filer_box">
                        <input class="filer_btn" type="button" value="选择文件">
                        <input id="Member_headimg" class="filer" type="file" value="" name="preimg"  >
                    </div>
                   
                    <div class="center_photoTip">仅支持JPG、gif、png图片文件，且文件小于2M（文件尺寸：620*380）</div>
                    </div>
                 </div>
                  </form>
              </div>
              <div class="center_title">已上传的图片</div>
              <div class="myShow_list clearfix">
                <?php foreach($showList as $value) {?>
                <div class="myShow_path">
                  <img src="<?php echo $value->pre_img ?>" />
                  <div class="myShow_con">
                    <div class="fl"><?php echo mb_substr($value->pre_title,0,10)?><span><?php echo date('Y-m-d',$value->last_time)?></span></div>
                    <a class="centerRight_right_car_det fr" href="javascript:;" onClick="showDelete(this,'<?php echo base_url()?>','<?php echo $value->pre_id ?>')"><div class="centerRight_right_car_detTip" >删除</div></a>
                  </div>
                </div>
                <?php }?>
              </div>
              <div class="page clearfix pageCenter">
             <?php echo $showHtml ?>
              </div>
            </div>
              <!--center_main end-->
            </div>
        </div>
        <!--center_right end-->
        <div class="clear"></div>
        <!--middle_second start-->
        <?php include_once('recommend.php') ?>
        <!--middle_second end-->
    </div>
</div>
</div>

</body>
</html>