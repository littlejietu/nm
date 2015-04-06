<?php include_once("right_head.php")?>
<div class="common">
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td width="5%">编号</td>
            <td width="10%">用户名</td>
            <td width="10%">角色</td>
            <td width="10%">邮箱</td>
            <td width="10%">昵称</td>
            <td width="5%">积分</td>
            <td width="5%">手机</td>
            <td width="5%">性别</td>
            <td width="10%">登录次数</td>
            <td width="10%">最后登录时间</td>
            <td width="10%">最后登录IP</td>
            <td width="10%">操作</td>
        </tr>
        <?php foreach($userList as $value){?>
        <tr height="30">
            <td><?php echo $value->user_id?></td>
            <td><?php echo $value->user_name?></td>
            <td><?php $arrTmp = $this->config->config['myconfig']['user_level'];
            echo $arrTmp[$value->user_level];?></td>
            <td><?php echo $value->user_mail?></td>
            <td><?php echo $value->user_nikename?></td>
            <td><?php echo $value->user_integral?></td>
            <td><?php echo $value->user_tel?></td>
            <td><?php echo ($value->user_sex)?'男':'女'?></td>
            <td><?php echo $value->user_login_num?></td>
            <td><?php echo date('Y-m-d H:i',$value->last_login)?></td>
            <td><?php echo $value->last_ip?></td>
            <td>
                <a href="<?php echo base_url('ucenteraction/editUser/'.$value->user_id.'/')?>">编辑</a> |
                <a href="javascript:;" onclick="javascript:if(confirm('确认删除？')){delUser(this,'<?php echo base_url()?>',<?php echo $value->user_id?>)}">删除</a> |
                <a href="javascript:;" rel="<?php echo ($value->is_lock == '1')?0:1?>" onclick="userLock(this,'<?php echo base_url();?>','<?php echo $value->user_id?>')"><?php echo ($value->is_lock == '1')?'已锁定':'锁定'?></a>
            </td>
        </tr>
        <?php }?>
    </table>
    <br>

    <div class="page">
        <?php echo $userHtml; ?>
    </div>
</div>
</body>
</html>