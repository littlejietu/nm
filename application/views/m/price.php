<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>服务价格-个人中心-牛模网</title>
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
                      <div class="authent">
                        <div class="aut_bti">服务价格</div>
                          <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                <td width="86" valign="top"><font>工作内容：</font></td>
                                <td colspan="3" valign="top" class="price">
                                  <?php foreach ($workitem as $key => $v): ?>
                                    <span><input type="checkbox" name="item" value="<?=$key?>" id="item<?=$key?>"><label for="item<?=$key?>"><?=$v?></label></span>
                                  <?php endforeach;?> 
                                </td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作场景：</font></td>
                                <td colspan="3" valign="top" class="price">
                                  <?php foreach ($workscene as $key => $v): ?>
                                    <span><input type="radio" name="scene" value="<?=$key?>" id="time<?=$key?>"><label for="time<?=$key?>"><?=$v?></label></span>
                                  <?php endforeach;?> 
                                </td>
                              </tr>
                              <tr>
                                <td width="86">计价方式：</td>
                                <td colspan="3" class="price">
                                  <?php foreach ($worktime as $key => $v): ?>
                                    <span><input type="radio" name="time" value="<?=$key?>" id="time<?=$key?>"><label for="time<?=$key?>"><?=$v?></label></span>
                                  <?php endforeach;?> 
                                </td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td style="height:80px">&nbsp;</td>
                                <td colspan="3">
                                    <input name="btn" id="XT-Add" type="button" class="but" value="添加">
                                    <input name="" type="button" class="but but_reset" value="重置">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">服装拍摄 + 外景 + 天 </td>
                                <td colspan="2" align="right"><input name="" type="text" class="txt txt_price" value="¥ 150.00"></td>
                              </tr>
                          </tbody></table>
                        </div>
                    </div>
                    <div class="fr um_wind">
                      <div class="uw_help">
                          <div class="uwh_title"><h3></h3><span><i></i>我的档期</span></div>
                            <div class="u_circle">
                              <a href="##"><h3>档期小助手</h3><p>方便 快捷 明确</p></a>
                            </div>
                        </div>
                        <div class="uw_help">
                          <div class="uwh_title"><h3></h3><span><i></i>热门推荐</span></div>
                            <div class="u_recom">
                              <ul class="clearfix">
                                                                    <li><a href="##"><img src="images/h_1.jpg"></a></li>
                                                                      <li><a href="##"><img src="images/h_1.jpg"></a></li>
                                                                      <li><a href="##"><img src="images/h_1.jpg"></a></li>
                                                                      <li><a href="##"><img src="images/h_1.jpg"></a></li>
                                                                      <li><a href="##"><img src="images/h_1.jpg"></a></li>
                                                                      <li><a href="##"><img src="images/h_1.jpg"></a></li>
                                                                    </ul>
                            </div>
                        </div>
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
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/info.js"></script>
<script src="<?php echo _get_cfg_path('lib')?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">
<?php $timestamp = $this->timestamp;?>
$(function() {
    $('#userlogo_upload').uploadify({
      'formData'     : {
        'timestamp' : '<?php echo $timestamp;?>',
        'token'     : '<?php echo md5($this->config->item('encryption_key') . $timestamp );?>',
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
});
</script>
</html>