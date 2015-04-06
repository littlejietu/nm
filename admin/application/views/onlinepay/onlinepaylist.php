<?php include_once("right_head.php")?>
<div class="common">
    <div class="ban">
        <a href="javascript:;" onclick="onlinePay()">充值</a>
        <a href="javascript:;" onclick="onlinepayintroShow()">充值说明</a>
    </div>
    <div class="onlinepayintro">
        <p>自助充值功能:</p>
        <p>1:照常拍款,填写充值申请,填写淘宝订单号</p>
        <p>2:点击充值页面中淘宝发货按钮</p>
        <p>3:淘宝确认货款,回到充值页面,点击充值进系统按钮</p>
        <p>完成三步后即充值成功</p>
        <p>如有疑问请咨询客服</p>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
                <tr height="39" style="font-size:13px;">
            <td width="5%">用户名</td>
            <td width="5%">真实姓名</td>
            <td width="10%">电话</td>
            <td width="10%">E-MAIL</td>
            <td width="10%">用户级别</td>
            <td width="30%">用户权限</td>
            <td width="5%">是否锁定</td>
            <td width="10%">最后登录时间</td>
            <td width="15%">操作</td>
        </tr>
        <?php
            foreach((array)$onlinepayList as $value){
        ?>
        <tr>
            <td><?php echo $value->user_name?></td>
            <td><?php echo $value->user_real_name?></td>
            <td><?php echo $value->user_tel?></td>
            <td><?php echo $value->user_email?></td>
            <td><?php
                switch($value->user_level){
                    case 0:
                        echo '网站制作者';
                        break;
                    case 1:
                        echo '超级管理员';
                        break;
                    case 2:
                        echo '网站管理员';
                        break;
                    case 3:
                        echo '渠道商';
                        break;
                    case 4:
                        echo '代理1';
                        break;
                    case 5:
                        echo '代理2';
                        break;
                    case 6:
                        echo '代理3';
                        break;
                    case 7:
                        echo '代理4';
                        break;
                    case 8:
                        echo '代理5';
                        break;
                    default:
                        echo '代理';
                }
            ?></td>
            <td><?php echo $value->user_power?></td>
            <td><a onclick="javascript:changeLock(this,'<?php echo $value->user_id?>');" value="<?php echo ($value->is_lock)?'0':'1';?>"><?php echo ($value->is_lock)?'是':'否';?></a> </td>
            <td><?php echo date('Y-m-d H:i',$value->last_login_time)?></td>
            <td>
                <a href="<?php echo base_url();?>index.php/useraction/addUser/edit/<?php echo $value->user_id?>">编辑</a>
                <a onclick="javascript:if(confirm('确认删除？')){delAdmin(<?php echo $value->user_id?>);}">删除</a>
                <a href="<?php echo base_url();?>index.php/useraction/givePower/<?php echo $value->user_id?>">分配权限</a>
            </td>
        </tr>
        <?php }?>
    </table>

</div>
<?php include_once('ordertypediv.php')?>
</body>
</html>