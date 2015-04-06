<?php include_once("right_head.php") ?>
<div class="common">
    <form action="<?php echo base_url('goodsreviewaction/index')?>" method="post">
        商品货号：&nbsp;&nbsp;<input name="goods_sn">&nbsp;&nbsp;<button type="submit">提交</button><br><br>
    </form>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%;">商品货号</td>
            <td style="width: 10%;">评论会员</td>
            <td style="width: 60%;">评论内容</td>
            <td style="width: 10%;">是否精华</td>
            <td style="width: 10%;">操作</td>
        </tr>
        <?php
        if (!empty($reviewList)) {
            foreach ($reviewList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo $value->goods_sn; ?>]</td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->user_name ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->review_content ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;">
                        <a href="javasctipt:;" onclick="javascript:setCream($(this),<?php echo $value->review_id ?>,'<?php echo base_url(); ?>','<?php echo $value->is_cream?'0':'1'?>')"><?php echo $value->is_cream?'是':'否' ?></a>
                    </td>
                    <td>
                        <a style="cursor: pointer" onclick="javascript:if(confirm('确认删除？')){deleteReview($(this),<?php echo $value->review_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                    </td>
                </tr>
            <?php }

        } ?>
    </table>
    <br>
    <div class="page">
        <?php echo $pageHtml; ?>
    </div>
</div>
</body>
</html>