<?php include_once("right_head.php")?>
<div class="common">
    <?php if( $userLevel < 2){?>
    <div class="goodsTitle"><a href="<?php echo base_url()?>index.php/sourceaction/addgoodssku" class="topBtn">添加属性</a></div>
    <?php }?>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
                <tr height="39" style="font-size:13px;">

            <td style="width: 5%">编号</td>
            <td style="width: 30%">属性名称</td>
            <?php if( $userLevel < 2){?>
                <td style="width: 60%">操作</td>
            <?php }?>
        </tr>
        <?php foreach((array)$goodsSkuList as $k => $v){?>
            <tr height="30">
                <td align="left" style="padding:0 0 0 10px;"><?php echo $v->goods_sku_key_id?></td>
                <td align="left" style="padding:0 0 0 100px;"><?php echo $v->sku_key?></td>
                <?php if( $userLevel < 2){?>
                    <td>
                        <a href="<?php echo base_url()?>sourceaction/addGoodsSkuValue/<?php echo $v->goods_sku_key_id?>">添加属性值</a><span class="caozuo_line">|</span>
                        <a href="<?php echo base_url()?>sourceaction/addgoodssku/<?php echo $v->goods_sku_key_id?>">编辑</a><span class="caozuo_line">|</span>
                        <a style="cursor: pointer" onclick="javascript:if(confirm('删除当前属性将导致当前属性下属性值完全删除，确认删除？')){delGoodsSku(<?php echo $v->goods_sku_key_id?>,'sku','<?php echo base_url()?>');}">删除</a>
                    </td>
                <?php }?>
            </tr>
            <?php
            foreach($v->sku_value as $ka => $va){
                    ?>
                    <tr  height="30">
                        <td align="left" style="padding:0 0 0 10px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $va->goods_sku_value_id?></td>
                        <td align="left" style="padding:0 0 0 100px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $va->goods_sku_value?></td>
                        <?php if( $userLevel < 2){?>
                            <td><a href="<?php echo base_url()?>sourceaction/addGoodsSkuValue/<?php echo $v->goods_sku_key_id?>/<?php echo $va->goods_sku_value_id?>">编辑</a><span class="caozuo_line">|</span>
                                <a style="cursor: pointer" onclick="javascript:if(confirm('确认删除？')){delGoodsSku(<?php echo $va->goods_sku_value_id?>,'skuValue','<?php echo base_url()?>');}">删除</a></td>
                        <?php }?>
                    </tr>
                <?php }?>
        <?php }?>
    </table>
</div>
</body>
</html>