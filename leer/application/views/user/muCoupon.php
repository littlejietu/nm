<?php include_once(APPPATH . 'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
    <div class="container">
        <!--center_left start-->
        <?php include_once('center_nav.php') ?>
        <!--center_left end-->
        <!--center_right start-->
        <div class="centerRight fr" id="centerRight">
            <!--centerRight_top start-->
            <?php include_once('center_top.php') ?>
            <!--centerRight_top end-->

            <!--centerRight_main start-->
            <div class="centerRight_main centerRightBg myOrder">
                <div class="center_title">
                    <div class="fl">我的优惠券</div>
                </div>
                <!--center_main start-->
                <div class="center_main">
                    <ul class="myOrder_title">
                        <li style="width:144px;padding:0 0 0 69px;text-align:left;">优惠券编码</li>
                        <li style="width:132px;">优惠金额</li>
                        <li style="width:132px;">使用满足金额</li>
                        <li style="width:154px;">活动来源</li>
                        <li style="width:102px;">到期时间</li>
                        <li style="width:111px;">使用时间</li>
                    </ul>
                    <div class="myOrder_main">
                        <?php
                        if (!empty($couponList)) {
                            foreach ($couponList as $key => $value) {
                                ?>
                                <ul class="myOrder_list clearfix <?php echo($value->istatus==1?'couponUsed':$value->istatus==2?'couponUsed':'' )?>">
                                    <li style="width:197px;padding:0 0 0 16px;">
                                        <div class="couponNum"><?php echo $value->dc_coding ?></div>
                                    </li>
                                    <li style="width:132px;" class="ArialBold15 alignC couponMoney">
                                        ￥<?php echo $value->dc_money ?></li>
                                    <li style="width:132px;"
                                        class="alignC lineH77">￥<?php echo $value->dc_meet_money ?></li>
                                    <li style="width:154px;" class="alignC lineH77"><?php echo $value->dc_title ?>
                                        -<?php echo $value->acti_title ?></li>
                                    <li style="width:102px;"
                                        class="alignC lineH77"><?php echo !empty($value->adc_end_time) ? date("Y-m-d", $value->adc_end_time) : "" ?></li>
                                    <li style="width:111px;"
                                        class="alignC lineH77"><?php echo($value->add_time == $value->last_time ? '未使用' : $value->last_time) ?></li>
                                </ul>
                            <?php
                            }
                        } ?>
                    </div>
                    <div class="borderB"></div>
                    <div class="page pdTB34 clearfix pageCenter">
                        <?php echo $pageHtml ?>
                    </div>
                </div>
                <!--center_main end-->
            <!--centerRight_main end-->
        </div>
        <!--center_right end-->
        <div class="clear"></div>
        <!--middle_second start-->
        <?php include_once('recommend.php') ?>
        <!--middle_second end-->
    </div>
</div>
</div>
</body>
</html>