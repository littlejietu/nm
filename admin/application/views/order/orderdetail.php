<?php include_once("right_head.php")?>
    <div class="common">
        <?php if(!empty($orderInfo) && !empty($orderGoodsList) && !empty($consigneeInfo)){?>
        <p>订单号：<?php echo $orderInfo->order_sn?></p>
        <p>价格：<?php echo $orderInfo->order_price?></p>
        <p>运费价格：<?php echo $orderInfo->shipping_price?></p>
        <p>运费状态：<?php echo $orderInfo->orderType;?></p>
            <p>&nbsp;</p>
            <?php foreach($orderGoodsList as $value){?>
                <p>商品名称：<?php echo $value->goods_name?></p>
                <p>商品货号：<?php echo $value->goods_sn?></p>
                <p>商品属性：
                    <?php
                        if($value->goods_color){echo '&nbsp;&nbsp;颜色：'.$value->goods_color;}
                        if($value->goods_size){echo '&nbsp;&nbsp;尺码：'.$value->goods_size;}
                        if($value->goods_sku_key){echo '&nbsp;&nbsp;'.$value->goods_sku_key.'：'.$value->goods_sku_value;}
                    ?>
                </p>
                <p>商品单价：<?php echo $value->goods_price?></p>
                <p>商品数量：<?php echo $value->goods_num?></p>
                <p>&nbsp;</p>
            <?php }?>

        <p>收货人：<?php echo $consigneeInfo->user_real_name?></p>
        <p>地址：<?php echo $consigneeInfo->province?>省 <?php echo $consigneeInfo->city?> <?php echo $consigneeInfo->area?> <?php echo $consigneeInfo->address?></p>
        <p>邮政编码：<?php echo $consigneeInfo->email_code?></p>
        <p>手机号：<?php echo $consigneeInfo->user_tel?></p>
        <?php }?>

    </div>
</body>
</html>