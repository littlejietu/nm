<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/articleaction/addSubscribeEmail/" class="topBtn">添加</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%;">编号</td>
            <td style="width: 30%;">邮箱</td>
            <td style="width: 10%;">状态</td>
            <td style="width: 10%;">时间</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($subscribeEmailList)) {
            foreach ($subscribeEmailList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->se_email ?></td>
                    <td><?php echo $value->is_show == 1 ? "发送" : "不发送" ?></td>
                    <td><?php echo !empty($value->add_time)?date("Y-m-d",$value->add_time):""?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a href="<?php echo base_url(); ?>index.php/articleaction/addSubscribeEmail/<?php echo $value->se_id ?>">编辑</a>
                            <span class="caozuo_line">|</span>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){deleteSubscribeEmail($(this),<?php echo $value->se_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
        } ?>
    </table>
    <br>
    <div class="page">
        <?php echo $subscribeEmailHtml; ?>
    </div>
</div>
</body>
</html>