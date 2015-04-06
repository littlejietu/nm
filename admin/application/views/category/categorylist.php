<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/categoryaction/addCat/<?php echo $type ?>" class="topBtn">添加分类</a>
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%">分类编号</td>
            <td style="width: 40%;">分类名称</td>
            <td style="width: 10%">排序</td>
            <td style="width: 25%">操作</td>
        </tr>
        <?php
        if (!empty($categoryList)) {
            foreach ($categoryList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->cat_name ?></td>
                    <td><input style="width: 40px;height:25px;" name="sort" id="sort"
                               onchange="changeClassSort(<?php echo $value->cat_id ?>,$(this).val(),'<?php echo base_url() ?>')"
                               value="<?php echo $value->sort ?>" class="normalText"/></td>
                    <td>
                        <?php if ($key > 0) { ?>
                            <a href="<?php echo base_url(); ?>index.php/categoryaction/addCat/<?php echo $type ?>/<?php echo $value->cat_id ?>">添加分类</a>
                            <span class="caozuo_line">|</span>
                            <a href="<?php echo base_url(); ?>index.php/categoryaction/editCat/<?php echo $type ?>/<?php echo $value->cat_id ?>">编辑分类</a>
                            <span class="caozuo_line">|</span>
                            <a onclick="javascript:if(confirm('确认删除？')){deleteClass($(this),<?php echo $value->cat_id ?>,'<?php echo base_url() ?>');}">删除分类</a>
                            <?php
                            if ($type == 2) {
                                ?>
                                <span class="caozuo_line">|</span>
                                <a href="<?php echo base_url(); ?>index.php/categoryaction/editClassYproperty/<?php echo $value->cat_id ?>/<?php echo $type ?>">编辑属性</a>
                            <?php }
                        } ?>
                    </td>
                </tr>
            <?php }
        } ?>
    </table>

</div>
</body>
</html>