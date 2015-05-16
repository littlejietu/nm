<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>评论管理-个人中心-牛模网</title>
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
                    <div class="transa">
                        <div class="aut_bti">评论管理</div>
                        <table class="tran_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <th>留言</th>
                              <th width="180">操作</th>
                            </tr>
                        </tbody></table>
                        <ul class="tran_tab">
                        <?php foreach ($list['rows'] as $key => $a): ?>
                                                    <li class="clearfix t_review">
                              <div class="em_rit fl">
                                   <div class="apprtop">

                                       <div class="fl a_rev"><span>身材尺寸：</span><p class="star_on"><i class="star_<?=$a['figure'];?>">5</i></p></div>
                                       <div class="fl a_rev"><span>专业技能：</span><p class="star_on"><i class="star_<?=$a['skill'];?>">5</i></p></div>
                                       <div class="fl a_rev"><span>工作效率：</span><p class="star_on"><i class="star_<?=$a['efficiency'];?>">5</i></p></div>
                                       <div class="fl a_rev" style="margin-right:0;"><span>服务态度：</span><p class="star_on"><i class="star_<?=$a['attitude'];?>">5</i></p></div>
                                   </div>

                                   <div class="apprcon"><?=$a['memo'];?></div>
                                   <div class="clearfix">
                                        <span class="fl"><?php echo $a['nickname'];?></span><em class="fr"><?php echo date('Y-m-d H:i:s',$a['addtime']);?></em>       
                                   </div>
                                </div>
                                <div class="fl operat"><a class="t_delete" href="javascript:;"><i></i>回复</a></div>
                                <a class="t_editor fr" href="javascript:;" onclick="alertWin(this)"><i></i>投诉</a>
                                <div style="clear:both"></div>
                                <div class="fabiao reply">
                                  <textarea id="starcontent" name="content" cols="" class="texta" placeholder="谢谢哦，下次有机会继续合作哦~~"></textarea>
                                    <br><br>
                                    <input name="" type="submit" class="but" value="创建"><input name="" type="submit" class="but but_2" value="取消">
                                </div>
                            </li>
                            <?php endforeach;?>
                            </ul>
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