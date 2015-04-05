<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/advspacsaction/addAdvSpaces/" class="topBtn">添加广告位</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%;">编号</td>
            <td style="width: 30%;">名称</td>
            <td style="width: 15%;">金额</td>
            <td style="width: 10%;">高度</td>
            <td style="width: 10%;">宽度</td>
            <td style="width: 10%;">状态</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($advspacesList)) {
            foreach ($advspacesList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->adv_spaces_title ?></td>
                    <td ><?php echo $value->adv_spaces_money ?></td>
                    <td ><?php echo $value->adv_spaces_height ?></td>
                    <td ><?php echo $value->adv_spaces_width ?></td>
                    <td ><?php echo $value->is_show==1?"显示":"不显示" ?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a href="<?php echo base_url(); ?>index.php/advspacsaction/editAdvSpaces/<?php echo $value->adv_spaces_id ?>">编辑</a>
                            <span class="caozuo_line">|</span>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){deletespacs($(this),<?php echo $value->adv_spaces_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }

        } ?>
    </table>
    <br>
    <div class="page">
        <?php echo $advspacesHtml; ?>
    </div>
</div>
</body>
</html>