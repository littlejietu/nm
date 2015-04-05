<?php include_once("right_head.php") ?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexRedbagrule" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/activityaction/<?php if (!empty($act) && $act == 'edit') {echo 'editRedbagrule';} else {echo 'addRedbagrule';} ?>" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editRedbagrule';} else {echo 'addRedbagrule';} ?>" type="hidden">
            <input name="rbr_id" value="<?php if (!empty($redbagrule) && !empty($redbagrule->rbr_id)) {echo $redbagrule->rbr_id;} ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">活动规则：</td>
                    <td>
                        <select name="acti">
                            <?php foreach ($activityshow as $k => $v) { ?>
                                <option
                                    value="<?php echo $v->acti_id . ',' . $v->acti_title ?>" <?php if (!empty($redbagrule) && $redbagrule->acti_id == $v->acti_id) {
                                    echo 'selected';
                                } ?> ><?php echo $v->acti_title ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="rbr_title" name="rbr_title" must="ture"value="<?php echo (!empty($redbagrule) && !empty($redbagrule->rbr_title)) ? $redbagrule->rbr_title : '' ?>"class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">金额：</td>
                    <td><input id="rbr_money" name="rbr_money" must= "ture" value="<?php echo (!empty($redbagrule) && !empty($redbagrule->rbr_money))?$redbagrule->rbr_money: '' ?> "class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">使用满足金额：</td>
                    <td><input id="rbr_meet_money" name="rbr_meet_money" must="ture" value="<?php echo (!empty($redbagrule) && !empty($redbagrule->rbr_meet_money)) ? $redbagrule->rbr_meet_money : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort"
                               value="<?php echo (!empty($redbagrule) && !empty($redbagrule->sort)) ? $redbagrule->sort : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">起始时间：</td>
                    <td><input id="d4311" name="rbr_start_time"
                               value="<?php echo (!empty($redbagrule) && !empty($redbagrule->rbr_start_time)) ? date("Y-m-d", $redbagrule->rbr_start_time) : '' ?>" class="Wdate" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">结束时间：</td>
                    <td><input id="d4312" name="rbr_end_time" value="<?php echo (!empty($redbagrule) && !empty($redbagrule->rbr_end_time)) ? date("Y-m-d", $redbagrule->rbr_end_time) : '' ?>"
                               class="Wdate"
                               onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show"
                                   value="1" <?php echo (!empty($redbagrule) && !empty($redbagrule->is_show) && $redbagrule->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show"
                                   value="0" <?php echo (!empty($redbagrule) && $redbagrule->is_show == 0) ? 'checked' : '' ?>  >否</label>
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