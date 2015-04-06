<?php include_once("right_head.php");?>
<div class="common">
<form action="<?php echo base_url();?>index.php/ucenteraction/<?php echo (empty($userInfo))?'addUser/':('editUser/'.$userInfo->user_id)?>"  method="post" accept-charset="utf-8" enctype="multipart/form-data">
<input type="hidden" name="act" value="<?php echo (empty($userInfo))?'add':('edit')?>" size="20" />
<?php if(!empty($userInfo)){?>
    <input type="hidden" name="id" value="<?php echo $userInfo->user_id?>" size="20" />
<?php }?>
<div class="tabchild" style="display:block;"  id="tabchild1">
    <table class="goodsTable">
        <tr>
            <td>用户名：</td>
            <td>
                <input name="user_name" value="<?php echo empty($userInfo)?'':$userInfo->user_name;?>" must="ture" type="text" class="normalText">
                <span class="tips">*</span>
            </td>
        </tr>
        <tr>
            <td>昵称：</td>
            <td>
                <input name="user_nikename"  value="<?php echo empty($userInfo)?'':$userInfo->user_nikename;?>"  must="ture"  type="text"  class="normalText">
                <span class="tips">*</span>
            </td>
        </tr>
        <tr>
            <td>密码：</td>
            <td>
                <input name="user_password"  value="<?php echo empty($userInfo)?'':'********';?>"  type="password"  class="normalText" <?php if(empty($userInfo)){?>must="ture"<?php }?>>
                <?php if(empty($userInfo)){?><span class="tips">*</span><?php }?>
            </td>
        </tr>
        <tr>
            <td>确认密码：</td>
            <td>
                <input name="c_user_password"  value=""  type="password"  class="normalText" <?php if(empty($userInfo)){?>must="ture"<?php }?>><?php if(empty($userInfo)){?>
                <span class="tips">*</span><?php }?>
            </td>

        </tr>
        <tr>
            <td>邮箱：</td>
            <td>
                <input name="user_mail" value="<?php echo empty($userInfo)?'':$userInfo->user_mail;?>"  must="ture" type="text"  class="normalText" />
                <span class="tips">*</span>
            </td>
        </tr>
        <tr>
            <td>头像：</td>
            <td>
                <?php
                if(!empty($userInfo) && $userInfo->user_image){
                    ?>
                    <img src="<?php echo $userInfo->user_image;?>" width="100" style="padding: 10px 0px">
                <?php }?>
                <input name="user_image" type="file"  value="<?php echo empty($userInfo)?'':$userInfo->user_image;?>" >
            </td>
        </tr>

        <tr>
            <td>真实姓名：</td>
            <td><input name="user_real_name" value="<?php echo empty($userInfo)?'':$userInfo->user_real_name;?>"  type="text"  class="normalText" /></td>
        </tr>
        <tr>
            <td>性别：</td>
            <td>
                <input name="user_sex" value="1"  type="radio" <?php echo empty($userInfo)?'':(($userInfo->user_sex == 1)?'checked':'');?> />男
                <input name="user_sex" value="0"  type="radio" <?php echo empty($userInfo)?'checked':(($userInfo->user_sex == 0)?'checked':'');?> />女
            </td>
        </tr>
        <tr>
            <td>手机：</td>
            <td><input name="user_tel" value="<?php echo empty($userInfo)?'':$userInfo->user_tel;?>"  type="text"  class="normalText" /></td>
        </tr>
        <tr>
            <td>角色：</td>
            <td><select name="userstep">
                <?php $arrUserLevel = $this->config->config['myconfig']['user_level'];
                foreach ($arrUserLevel as $key => $value) {?>
                    <option value="<?=$key?>"<?php if(!empty($userInfo) && $userInfo->user_level==$key) echo ' selected';?>><?=$value?></option>
                <?php }?>
                
                </select></td>
        </tr>
        <tr>
            <td>地区：</td>
            <td><div id="sjld">
                    <div class="m_zlxg" id="shenfen">
                        <p title="<?php if(!empty($userInfo) && $userInfo->user_province){echo $userInfo->user_province;}?>"><?php if(!empty($userInfo) && $userInfo->user_province){echo $userInfo->user_province;}?></p>
                        <div class="m_zlxg2">
                            <ul>
                            </ul>
                        </div>
                    </div>
                    <div class="m_zlxg" id="chengshi">
                        <p title="<?php if(!empty($userInfo) && $userInfo->user_city){echo $userInfo->user_city;}?>"><?php if(!empty($userInfo) && $userInfo->user_city){echo $userInfo->user_city;}?></p>
                        <div class="m_zlxg2">
                            <ul>
                            </ul>
                        </div>
                    </div>
                    <div class="m_zlxg" id="quyu">
                        <p title="<?php if(!empty($userInfo) && $userInfo->user_area){echo $userInfo->user_area;}?>"><?php if(!empty($userInfo) && $userInfo->user_area){echo $userInfo->user_area;}?></p>
                        <div class="m_zlxg2">
                            <ul>
                            </ul>
                        </div>
                    </div>

                    <input id="sfdq_num" type="hidden" value="" />
                    <input id="csdq_num" type="hidden" value="" />
                    <input id="sfdq_tj"  name="user_province" type="hidden" value="<?php if(!empty($userInfo) && $userInfo->user_province){echo $userInfo->user_province;}?>" />
                    <input id="csdq_tj"  name="user_city" type="hidden" value="<?php if(!empty($userInfo) && $userInfo->user_city){echo $userInfo->user_city;}?>" />
                    <input id="qydq_tj"  name="user_area" type="hidden" value="<?php if(!empty($userInfo) && $userInfo->user_area){echo $userInfo->user_area;}?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td>地址：</td>
            <td><input name="user_address" value="<?php echo empty($userInfo)?'':$userInfo->user_address;?>"  type="text"  class="normalText" /></td>
        </tr>
    </table>
</div>


<input type="submit" value="提交" class="sub" style="margin:20px 0 0 200px;" onclick="return subForm()" />
</form>
</div>
</div>
<script type="text/javascript">
$(function(){
$("#sjld").sjld();
})
</script>
</body>
</html>