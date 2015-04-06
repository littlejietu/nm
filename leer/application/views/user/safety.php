<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
  <div class="container">
    <!--center_left start-->
    <?php include_once('center_nav.php')?>
    <!--center_left end-->
    
    <!--center_right start-->
    <div class="centerRight fr" id="centerRight">
      <!--centerRight_top start-->
      <?php include_once('center_top.php')?>
      <!--centerRight_top end-->
      
      <!--centerRight_main start-->
      <div class="centerRight_main centerRightBg" >
        <div class="center_title">安全设置</div>
        <!--center_main start-->
        <div class="center_main">
          <table cellpadding="0" cellspacing="0" class="centerTable">
            <tr height="58">
              <td width="95" valign="top"><font>上次登录：</font></td>
              <td>2014年12月25日  18:00:15</td>
            </tr>
          </table>
          <form onSubmit="submitonce(this);">
          <table cellpadding="0" cellspacing="0" class="centerTable">
            <tr height="58" class="email_form" style="display:none;">
              <td valign="top"><font>登录密码：</font></td>
              <td><input type="password" name="user_mail_pwd" value="" class="centerText fl"  id="email_pwd" onKeyUp="keyupText(this)"/><div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58">
              <td width="95" valign="top"><font id="bdyx">绑定邮箱：</font></td>
              <td><input type="text" name="user_mail" value="<?php if($userInfo->user_mail){echo $userInfo->user_mail;}?>" class="centerText changeText fl" disabled="disabled" id="email" onKeyUp="keyupText(this)"/> <a href="javascript:;" class="change changeEmail fl">修改邮箱</a><div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58" class="email_form" style="display:none;"><td></td><td>
              <input type="button" class="centerBtn fl" value="发送邮件" onClick="return safetyEmailForm('<?php echo base_url()?>');"  style="margin:0 10px 0 0;" id="email_btn"/>
              <input type="button" class="centerBtn emailCancelBtn fl" value="取消" onClick="Cancel(this,'<?php if($userInfo->user_mail){echo $userInfo->user_mail;}?>')"  style="margin:0;background:#ccc;"/></td></tr>
            </table>
            
            <table cellpadding="0" cellspacing="0" class="centerTable">
            <form>
            <tr height="58">
              <td width="95" valign="top"><font id="xgmm">修改密码：</font></td>
              <td><input type="password" name="user_password" value="********" class="centerText changeText fl" disabled="disabled" id="pwd" onKeyUp="keyupText(this)"/> <a href="javascript:;" class="change changePwd fl">修改密码</a><div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58" class="newPwd" style="display:none;">
              <td valign="top"><font>输入新密码：</font></td>
              <td><input type="password" value="" name="user_new_password" class="centerText fl" id="pwdNew" onKeyUp="keyupText(this)"/><div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58"  class="newPwd" style="display:none;">
              <td valign="top"><font>输入确认密码：</font></td>
              <td><input type="password" value="" class="centerText fl" id="pwdSure" onKeyUp="keyupText(this)"/><div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr  height="58" class="newPwd" style="display:none;"><td></td><td><input type="button" class="centerBtn fl" value="确 认" onClick="return safetyPwdForm('<?php echo base_url()?>');" style="margin:0 10px 0 0;"/>
            <input type="button" class="centerBtn pwdCancelBtn fl" value="取消" onClick="Cancel(this,'********')"  style="margin:0;background:#ccc;"/>
            </td></tr>
          </table>
          </form>
        </div>
        <!--center_main end-->
      </div>
      <!--centerRight_main end-->
    </div>
    <!--center_right end-->
    <div class="clear"></div>
    
    <!--middle_second start-->
    <?php include_once('recommend.php')?>
    <!--middle_second end-->
  </div>
  
  
  
</div>


</body>
</html>