<?php include_once("right_head.php") ?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/activityaction/index" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/activityaction/<?php if (!empty($act) && $act == 'edit') {echo 'editActivity';} else {echo 'addActivity';} ?>" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editActivity';} else {echo 'addActivity';} ?>" type="hidden">
            <input name="acti_id" value="<?php if (!empty($activity) && !empty($activity->acti_id)) { echo $activity->acti_id;} ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="acti_title" name="acti_title" must="ture" value="<?php echo (!empty($activity) && !empty($activity->acti_title)) ? $activity->acti_title : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort"
                               value="<?php echo (!empty($activity) && !empty($activity->sort)) ? $activity->sort : '' ?>"  class="normalText"/></td>

                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show"
                                   value="1" <?php echo (!empty($activity) && !empty($activity->is_show) && $activity->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show"
                                   value="0" <?php echo (!empty($activity) && $activity->is_show == 0) ? 'checked' : '' ?>  >否</label>
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