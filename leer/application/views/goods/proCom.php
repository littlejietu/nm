<?php include_once(APPPATH . 'views/publish/head.php') ?>
<?php
$ComProarr =  explode(',',$GoodsProComArray[0] ); //读取第一组数据 截取成数组
?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once(APPPATH . 'views/publish/header.php') ?>
<!--header end-->
<div id="main">
    <div class="container">
        <!--产品对比 start-->
        <div class="proCom">
            <div class="proCom_top">产品对比</div>
            <table cellpadding="0" cellspacing="0" width="100%" class="proCom_table" bordercolor="#ebebeb" border="1">
                <tr height="199">
                    <th width="179">产品名称</th>
                    <?php
                    $num = 0;
                    if (!empty($goodsInfo)) {
                        foreach ($goodsInfo as $key => $value) {
                            ?>
                            <td width="228"><a href="<?php echo base_url().'/goodsaction/goodsdetail/'.$value->goods_id  ?>" class="proCom_pro"><img src="<?php echo $value->goods_thumb ?>"/> <p><?php echo $value->goods_name ?></p></a></td>
                            <?php
                            $num = $key + 1;
                        }
                    }
                    switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
                    for ($i = 0; $i < $num; $i++) { ?>
                        <td width="228"><h1 class="proCom_empty">暂无对比项</h1><a href="<?php echo !empty($GoodsProComArray)?base_url().'/goodsaction/index/'.$ComProarr[1]:'base_url()'.'/goodsaction/index/' ?>"onclick="ProCom(this)" class="proCom_add">添加</a></td>
                    <?php
                    }

                    ?>
                </tr>
                <tr height="50">
                    <th>价格</th>
                    <?php
                    $num = 0;
                    if (!empty($goodsInfo)) {
                        foreach ($goodsInfo as $key => $value) {
                            ?>
                            <td>
                                <div class="middle_new_price">￥<span><?php echo $value->shop_price ?></span></div>
                            </td>
                            <?php
                            $num = $key + 1;
                        }
                    }
                    switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
                    for ($i = 0; $i < $num; $i++) {
                        ?>
                        <td></td>
                    <?php
                    }
                    ?>
                </tr>
                    <?php
                   if(!empty($skuValue)){
                    foreach($skuValue as $key => $value){?>
                <tr height="50">
                    <!--属性名称-->
                    <th><?php echo $value ?></th>
                    <?php
                    $num = 0;
                    if(!empty($goodsInfo)){
                    foreach($goodsInfo as $k => $v){
                        if($value =='size'){
                      ?>
                    <td><?php echo  implode('、',$v->searchSkuSize)  ?></td>
                        <?php }else if($value =='color'){?>
                            <td><?php echo  implode('、',$v->searchSkuColor) ?></td>
                        <?php }else{?>
                            <td><?php echo (empty($v->searchSku[$value]))?'-':implode('、',$v->searchSku[$value]) ?></td>
                            <?php }?>
                    <?php
                        }
                        $num = $k + 1;
                       }

                    switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
                    for ($i = 0; $i < $num; $i++) {
                        ?>
                     <td></td>
                    <?php
                    }
                    ?>
                </tr>
                    <?php
                    }
                }
                    ?>
                <tr height="50">
                    <th>商品评分</th>
                    <?php
                    $num = 0;
                    if(!empty($goodsInfo)){
                        foreach($goodsInfo as $key => $value){
                  ?>
                    <td>
                        <dl class="star">
                            <?php for($i=0;$i< $value->aveNum;$i++){ ?>
                            <dd class="cur"></dd>
                        <?php } ?>
                        </dl>
                    </td>
                        <?php
                            $num = $key + 1;
                        }
                    }
                    switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
                    for ($i = 0; $i < $num; $i++) {
                    ?>
                    <td></td>
                    <?php
                    }
                    ?>
                </tr>
                <tr>
                    <th>产品描述</th>
                    <?php
                    $num = 0;
                    if(!empty($goodsInfo)){
                        foreach($goodsInfo as $key => $value){
                            ?>
                    <td>
                        <div class="proCom_intor"><?php echo $value->goods_intro?></div>
                    </td>
                        <?php
                        $num = $key + 1;
                    }
                    }
                    switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
                    for ($i = 0; $i < $num; $i++) {
                        ?>
                        <td></td>
                    <?php
                    }
                    ?>
                </tr>
                <tr height="50">
                    <th></th>
                    <?php
                    $num = 0;
                    if(!empty($goodsInfo)){
                    foreach($goodsInfo as $key => $value){
                    ?>
                    <td>
                        <div class="proCom_cz"><a target="_blank" href="<?php echo base_url().'/goodsaction/goodsdetail/'.$value->goods_id  ?>" class="proCom_addCart">购买产品</a><a href="##" class="proCom_det"></a>
                        </div>
                    </td>
                        <?php
                        $num = $key + 1;
                    }
                    }
                    switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
                    for ($i = 0; $i < $num; $i++) {
                        ?>
                        <td></td>
                    <?php
                    }
                    ?>
                </tr>
            </table>
        </div>
        <!--产品对比 end-->

        <!--middle_second start-->
        <?php include_once('hotRecommend.php') ?>
        <!--middle_second end-->
    </div>
</div>


<!--footer start-->
<?php include_once(APPPATH . 'views/publish/footer.php') ?>
<!--footer end-->


</body>
</html>