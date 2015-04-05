<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>index</title>
    <link href="<?php echo base_url();?>resources/backstage/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>resources/backstage/css/login.css" rel="stylesheet">
    <script language="javascript" src="<?php echo base_url();?>resources/backstage/js/jquery-1.8.0.min.js"></script>
	<script language="javascript" src="<?php echo base_url();?>resources/backstage/js/main.js"></script>
	<script language="javascript" src="<?php echo base_url();?>resources/backstage/js/user.js"></script>
	<script language="javascript" src="<?php echo base_url();?>resources/backstage/js/ajax.js"></script>
    <script language="javascript" src="<?php echo base_url();?>resources/backstage/js/common.js"></script>
</head>
<script type="text/javascript">
document.onkeydown=function(event){
	var e = event || window.event || arguments.callee.caller.arguments[0];
	 if(e && e.keyCode==13){//回车登录
		 ajaxLogin('<?php echo base_url()?>');
	}
}; 
</script>
<body>
<div id="login">
    <div class="login_top">
        <div class="clearfix logincon">
            <div class="fl">
            <img width="147" height="43" src="<?php echo base_url();?>resources/backstage/image/logo.png" alt="logo">
            </div>
            <div class="fr">
             <a class="lb_link" target="_blank" href="http://121.41.91.103:81">CTM用户工厂官网</a>
            </div>
        </div>
    </div>
    
    <div class="login_con">
        <div class="clearfix logincon">
            <div class="fl flimg"></div>
            <div class="fr login">
                <div class="loginbox">
    
                        <h3> 登录用户工厂后台中心</h3>
    
                        <p class="field">
                            <label><img src="<?php echo base_url();?>resources/backstage/image/field_1.jpg"/></label>
                            <input class="user" type="text" id="loginUser"  placeholder="用户名" />
                        </p>
    
                        <p class="field">
                            <label><img src="<?php echo base_url();?>resources/backstage/image/field_2.jpg"/></label>
                            <input class="pass" type="password" id="loginPassword"  placeholder="密码" />
                        </p>
                        
                        <p class="field" style="width:150px;float:left;">
                            <label><img src="<?php echo base_url();?>resources/backstage/image/field_3.jpg"/></label>
                            <input class="code" type="text" id="loginCode" placeholder="验证码" style="width:85px;"/>
                            
                        </p>
                        <div id="codeimg" class="codeimg fl" onClick="javascript:ajaxGetVerify('<?php echo base_url()?>');"><?php echo $code['image'];?></div><span id="error_code"></span>
    
                        <div class="but fl" onClick="javascript:ajaxLogin('<?php echo base_url()?>');">登&nbsp;录</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="login_copyt">
    Copyright©2014 c2mmall.com 浙ICP备 15002230号 全案策划：<a target="_blank" href="http://www.lebang.com/"> LEBANG . com</a>
    </div>
    
    <span class="error"></span>
</div>
<?php include_once('publish/foot.php');?>
