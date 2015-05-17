<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的认证-机构中心-牛模网</title>
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
                          <div class="aut_bti">我的认证</div>
                            <table class="aut_tab" width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody><tr>
                                  <td width="86">真实姓名</td>
                                  <td><input name="" type="text" class="txt" placeholder="请输入姓名"></td>
                                </tr>
                                <tr>
                                  <td>身份证号</td>
                                  <td><input name="" type="text" class="txt" placeholder="请输入身份证号"></td>
                                </tr>
                                <tr>
                                  <td>手机号码</td>
                                  <td><input name="" type="text" class="txt" placeholder="请输入手机号码"></td>
                                </tr>
                                <tr>
                                  <td>身份证照片</td>
                                  <td>
                                      <div class="filebox">
                                          <form action="" method="post" enctype="multipart/form-data">
                                              <input class="inp_txt" id="textfile" type="text" name="" value="" placeholder="请上传身份证扫描件">  
                                              <input class="inp_btn" type="button" name="" value="本地上传">
                                              <input class="inp_file" type="file" name="" size="28" onchange="document.getElementById('textfile').value=this.value">
                                          </form>
                                      </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>所属经纪公司</td>
                                  <td><input name="" type="text" class="txt" placeholder="请输入所属经纪公司"></td>
                                </tr>
                                <tr>
                                  <td>认证保证金</td>
                                  <td><input class="money" type="text" value="¥ 1000" disabled=""><span class="remark">备注：保证金在注销账号时，返予您的账户。</span></td>
                                </tr>
                                <tr style="border-bottom:none;">
                                  <td style="height:80px">&nbsp;</td>
                                  <td><input name="" type="button" class="but" value="前去缴纳"></td>
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

</html>