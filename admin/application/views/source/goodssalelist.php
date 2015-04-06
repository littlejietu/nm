<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
    </div>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%;">编号</td>
            <td style="width: 30%;">产品名称</td>
            <td style="width: 10%;">货号</td>
            <td style="width: 10%;">用户名称</td>
            <td style="width: 10%;">时间</td>
            <td style="width: 20%">操作</td>
        </tr>
        <?php
        if (!empty($goodsSaleList)) {
            foreach ($goodsSaleList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->goods_name ?></td>
                    <td><?php echo $value->goods_sn ?></td>
                    <td><?php echo $value->user_name ?></td>
                    <td><?php echo date("Y-m-d",$value->add_time)?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){delGoodsSale($(this),<?php echo $value->gs_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
        } ?>
    </table>
    <br>

    <div class="page">
        <?php echo $goodsSaleHtml; ?>
    </div>
</div>
</body>
</html>