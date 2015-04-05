<?php include_once("right_head.php")?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/articleaction/FriendlyLinksList" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/articleaction/addFriendlyLinks" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editFriendlyLinks';} else {echo 'addFriendlyLinks';} ?>" type="hidden">
            <input name="flid" value="<?php if (!empty($friendlylinks) && !empty($friendlylinks->fl_id)) { echo $friendlylinks->fl_id;} ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="fltitle" name="fltitle" must="ture" value="<?php echo (!empty($friendlylinks) && !empty($friendlylinks->fl_title)) ? $friendlylinks->fl_title : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">url：</td>
                    <td><input id="flurl" name="flurl" must="ture" value="<?php echo (!empty($friendlylinks) && !empty($friendlylinks->fl_url)) ? $friendlylinks->fl_url : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort" value="<?php echo (!empty($friendlylinks) && !empty($friendlylinks->sort)) ? $friendlylinks->sort : '' ?>"  class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl"><input type="radio" name="isshow" class="isshow" value="1" <?php echo (!empty($friendlylinks) && !empty($friendlylinks->is_show) && $friendlylinks->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl"><input type="radio" name="isshow" class="isshow" value="0" <?php echo (!empty($friendlylinks) && $friendlylinks->is_show == 0) ? 'checked' : '' ?>  >否</label>
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