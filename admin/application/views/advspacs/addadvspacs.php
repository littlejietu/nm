<?php include_once("right_head.php") ?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/advspacsaction/indexAdvSpaces" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/advspacsaction/<?php if (!empty($act) && $act == 'edit') { echo 'editAdvSpaces';} else {echo 'addAdvSpaces'; } ?>" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') { echo 'editAdvSpaces';} else { echo 'addAdvSpaces'; } ?>" type="hidden">
            <input name="adv_spaces_id" value="<?php if (!empty($advSpaces) && !empty($advSpaces->adv_spaces_id)) { echo $advSpaces->adv_spaces_id;}?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="adv_spaces_title" name="adv_spaces_title"
                               value="<?php echo (!empty($advSpaces) &&!empty($advSpaces->adv_spaces_title)) ? $advSpaces->adv_spaces_title :''?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">金额：</td>
                    <td><input id="adv_spaces_money" name="adv_spaces_money"
                               value="<?php echo (!empty($advSpaces) &&!empty($advSpaces->adv_spaces_money)) ? $advSpaces->adv_spaces_money :''?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">高度：</td>
                    <td><input id="adv_spaces_height" name="adv_spaces_height"
                               value="<?php echo (!empty($advSpaces) &&!empty($advSpaces->adv_spaces_height)) ? $advSpaces->adv_spaces_height :''?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">宽度：</td>
                    <td><input id="adv_spaces_width" name="adv_spaces_width"
                               value="<?php echo (!empty($advSpaces) &&!empty($advSpaces->adv_spaces_width)) ? $advSpaces->adv_spaces_width:''?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show" value="1" <?php echo (!empty($advSpaces) && !empty($advSpaces->is_show) && $advSpaces->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show" value="0" <?php echo (!empty($advSpaces) && $advSpaces->is_show == 0) ? 'checked' : '' ?>  >否</label>
                    </td>
                </tr>
                <tr height="60">
                    <td></td>
                    <td>
                        <button class="sub" type="submit" onclick="return subForm()">提交</button>
                    </td>
                </tr>
            </table>

        </form>
    </div>

</div>
</body>
</html>