<?php include_once("right_head.php")?>
<div class="common">
    <div class="ban">
        <a href="<?php echo base_url();?>index.php/useraction/index">返回列表</a>
    </div>
    <div class="adduser">
       <table class="addTable" >
        <tr>
          <td align="right">用户名：</td><td><input id="username" value="" must="ture" class="normalText" /><span class="tips">*</span></td>
          <td align="right">邮箱：</td><td><input id="email" value="" ></td>
        </tr>
        <tr>
          <td align="right">密码：</td><td><input type="password" id="userpassword" must="ture" class="normalText" /><span class="tips">*</span></td>
          <td align="right">重复密码：</td><td><input type="password" id="userpasswordreset" must="ture" class="normalText" /><span class="tips">*</span></td>
        </tr>
        <tr>
          <td align="right">手机：</td><td><input id="tel" value="" class="normalText" /></td>
          <td align="right">真实姓名：</td><td><input id="realname" class="normalText" /></td>
        </tr>
        <tr>
          <td valign="top" align="right">级别：</td>
          <td colspan="3">
        	<label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="1">超级管理员</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="2">普通管理员</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="3">渠道商</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="4">代理1</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="5">代理2</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="6">代理3</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="7">代理4</label>
            <label class="normalLabel"><input type="radio" name="userstep" class="userpower" value="8" checked ="checked">代理5</label>
           </td>
        </tr>
        <tr>
          <td></td>
          <!--<td colspan="3"><span class="sub" onClick="javascript:addUser();" style=" text-align: center">提&nbsp;&nbsp;交</span></td>-->
          <td colspan="3"><span class="sub" onClick="return subForm(addUser());" style=" text-align: center">提&nbsp;&nbsp;交</span></td>
        </tr>
      </table>
    </div>

</div>
</body>
</html>