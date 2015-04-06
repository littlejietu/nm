<?php include_once("right_head.php") ?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/activityaction/indexDiscountCodeRuleList" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/activityaction/<?php if (!empty($act) && $act == 'edit') {echo 'editDiscountCodeRule';} else {echo 'addDiscountCodeRule';} ?>" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editDiscountCodeRule';} else {echo 'addDiscountCodeRule';} ?>" type="hidden">
            <input name="dc_id" value="<?php if (!empty($discountcoderule) && !empty($discountcoderule->dc_id)) {echo $discountcoderule->dc_id;} ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">活动规则：</td>
                    <td>
                        <select name="acti">
                            <?php foreach ($activityshow as $k => $v) { ?>
                                <option value="<?php echo $v->acti_id . ',' . $v->acti_title ?>" <?php if (!empty($redbagrule) && $redbagrule->acti_id == $v->acti_id) {echo 'selected';} ?> ><?php echo $v->acti_title ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="dc_title" name="dc_title" must="ture"value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->dc_title)) ? $discountcoderule->dc_title : '' ?>"class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">金额：</td>
                    <td><input id="dc_money" name="dc_money" must="ture" value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->dc_money)) ? $discountcoderule->dc_money : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">使用满足金额：</td>
                    <td><input id="dc_meet_money" name="dc_meet_money" must="ture"
                               value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->dc_meet_money)) ? $discountcoderule->dc_meet_money : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort"
                               value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->sort)) ? $discountcoderule->sort : '' ?>" class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">有效天数：</td>
                    <td><input id="dc_valid_cycle" name="dc_valid_cycle" value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->dc_valid_cycle)) ? $discountcoderule->dc_valid_cycle : '' ?>" class="normalText"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">起始时间：</td>
                    <td><input id="d4311" name="dc_start_time"value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->dc_start_time)) ? date("Y-m-d", $discountcoderule->dc_start_time) : '' ?>" class="Wdate" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">结束时间：</td>
                    <td><input id="d4312" name="dc_end_time" value="<?php echo (!empty($discountcoderule) && !empty($discountcoderule->dc_end_time)) ? date("Y-m-d", $discountcoderule->dc_end_time) : '' ?>"class="Wdate" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show" value="1" <?php echo (!empty($discountcoderule) && !empty($discountcoderule->is_show) && $discountcoderule->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show" value="0" <?php echo (!empty($discountcoderule) && $discountcoderule->is_show == 0) ? 'checked' : '' ?>  >否</label>
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