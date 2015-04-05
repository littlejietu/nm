<?php include_once("right_head.php") ?>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/advspacsaction/indexAdvertiser" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/advspacsaction/<?php if (!empty($act) && $act == 'edit') {
            echo 'editAdvertiser';
        } else {
            echo 'addAdvertiser';
        } ?>" method="post" enctype="multipart/form-data">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {
                echo 'editAdvertiser';
            } else {
                echo 'addAdvertiser';
            } ?>" type="hidden">
            <input name="adv_id" value="<?php if (!empty($advAdvertiser) && !empty($advAdvertiser->adv_id)) {
                echo $advAdvertiser->adv_id;
            } ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="adv_title" name="adv_title"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_title)) ? $advAdvertiser->adv_title : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">广告位：</td>
                    <td>
                        <select name="adv_spaces">
                            <?php foreach ($advspaceslist as $k => $v) { ?>
                                <option
                                    value="<?php echo $v->adv_spaces_id . ',' . $v->adv_spaces_title ?>" <?php if (!empty($advAdvertiser) && $advAdvertiser->adv_spaces_id == $v->adv_spaces_id) {
                                    echo 'selected';
                                } ?> ><?php echo $v->adv_spaces_title ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">金额：</td>
                    <td><input id="adv_money" name="adv_money"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_money)) ? $advAdvertiser->adv_money : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">图片：</td>
                    <td>
                        <?php
                        if (!empty($advAdvertiser) && $advAdvertiser->adv_imgs) {
                            ?>
                            <img src="<?php echo $advAdvertiser->adv_imgs; ?>" width="100" style="padding: 10px 0px">
                        <?php } ?>
                        <input name="adv_imgs" type="file"
                               value="<?php echo empty($advAdvertiser) ? '' : $advAdvertiser->adv_imgs; ?>">

                    </td>
                </tr>
                <tr>
                    <td align="right">url链接：</td>
                    <td><input id="adv_url" name="adv_url"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_url)) ? $advAdvertiser->adv_url : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">简介：</td>
                    <td><textarea id="adv_content" name="adv_content"
                                  class="normalText"><?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_content)) ? $advAdvertiser->adv_content : '' ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right">备注：</td>
                    <td><textarea id="adv_remark" name="adv_remark"
                                  class="normalText"><?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_remark)) ? $advAdvertiser->adv_remark : '' ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="right">用户登录名：</td>
                    <td><input id="adv_user_name" name="adv_user_name"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_user_name)) ? $advAdvertiser->adv_user_name : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">用户名称：</td>
                    <td><input id="adv_user_real_name" name="adv_user_real_name"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_user_real_name)) ? $advAdvertiser->adv_user_real_name : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">起始时间：</td>
                    <td><input id="d4311" name="adv_start_time"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_start_time)) ? date("Y-m-d", $advAdvertiser->adv_start_time) : '' ?>"
                               class="Wdate" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">结束时间：</td>
                    <td><input id="d4312" name="adv_end_time"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->adv_end_time)) ? date("Y-m-d", $advAdvertiser->adv_end_time) : '' ?>"
                               class="Wdate"
                               onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/></td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort"
                               value="<?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->sort)) ? $advAdvertiser->sort : '' ?>"
                               class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show"
                                   value="1" <?php echo (!empty($advAdvertiser) && !empty($advAdvertiser->is_show) && $advAdvertiser->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl">
                            <input type="radio" name="is_show" class="is_show"
                                   value="0" <?php echo (!empty($advAdvertiser) && $advAdvertiser->is_show == 0) ? 'checked' : '' ?>  >否</label>
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