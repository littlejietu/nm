<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/advspacsaction/addAdvertiser/" class="topBtn">添加广告</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 8%;">编号</td>
            <td style="width: 15%;">名称</td>
            <td style="width: 10%;">广告位</td>
            <td style="width: 5%;">金额</td>
            <td style="width: 5%;">访问量</td>
            <td style="width: 10%;">起始时间</td>
            <td style="width: 10%;">结束时间</td>
            <td style="width: 5%;">状态</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($advertiserList)) {
            foreach ($advertiserList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo !empty($value->adv_title)?$value->adv_title:"" ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo !empty($value->adv_spaces_name)?$value->adv_spaces_name:"" ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo !empty($value->adv_money)?$value->adv_money:"" ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo !empty($value->click_number)?$value->click_number:0 ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo !empty($value->adv_start_time)?date("Y-m-d",$value->adv_start_time):"" ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo !empty($value->adv_end_time)?date("Y-m-d",$value->adv_end_time):"" ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->is_show==1?"显示":"不显示" ?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a href="<?php echo base_url(); ?>index.php/advspacsaction/addAdvertiser">添加</a>
                            <span class="caozuo_line">|</span>
                            <a href="<?php echo base_url(); ?>index.php/advspacsaction/editAdvertiser/<?php echo $value->adv_id ?>">编辑</a>
                            <span class="caozuo_line">|</span>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){deleteAdvertiser($(this),<?php echo $value->adv_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }

        } ?>
    </table>

    <br>
    <div class="page">
        <?php echo $advertiserHtml; ?>
    </div>
</div>
</body>
</html>