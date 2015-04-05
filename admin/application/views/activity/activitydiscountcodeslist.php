<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/activityaction/addDiscountCodeRule/" class="topBtn">添加优惠码</a>
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexDiscountCodeRuleList/" class="topBtn">返回列表</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 5%;">编号</td>
            <td style="width: 15%;">活动/优惠码</td>
            <td style="width: 10%;">用户名</td>
            <td style="width: 8%;">编号</td>
            <td style="width: 8%;">密码</td>
            <td style="width: 8%;">金额</td>
            <td style="width: 8%;">满足金额</td>
            <td style="width: 5%;">状态</td>
            <td style="width: 13%;">起始/结束时间</td>
            <td style="width: 7%;">添加时间</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($adcList)) {
            foreach ($adcList as $key=>$value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td><?php echo $value->acti_title ?>-<?php echo $value->dc_title ?></td>
                    <td><?php echo $value->user_name ?></td>
                    <td><?php echo $value->dc_coding ?></td>
                    <td><?php echo $value->dc_pws ?></td>
                    <td><?php echo $value->dc_money ?></td>
                    <td ><?php echo $value->dc_meet_money ?></td>
                    <td><?php echo $value->istatus == 1 ? '已使用': $value->istatus==2 ? '已过期':'未使用' ?></td>
                    <td><?php echo !empty($value->adc_start_time)?date("Y-m-d",$value->adc_start_time):""?>/<?php echo !empty($value->adc_start_time)?date("Y-m-d",$value->adc_start_time):""?></td>
                    <td><?php echo !empty($value->add_time)?date("Y-m-d",$value->add_time):""?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a style="cursor: pointer"onclick="javascript:if(confirm('确认删除？')){deleteactivitydiscountcodes($(this),<?php echo $value->adc_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }

        } ?>
    </table>
    <br>

    <div class="page">
        <?php echo $adcHtml; ?>
    </div>
</div>
</body>
</html>