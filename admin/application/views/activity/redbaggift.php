<?php include_once("right_head.php") ?>
<div class="common">
    <form>
        <input type="hidden" name="rbr_id" value="<?php echo($rbr_id) ?>">
    </form>
    <div class="goodsTitle">
        <?php
        switch($type){
    case 'redbag':
        ?>
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexRedbagrule/" class="topBtn">返回列表</a>
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexRedbaggiftList/" class="topBtn">赠送列表</a>
    <?php

        break;
        case 'dcode':
        ?>
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexDiscountCodeRuleList/" class="topBtn">返回列表</a>
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexAdcList/" class="topBtn">赠送列表</a>
        <?php
        break;
        }
        ?>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 5%;">编号</td>
            <td style="width: 15%;">用户名</td>
            <td style="width: 20%;">真实姓名</td>
            <td style="width: 8%;">会员邮箱</td>
            <td style="width: 8%;">用户昵称</td>
            <td style="width: 5%;">用户性别</td>
            <td style="width: 5%;">用户级别</td>
            <td style="width: 15%;">会员登录次数</td>
            <td style="width: 7%;">是否锁定</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($userList)) {
        foreach ($userList as $key => $value) {
        ?>
        <tr height="30">
            <td>[<?php echo ($key + 1); ?>]</td>
            <td><?php echo $value->user_name ?></td>
            <td><?php echo $value->user_real_name ?></td>
            <td><?php echo $value->user_mail ?></td>
            <td><?php echo $value->user_integral ?></td>
            <td><?php echo $value->user_sex==1?"男":"女" ?></td>
            <td><?php echo $value->user_level ?></td>
            <td><?php echo $value->user_login_num ?></td>
            <td><?php echo $value->is_lock == 1 ? "锁定" : "未锁" ?></td>
            <td>
                <?php if ($key + 1 > 0) { ?>
                <a href="javascript:void(0)"
                   onclick="sendRed(this,'<?php echo base_url() ?>','<?php echo $type ?>','<?php echo $value->user_id ?>','<?php echo $rbr_id ?>')">赠送</a>
                <?php } ?>
            </td>
        </tr>
        <?php
        }

        } ?>
    </table>
    <br>

    <div class="page">
        <?php echo $userHtml; ?>
    </div>

</div>
</body>
</html>