
<?php include_once("right_head.php")?>
<div class="common">
    <form action="<?php echo base_url()?>index.php/sourceaction/addGoodsSku" method="post">
        <input type="hidden" name="act" value="add">
        <?php if(!empty($goodsSkuInfo)){?>
        <input type="hidden" name="key_id" value="<?php echo $goodsSkuInfo->goods_sku_key_id?>">
        <?php }?>

	<div class="goodsTitle">添加属性</div>
    <table class="addTable">
<!--       <tr>-->
<!--            <td align="right">产品分类：</td>-->
<!--            <td>-->
<!---->
<!--                <select name="part_id" class="fl normalSelect">-->
<!--                  <?php //foreach($categoryList as $v){?>
<!--                        <option --><?php // echo(!empty($goodsSkuInfo) &&!empty($goodsSkuInfo->cat_id)? $goodsSkuInfo->cat_id == $v->cat_id ? 'selected="selected"':'':''); ?><!-- value="--><?php //echo $v->cat_id.','. $v->cat_name ?><!--">--><?php //echo $v->cat_name?><!--</option>-->
<!--                    --><?php //}?>
<!--                </select>-->
<!--            </td>-->
<!--            <td width="70%">&nbsp;</td>-->
        </tr>
        <tr>
            <td align="right">属性名：</td>
            <td><input type="text" name="sku_name" value="<?php if(!empty($goodsSkuInfo)) {echo $goodsSkuInfo->sku_key;}?>"></td>
            <td width="70%">&nbsp;</td>
        </tr>
        <tr>
            <td align="right">是否搜索属性：</td>
            <td><label class="normalLabel"><input type="radio" name="is_search" value="1" <?php if(!isset($leftInfo->is_search) or (isset($leftInfo->is_search) && $leftInfo->is_search)){echo 'checked';}?>>是</label>
                <label class="normalLabel"><input type="radio" name="is_search" value="0" <?php if((isset($leftInfo->is_search) && !$leftInfo->is_search)){echo 'checked';}?>>否</label></td>
            <td width="70%">&nbsp;</td>
        </tr>
        <tr>
            <td align="right">是否显示：</td>
            <td><label class="normalLabel"><input type="radio" name="is_show" value="1" <?php if(!isset($leftInfo->is_show) or (isset($leftInfo->is_show) && $leftInfo->is_show)){echo 'checked';}?>>是</label>
                <label class="normalLabel"><input type="radio" name="is_show" value="0" <?php if((isset($leftInfo->is_show) && !$leftInfo->is_show)){echo 'checked';}?>>否</label></td>
            <td width="70%">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" class="sub">提交</button></td>
            <td width="70%">&nbsp;</td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>