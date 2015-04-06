<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url(); ?>index.php/categoryaction/index/<?php echo $type?>" class="topBtn">返回列表</a>
    </div>
    <div class="sxbj"><h1 class="fl">属性编辑</h1>

        <div class="checkAll fl"><label class="normalLabel"><input type="checkbox" onclick="checkAll(this)"
                                                                   class="checkAll"/>全选</label></div>
    </div>
    <div class="sxbj_main">
        <form action="<?php echo base_url(); ?>index.php/categoryaction/editClassYproperty/<?php echo($catid) ?>" method="post">
            <input name="act" value="<?php echo !empty($act) && $act == 'edit' ? 'edit' : ''; ?>" type="hidden">
            <input name="type" type="hidden" value="<?php echo($type) ?>">
            <?php
            if (!empty($goodsskulist)) {
                foreach ($goodsskulist as $item) {
                    if (!empty($catInfo) && !empty($catInfo->goods_sku_key_id)) {
                        $is_exist = is_int(strpos( ','.$catInfo->goods_sku_key_id.',',','.$item->goods_sku_key_id.','));
                    }
                    ?>
                    <label class="normalLabel fl"><input type="checkbox" class="checkSon" name="checkSons[]"  <?php echo(!empty($is_exist)?'checked="checked"':'')?>   onclick="checkSon()" value="<?php echo $item->goods_sku_key_id ?>"/><?php echo $item->sku_key ?>
                    </label>
                <?php
                }
            } ?>
            <input type="submit" value="确定" class="sub" onclick="return addClassyProperty()">
        </form>
    </div>
</div>

</body>
</html>