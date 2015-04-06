<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>C2M用户工厂</title>
<link href="<?php echo base_url()?>resources/css/base.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>resources/css/common.css" rel="stylesheet" type="text/css" />

</head>

<body id="loginForm">
<div id="loginBg">
  <div id="loginBox">
    <div class="welcome"></div>
    <div class="login_main">
        <form>
      <!--textBox start-->
      <div class="textBox"><div class="login_text">
        <div class="user_text"></div>
        <input type="text" value="用户名ID"  class="loginText" id="user" name="username" onblur="blurText(this,'用户名ID')" onfocus="focusText(this,'用户名ID')" onKeyUp="keyupText(this)"/>
              <div class="tips" <?php if(!empty($tips_user) or !empty($tips_lock)){echo 'style="display:inline"';}?>><span><?php if(!empty($tips_user)){echo $tips_user;}elseif(!empty($tips_lock)){echo $tips_lock;}?></span></div>
      </div>
       
      </div>
      <!--textBox end-->
      <!--textBox start-->
      <div class="textBox">
        <div class="login_text fl">
          <div class="pwd_text"></div>
          <input type="text" value="密码Password" class="loginText"  onblur="blurText(this,'密码Password','showpwd')" onfocus="focusText(this,'密码Password','showpwd')" />
        
          <input type="password" value="Password" class="loginText" id="pwd" name="password" onblur="blurText(this,'Password','pwd')" onfocus="focusText(this,'Password','pwd')" style="display:none;" onKeyUp="keyupText(this)"/>
          <div class="tips" <?php if(!empty($tips_work)){echo 'style="display:inline"';}?>><span><?php if(!empty($tips_work)){echo $tips_work;}?></span></div>
          <div class="lock" id="lock">
            <div class="tips" id="lockTip"><span>记住密码</span></div>
            <input type="hidden" value="" name="is_remember" />
          </div>
          <div class="clear"></div>
        </div>
      
        <a href="javascript:;" class="forgetPwd fl"><p>忘记密码？</p>
          <div class="forgetPwd_main">
            <div class="forgetPwd_jt"></div>
            <div class="forgetPwd_con">
              <input type="text" value="请输入用户名"  class="forgetPwdText" onblur="blurText(this,'请输入用户名')" onfocus="focusText(this,'请输入用户名')"  onKeyUp="keyupText(this)" id="forgetPwd_user"/>
              <input type="text" value="请输入绑定邮箱"  class="forgetPwdText" onblur="blurText(this,'请输入绑定邮箱')" onfocus="focusText(this,'请输入绑定邮箱')"  onKeyUp="keyupText(this)" id="forgetPwd_email" style="margin:0 0 7px 0;"/>
              <div class="tips"></div>
              <input type="button" onclick="forgetPwd('<?php echo base_url()?>')" class="forgetPwdBtn" value="发送邮件"/>
            </div>
          </div>
        </a>
      </div>
      <!--textBox end-->
      <!--login_btn start-->
      <div class="login_btn">
        <input type="button" value="登 录" class="loginBtn fl" onclick="return loginForm('<?php echo base_url()?>');" id="loginBtn"/>
        <a href="<?php echo base_url()?>useraction/register" class="loginBtn fl">注 册</a>
        <a href="#" class="loginBtn loginBtn_qq fl"></a>
        <a href="#" class="loginBtn loginBtn_sina fl"></a>
      </div>
      <!--login_btn end-->
      </form>
    </div>
  </div>
  
  <?php include_once('publish/login_bottom.php') ?>
</div>

<script type="text/javascript" src="<?php echo base_url()?>resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/form.js"></script>
<!--[if IE 6]>
<script src="<?php echo base_url()?>resources/js/DDPngMin.js"></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
</body>
</html>