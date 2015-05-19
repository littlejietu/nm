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
                               	  <td colspan="4">基本信息</td>
                              </tr>
                              <tr>
                                <td width="86"><span class="tips">*</span>昵  称</td>
                                <td colspan="3">
                                  <?php if(!empty($o['nickname'])) 
                                          echo $o['nickname']; 
                                        else
                                          echo '<input name="nickname" type="text" class="txt" placeholder="请输入昵称"/>';

                                  ?>
                                  <?php //echo form_error('nickname');?>
                                  </td>
                              </tr>
                              <tr>
                                <td width="86">头  像</td>
                                <td colspan="3">
                                    <div id="previews" class="drsMoveHandle">
                                   	    <img id="show_userlogo" border=0 src='<?php echo $o['userlogo']? '/'.$o['userlogo'] : _get_cfg_path('images').'imghead.jpg';?>'>
                                    </div>
                                    <div class="f_note">
                                        <p>尺寸：90×90像数</p>
                                        <input type="hidden"  name="userlogo" id="userlogo" value="<?=$o['userlogo']?>">
                                        <em><i class="icoPro16"></i>仅支持JPEG，上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="userlogo_upload" name="userlogo_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="86">真实姓名</td>
                                <td><input name="realname" type="text" value="<?=$o['realname']?>" class="txt" placeholder="请输入姓名"/><?php //echo form_error('realname');?></td>
                                <td><span class="tips">*</span>身高</td>
                                <td><input name="height" type="text" class="txt" value="<?=$o['height']?>" placeholder="请输入身高"/> cm<?php //echo form_error('height');?></td>
                              </tr>
                              <tr>
                                <td>性别</td>
                                <td class="reg-sort">
                                	<p><input type="radio" name="sex" value="1" <?php if($o['sex']==1) echo 'checked';?> id="sort_1"/><label for="sort_1">男</label></p>
                        			<p><input type="radio" name="sex" value="2" <?php if($o['sex']==2) echo 'checked';?> id="sort_2"/><label for="sort_2">女</label></p>
                                </td>
                                <td><span class="tips">*</span>体重</td>
                                <td><input name="weight" type="text" class="txt" value="<?=$o['weight']?>" placeholder="请输入体重"/> Kg</td>
                              </tr>
                              <tr>
                                <td>所在城市</td>
                                <td><input name="city" type="text" class="txt" value="<?=$o['city']?>" placeholder="请输入你所在城市"/></td>
                                <td><span class="tips">*</span>三围</td>
                                <td><input name="BWH" type="text" class="txt" value="<?=$o['bust'].'-'.$o['waist'].'-'.$o['hips']?>" placeholder="请输入你的三围"/>以-组合</td>
                              </tr>
                              <tr>
                                <td>罩杯</td>
                                <td><input name="cup" type="text" class="txt" value="<?=$o['cup']?>" placeholder="请输入你的罩杯"/>B</td>
                                <td>鞋码</td>
                                <td><input name="shoes" type="text" class="txt" value="<?=$o['shoes']?>" placeholder="请输入你的鞋码"/>码</td>
                              </tr>
                               <tr>
                               	  <td colspan="4">个人经历</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>平面拍摄</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="planeshot" cols="" rows=""><?=$o['planeshot']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>获得奖项</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你获得的奖项" name="awards" cols="" rows=""><?=$o['awards']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>T台活动</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你获得的奖项" name="tactivity" cols="" rows=""><?=$o['tactivity']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>影视广告1</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="telead" cols="" rows=""><?=$o['telead']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>杂志拍摄</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="magazine" cols="" rows=""><?=$o['magazine']?></textarea></td>
                              </tr>
                              <tr>
                                 <td>视频地址</td>
                                <td><input name="video" type="text" class="txt" value="<?=$o['video']?>" placeholder="请输入你拍摄过的品牌"/></td>
                              </tr>
                               <!-- <tr>
                                <td width="86" valign="top"><font>拍摄品牌1</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="brand" cols="" rows=""><?=$o['brand']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>品牌类型2</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌类型"  name="brandtype" cols="" rows=""><?=$o['brandtype']?></textarea></td>
                              </tr>  -->
                              
                              <tr>
                                  <td colspan="4">服务说明</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>模特费</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="fee" cols="" rows=""><?=$o['fee']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>服务时间</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="servicetime" cols="" rows=""><?=$o['servicetime']?></textarea></td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td width="86" valign="top"><font>禁拍说明</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="" name="takenote" cols="" rows=""><?=$o['takenote']?></textarea></td>
                              </tr>
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
                    	<div class="uw_help">
                        	<div class="uwh_title"><h3></h3><span><i></i>我的档期</span></div>
                            <div class="u_circle">
                            	<a href="/i/schedule/<?=$this->loginID?>"><h3>档期小助手</h3><p>方便 快捷 明确</p></a>
                            </div>
                        </div>
                        <div class="uw_help">
                        	<div class="uwh_title"><h3></h3><span><i></i>热门推荐</span></div>
                            <div class="u_recom">
                            	<ul class="clearfix">
                                	<?php for($i=0;$i<6;$i++){?>
                                	<li><a href="##"><img src="<?php echo _get_cfg_path('images')?>h_1.jpg"/></a></li>
                                    <?php }?>
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