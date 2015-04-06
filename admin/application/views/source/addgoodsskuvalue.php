<?php include_once("right_head.php")?>
<div class="common">
    <form action="<?php echo base_url()?>index.php/sourceaction/addGoodsSkuValue" method="post">
        <input type="hidden" name="act" value="add">
        <?php if(!empty($goodsSkuValueInfo)){?>
        <input type="hidden" name="value_id" value="<?php echo $goodsSkuValueInfo->goods_sku_value_id?>">
        <?php }?>
    <table class="addTable">
        <tr>
            <td style="width: 10%">属性：</td>
            <td style="width: 20%"><select name="goods_sku_key_id"  class="normalSelect">
                <?php foreach((array)$goodsSkuList as $k => $v){?>
                    <option value="<?php echo $v->goods_sku_key_id?>" <?php if(!empty($goodsSkuInfo) && $goodsSkuInfo->goods_sku_key_id == $v->goods_sku_key_id){echo 'selected';}?>><?php echo $v->sku_key?></option>
                <?php }?>

            </select></td>
            <td width="70%">&nbsp;</td>

        </tr>
        <tr>
            <td>属性值：</td>
            <td><input type="text" name="goods_sku_value" value="<?php if(!empty($goodsSkuValueInfo)) {echo $goodsSkuValueInfo->goods_sku_value;}?>"></td>
            <td width="70%">&nbsp;</td>
        </tr>
        <tr>
            <td>是否显示</td>
            <td><label class="right_label"><input type="radio" name="is_show" value="1" <?php if(!isset($leftInfo->is_show) or (isset($leftInfo->is_show) && $leftInfo->is_show)){echo 'checked';}?>>是</label>
                <label class="right_label"><input type="radio" name="is_show" value="0" <?php if((isset($leftInfo->is_show) && !$leftInfo->is_show)){echo 'checked';}?>>否</label></td>
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