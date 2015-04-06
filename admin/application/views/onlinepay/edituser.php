<?php include_once("right_head.php")?>
<div class="common">
    <div class="ban">
        <a href="<?php echo base_url();?>index.php/useraction/index">返回列表</a>
    </div>
    <div class="adduser">
      <table class="addTable" >
        <tr>
          <td align="right">用户名：</td><td><input id="username" value="<?php echo $userInfo->user_name?>" must="ture"><span class="tips">*</span></td>
          <td align="right">邮箱：</td><td><input id="email" value="<?php echo $userInfo->user_email?>"></td>
        </tr>
        <tr>
          <td align="right">密码：</td><td><input type="password" id="userpassword" must="ture"><span class="tips">*</span></td>
          <td align="right">重复密码：</td><td><input type="password" id="userpasswordreset" must="ture"><span class="tips">*</span></td>
        </tr>
        <tr>
          <td align="right">手机：</td><td><input id="tel" value="<?php echo $userInfo->user_tel?>"></td>
          <td align="right">真实姓名：</td><td><input id="realname" value="<?php echo $userInfo->user_real_name?>"></td>
        </tr>
        <tr>
          <td valign="top" align="right">级别：</td>
          <td colspan="3">
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="1" <?php if($userInfo->user_level==1){echo 'checked ="checked"';}?>>超级管理员</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="2" <?php if($userInfo->user_level==2){echo 'checked ="checked"';}?>>普通管理员</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="3" <?php if($userInfo->user_level==3){echo 'checked ="checked"';}?>>渠道商</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="4" <?php if($userInfo->user_level==4){echo 'checked ="checked"';}?>>代理1</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="5" <?php if($userInfo->user_level==5){echo 'checked ="checked"';}?>>代理2</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="6" <?php if($userInfo->user_level==6){echo 'checked ="checked"';}?>>代理3</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="7" <?php if($userInfo->user_level==7){echo 'checked ="checked"';}?>>代理4</label>
            <label class="right_label"><input type="radio" name="userstep" class="userpower" value="8" <?php if($userInfo->user_level==8){echo 'checked ="checked"';}?>>代理5</label>
          </td>
        </tr>
        <tr>
          <td></td>
          <td colspan="3"><span class="sub" onClick="return subForm(editUser(<?php echo $userInfo->user_id?>));" style=" text-align: center">提&nbsp;&nbsp;交</span></td>
        </tr>
      </table>
    </div>

</div>
</body>
</html>