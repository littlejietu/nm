<?php include_once("right_head.php")?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/articleaction/SubscribeEmailList" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/articleaction/addSubscribeEmail" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editSubscribeEmail';} else {echo 'addSubscribeEmail';} ?>" type="hidden">
            <input name="seid" value="<?php if (!empty($subscribeEmail) && !empty($subscribeEmail->se_id)) { echo $subscribeEmail->se_id;} ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">邮箱：</td>
                    <td><input id="seemail" name="seemail" must="ture" value="<?php echo (!empty($subscribeEmail) && !empty($subscribeEmail->se_email)) ? $subscribeEmail->se_email : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">是否发送：</td>
                    <td>
                        <label class="normalLabel fl"><input type="radio" name="isshow" class="isshow" value="1" <?php echo (!empty($subscribeEmail) && !empty($subscribeEmail->is_show) && $subscribeEmail->is_show == 1) ? 'checked' : empty($subscribeEmail)?'checked':'' ?> >是</label>
                        <label class="normalLabel fl"><input type="radio" name="isshow" class="isshow" value="0" <?php echo (!empty($subscribeEmail) && $subscribeEmail->is_show == 0) ? 'checked' : '' ?>  >否</label>
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