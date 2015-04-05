<?php include_once("right_head.php")?>
<script type="text/javascript"
        src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/articleaction/ShopManageList" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/articleaction/addShopManage" method="post">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editShopManage';} else {echo 'addShopManage';} ?>" type="hidden">
            <input name="smid" value="<?php if (!empty($shopManage) && !empty($shopManage->sm_id)) { echo $shopManage->sm_id;} ?>" type="hidden">
            <table class="addTable">
                <tr>
                    <td align="right">标题：</td>
                    <td><input id="smtitle" name="smtitle" must="ture" value="<?php echo (!empty($shopManage) && !empty($shopManage->sm_title)) ? $shopManage->sm_title : '' ?>" class="normalText"/>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">介绍：</td>
                    <td><textarea id="smintro" name="smintro" must="ture" class="normalText" style="margin: 0px; height: 109px; width: 406px;"><?php echo (!empty($shopManage) && !empty($shopManage->sm_intro)) ? $shopManage->sm_intro : ''  ?></textarea>
                        <span class="tips">*</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort" value="<?php echo (!empty($shopManage) && !empty($shopManage->sort)) ? $shopManage->sort : '' ?>"  class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl"><input type="radio" name="isshow" class="isshow" value="1" <?php echo (!empty($shopManage) && !empty($shopManage->is_show) && $shopManage->is_show == 1) ? 'checked' : '' ?> >是</label>
                        <label class="normalLabel fl"><input type="radio" name="isshow" class="isshow" value="0" <?php echo (!empty($shopManage) && $shopManage->is_show == 0) ? 'checked' : '' ?>  >否</label>
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