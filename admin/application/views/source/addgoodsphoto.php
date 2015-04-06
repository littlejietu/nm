<?php include_once("right_head.php") ?>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/sourceaction/indexgoodsphoto/<?php echo  $goodsid ?>/<?php echo $goodsname ?>" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url(); ?>index.php/sourceaction/<?php if (!empty($act) && $act == 'edit') {echo 'editGoodsPhoto';} else {echo 'addGoodsPhoto';} ?>" method="post" enctype="multipart/form-data">
            <input name="act" value="<?php if (!empty($act) && $act == 'edit') {echo 'editGoodsPhoto';} else {echo 'addGoodsPhoto';} ?>" type="hidden">
            <input name="photo_id" value="<?php if (!empty($goodsphoto) && !empty($goodsphoto[0]->photo_id)) {echo $goodsphoto[0]->photo_id;} ?>" type="hidden">
            <input name="goods_id" value="<?php if (!empty($goodsid)) {echo $goodsid;} ?>" type="hidden">
            <input name="goods_name" value="<?php if (!empty($goodsname)) {echo $goodsname;} ?>" type="hidden">

            <table class="addTable">
                <tr>
                    <td align="right">产品名称：</td>
                    <td>
                        <?php echo $goodsname ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">图片：</td>
                    <td>
                        <input type="file" name="photo_image">
                        <span class="tips">* &nbsp<?php echo $err ?></span>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort" value="<?php echo (!empty($goodsphoto) && !empty($goodsphoto[0]->sort)) ? $goodsphoto[0]->sort : '' ?>" class="normalText"/></td>
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