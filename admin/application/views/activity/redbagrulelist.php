<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/activityaction/addRedbagrule/" class="topBtn">添加红包</a>
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexRedbaggiftList/" class="topBtn">赠送列表</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 5%;">编号</td>
            <td style="width: 15%;">分类</td>
            <td style="width: 20%;">名称</td>
            <td style="width: 8%;">金额</td>
            <td style="width: 8%;">满足金额</td>
            <td style="width: 5%;">排序</td>
            <td style="width: 5%;">状态</td>
            <td style="width: 15%;">起始 /结束时间</td>
            <td style="width: 7%;">添加时间</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($redbagruleList)) {
            foreach ($redbagruleList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td><?php echo $value->acti_title ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->rbr_title ?></td>
                    <td><?php echo $value->rbr_money ?></td>
                    <td ><?php echo $value->rbr_meet_money ?></td>
                    <td><?php echo $value->sort ?></td>
                    <td><?php echo $value->is_show == 1 ? "显示" : "不显示" ?></td>
                    <td><?php echo !empty($value->rbr_start_time)?date("Y-m-d",$value->rbr_start_time):""?> / <?php echo !empty($value->rbr_end_time)?date("Y-m-d",$value->rbr_end_time):""?></td>
                    <td><?php echo !empty($value->add_time)?date("Y-m-d",$value->add_time):""?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a href="<?php echo base_url(); ?>index.php/activityaction/indexRedbaggift/redbag/<?php echo $value->rbr_id ?>">赠送</a>
                            <span class="caozuo_line">|</span>
                            <a href="<?php echo base_url(); ?>index.php/activityaction/editRedbagrule/<?php echo $value->rbr_id  ?>">编辑</a>
                            <span class="caozuo_line">|</span>
                            <a style="cursor: pointer"onclick="javascript:if(confirm('确认删除？')){deleterdbagrule($(this),<?php echo $value->rbr_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }

        } ?>
    </table>
    <br>
    <div class="page">
        <?php echo $redbagruleHtml; ?>
    </div>
</div>
</body>
</html>