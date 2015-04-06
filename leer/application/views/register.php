<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>C2M用户工厂</title>
<link href="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/css/base.css" rel="stylesheet" type="text/css" />
<link href="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/css/common.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="loginBg">
  <div id="loginBox">
    <div class="welcome"></div>
    <div class="login_main">
      <form action="<?php echo base_url()?>useraction/registerFuc" method="post">
      <!--textBox start-->
      <div class="textBox"><div class="login_text">
        <div class="user_text"></div>
        <input type="text" value="用户名ID" class="loginText" id="user" name="user_name" onblur="blurText(this,'用户名ID')" onfocus="focusText(this,'用户名ID')" onKeyUp="keyupText(this)"/>
        <div class="tips" <?php if($tips){echo 'style="display:inline"';}?>><span><?php if($tips){echo $tips;}?></span></div>
      </div></div>
      <!--textBox end-->
      
      <!--textBox start-->
      <div class="textBox"><div class="login_text">
        <div class="email_text"></div>
        <input type="text" value="邮箱email" class="loginText" id="email" name="user_email"  onblur="blurText(this,'邮箱email')" onfocus="focusText(this,'邮箱email')" onKeyUp="keyupText(this)"/>
        <div class="tips"><span></span></div>
      </div></div>
      <!--textBox end-->
      
      <!--textBox start-->
      <div class="textBox"><div class="login_text">
        <div class="pwd_text"></div>
        <input type="text" value="密码Password" class="loginText" onblur="blurText(this,'密码Password','showpwd')" onfocus="focusText(this,'密码Password','showpwd')" />
        
        <input type="password" value="" class="loginText" id="pwd"  name="user_password" onblur="blurText(this,'密码Password','pwd')" onfocus="focusText(this,'密码Password','pwd')" style="display:none;" onKeyUp="keyupText(this)"/>
        <div class="tips"><span></span></div>
      </div></div>
      <!--textBox end-->
      
      <!--textBox start-->
      <div class="textBox"><div class="login_text">
        <div class="pwd_text"></div>
        <input type="text" value="确认密码Confirm Password" class="loginText"  onblur="blurText(this,'确认密码Confirm Password','showpwd')" onfocus="focusText(this,'确认密码Confirm Password','showpwd')" />
        
        <input type="Password" value="" class="loginText" id="conpwd" name="user_password_confirm"  onblur="blurText(this,'确认密码Confirm Password','pwd')" onfocus="focusText(this,'确认密码Confirm Password','pwd')" style="display:none;" onKeyUp="keyupText(this)"/>
        <div class="tips"><span></span></div>
      </div></div>
      <!--textBox end-->
      
      <!--login_btn start-->
      <div class="login_btn">
        <input type="submit" value="注 册" class="loginBtn fl" onclick="return regForm();" id="regBtn"/>
        <a href="<?php echo base_url()?>login.html" class="loginBtn fl">登 录</a>
      </div>
      <!--login_btn end-->
      </form>
    </div>
  </div>
  
  <?php include_once('publish/login_bottom.php') ?>
</div>

<script type="text/javascript" src="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/js/common.js"></script>
<script type="text/javascript" src="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/js/form.js"></script>
<!--[if IE 6]>
<script src="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/js/DDPngMin.js"></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
</body>
</html>