<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/sourceaction/addgoodsphoto/<?php echo  $goodsid ?>/<?php echo $goodsname ?>" class="topBtn">添加图片</a>
        <a href="<?php echo base_url(); ?>index.php/sourceaction/index/goods/" class="topBtn">返回列表</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%;">编号</td>
            <td style="width: 60%;">图片</td>
            <td style="width: 10%;">排序</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($goodsphoto)) {
            foreach ($goodsphoto as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td>
                        <img src="<?php echo $value->photo_image ?>" width="120px" height="120px">
                    </td>
                    <td><?php echo $value->sort ?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a href="<?php echo base_url(); ?>index.php/sourceaction/editgoodsphoto/<?php echo $value->goods_id ?>/<?php echo $goodsname ?>/<?php echo $value->photo_id ?>">编辑</a>
                            <span class="caozuo_line">|</span>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){delgoodsphpto($(this),<?php echo $value->photo_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
        } ?>
    </table>
</div>
</body>
</html>