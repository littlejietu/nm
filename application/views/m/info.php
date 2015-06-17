<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>资料-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include_once(VIEWPATH."m/public/left_menu.php");?>
            <div class="fr uc_content">
            	<?php include_once(VIEWPATH."m/public/notice.php");?>
                <div class="clearfix uitopg">
                	<div class="fl um_uitop">
                    <form method="post" action="" id="xtform">
                   	  <div class="authent">
                   	    <div class="aut_bti">个人资料</div>
                          <?php echo validation_errors('<div class="error">', '</div>');?>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                           	  <tr>
                               	  <td><a href="javascript:;" id="XT-info-base">基本信息</a>&nbsp;&nbsp;<a href="javascript:;" id="XT-info-pic">图片设置</a></td>
                              </tr>
                          </table>
                          <?php
                          if($o['usertype']==1)
                            include_once(VIEWPATH."m/public/info_model_inc.php");
                          else if(in_array($o['usertype'], array(4,5)) )
                            include_once(VIEWPATH."m/public/info_photo_inc.php");
                          ?>
                            <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0" id="tb-XT-info-pic" style="display:none">
                              <tr>
                                <tr>
                                <td width="86">形象照片</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="showimg" id="showimg" value="<?=$o['showimg']?>">
                                        <em><i class="icoPro16"></i>请上传黑白照片, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="showimg_upload" name="showimg_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div><br>
                                    <div id="show_showimg">
                                        <?php if($o['showimg']):?>
                                          <a href="<?='/'.$o['showimg']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                    
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="showimg2" id="showimg2" value="<?=$o['showimg2']?>">
                                        <em><i class="icoPro16"></i>请上传彩色照片, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="showimg2_upload" name="showimg2_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_showimg2">
                                        <?php if($o['showimg2']):?>
                                          <a href="<?='/'.$o['showimg2']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php if($o['usertype']==1):?>
                               <tr>
                                <td width="86">模特卡</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="card" id="card" value="<?=$o['card']?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="card_upload" name="card_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_card">
                                        <?php if($o['card']):?>
                                          <a href="<?='/'.$o['card']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php endif?>
                              <tr>
                                <td width="86">主页背景图</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="bgimg" id="bgimg" value="<?=$o['bgimg']?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="bgimg_upload" name="bgimg_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                    <div id="show_bgimg">
                                        <?php if($o['bgimg']):?>
                                          <a href="<?='/'.$o['bgimg']?>" target="_blank">查看</a>
                                        <?php endif?>
                                    </div>
                                </td>
                              </tr>
                              <?php if($o['usertype']==1):?>
                              <tr>
                                <td width="86">视频</td>
                                <td colspan="3">
                                    <div class="f_note">
                                        <p>尺寸：248×324像数</p>
                                        <input type="hidden"  name="video" id="video" value="<?=$o['video']?>">
                                        <em><i class="icoPro16"></i>在个人主页上显示, 上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="video_upload" name="video_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <?php endif?>
                          </table>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0" id="tb-XT-info-pic">
                          <tr style="border-bottom:none;">
                                <td style="height:80px">&nbsp;</td>
                                <td colspan="3">
                                    <input name="submit" type="submit" class="but" value="提交"/>
                                    <input name="" type="button" class="but but_reset" value="重置"/>
                                </td>
                              </tr>
                          </table>
                        </div>
                      </form>
                    </div>
                    <div class="fr um_wind">
                    	<?php include_once(VIEWPATH."m/public/right.php");?>
                    </div>
                </div>
            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>data/area.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('lib')?>data/multiselect.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/info.js"></script>

<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">


<?php $timestamp = $this->timestamp;?>
$(function() {
  setTimeout(function(){
    $('#userlogo_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : "<?php echo md5($this->config->item('encryption_key') . $timestamp );?>",
        'type' : 'userlogo',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi' : false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#userlogo').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#userlogo').val(imgpath);
          $('#userlogo').nextAll('em').html('<i class="icoCor16"></i>');
          $('#show_userlogo').attr('src','/'+imgpath);
        }
      }

    });
    $('#showimg_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'showimg',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi' : false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#showimg').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#showimg').val(imgpath);
          $('#showimg').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_showimg').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_showimg').html('保存后可查看');
        }
      }

    });
    $('#showimg2_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'showimg',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi' : false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#showimg2').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#showimg2').val(imgpath);
          $('#showimg2').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_showimg2').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_showimg2').html('保存后可查看');
        }
      }

    });
    $('#card_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'card',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi':false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#card').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#card').val(imgpath);
          $('#card').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_card').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_card').html('保存后可查看');
        }
      }

    });
    $('#bgimg_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'bgimg',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择照片',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi':false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#bgimg').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#bgimg').val(imgpath);
          $('#bgimg').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_bgimg').html('<a href="/'+imgpath+'" target="_blank">查看</a>');
          $('#show_bgimg').html('保存后可查看');
        }
      }

    });
   $('#video_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
        'type' : 'video',
        'uid' : <?php echo $this->loginID;?>
      },
      'auto':true,
      //'buttonClass':'inp_btn',
      'fileSizeLimit' : '1024KB',
      'buttonText':'选择视频',
      'fileTypeExts': '*.jpg;*.png;*.jpeg',
      //'buttonImage' : '{$js_url}uploadify/button.png',
      'swf'      : '<?php echo _get_cfg_path("lib")?>uploadify/uploadify.swf',
      'uploader' : '/public/upload/uploadimg',
      'multi':false,
      'onUploadSuccess' : function(file, data, response) {
        if (!data){
         alert('上传失败');
         return;
        }
        data = data.split('|');
        if (data[0] == 100){
          $('#video').nextAll('em').html('<i class="icoErr16"></i>'+data[1]);
        }else if(data[0] == 200 && data[1]!=''){
          var imgpath=data[1];
          $('#video').val(imgpath);
          $('#video').nextAll('em').html('<i class="icoCor16"></i>');
          //$('#show_video').attr('src','/'+imgpath);
        }
      }

    });
  },10);
});
</script>
</html>