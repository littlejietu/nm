<!--支付-->
<div id="Payment" class="tkBox">
    <a href="javascript:;" class="addGoods_close" onclick="addTkClose(this)"></a>

    <form action="<?php echo base_url() ?>index.php/orderaction/payOrder" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">

        <div class="tkBox_title">支付</div>
        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="40">
                <td>支付金额：</td>
                <td id="orderMoney"></td>
            </tr>
            <tr height="40">
                <td>支付方式：</td>
                <td><label class="normalLabel"><input type="radio" name="payment" value="1" checked="checked"
                                                      class="normalCheck">余额支付</label>
                    <label class="normalLabel"><input type="radio" name="payment" value="2" class="normalCheck"
                                                      disabled>银行卡支付</label>
                    <label class="normalLabel"><input type="radio" name="payment" value="3" class="normalCheck"
                                                      disabled>支付宝支付</label></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认支付"></td>
            </tr>
        </table>
    </form>
</div>

<!--配送-->
<div id="Distribution" class="tkBox">
    <div class="tkBox_title">配送</div>
    <a href="javascript:;" class="addGoods_close" onclick="addTkClose(this)"></a>

    <form action="<?php echo base_url() ?>index.php/orderaction/sendGoods" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">
        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="50">
                <td>配送物流：</td>
                <td><input type="text" name="shipping_sn"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认"></td>
            </tr>
        </table>
    </form>
</div>

<!--退货-->
<div id="ReturnGoods" class="tkBox">
    <a href="javascript:;" class="addGoods_close" onclick="addTkClose(this)"></a>

    <div class="tkBox_title">退货</div>
    <form action="<?php echo base_url() ?>index.php/orderaction/changeGoods" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">
        <input type="hidden" name="change_type" value="0">
        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="40">
                <td>退货理由：</td>
                <td>
                    <?php foreach ($myConfig['change_goods'] as $key => $value) { ?>
                        <label class="normalLabel"><input type="radio" name="question" <?php if ($key == 1) {
                                echo 'checked';
                            } ?> class="normalCheck" value="<?php echo $key ?>"/><?php echo $value ?></label>
                    <?php } ?>
                </td>
            </tr>
            <tr height="40">
                <td>说明：</td>
                <td>
                    <textarea cols="60" rows="3" maxlength="500" type="text" name="intro"></textarea>
                </td>
            </tr>
            <tr height="40">
                <td></td>
                <td>

                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认"></td>
            </tr>
        </table>
    </form>
</div>

<!--换货-->
<div id="ExchangeGoods" class="tkBox">
    <a href="javascript:;" class="addGoods_close" onclick="addTkClose(this)"></a>

    <div class="tkBox_title">换货</div>
    <form action="<?php echo base_url() ?>index.php/orderaction/changeGoods" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">
        <input type="hidden" name="change_type" value="1">
        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="40">
                <td>换货理由：</td>
                <td>
                    <?php foreach ($myConfig['change_goods'] as $key => $value) { ?>
                        <label class="normalLabel"><input type="radio" name="question" <?php if ($key == 1) {
                                echo 'checked';
                            } ?> class="normalCheck" value="<?php echo $key ?>"/><?php echo $value ?></label>
                    <?php } ?>
                </td>
            </tr>
            <tr height="40">
                <td>说明：</td>
                <td>
                    <textarea cols="60" rows="3" maxlength="500" type="text" name="intro"></textarea>
                </td>
            </tr>
            <tr height="40">
                <td></td>
                <td>

                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认"></td>
            </tr>
        </table>
    </form>
</div>


<!--重新配送-->
<div id="ReDistribution" class="tkBox">
    <a href="javascript:;" class="addGoods_close" onclick="addGoodsClose(this)"></a>

    <div class="tkBox_title">重新配送</div>
    <!--<div class="tkBox_main">商品信息</div>-->
    <form action="<?php echo base_url() ?>index.php/orderaction/sendGoods" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">
        <input type="hidden" name="order_type" value="7">
        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="40">
                <td>配送物流：</td>
                <td><input type="text" name="shipping_sn"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认"></td>
            </tr>
        </table>
    </form>
</div>

<!--退款-->
<div id="Refund" class="tkBox">
    <a href="javascript:;" class="addGoods_close" onclick="addGoodsClose(this)"></a>

    <div class="tkBox_title">退款</div>
    <div class="tkBox_main"></div>
    <table>
        <tr>
            <td>退款理由：</td>
            <td id="exitReason">
            </td>
        </tr>
        <tr>
            <td>退款说明：</td>
            <td id="exitIntro">
            </td>
        </tr>
    </table>
    <form action="<?php echo base_url() ?>index.php/orderaction/exitMoney" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">
        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="40">
                <td>退款金额：</td>
                <td><input type="text" name="exit_money"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认"></td>
            </tr>
        </table>
    </form>
</div>

<div id="layer"></div>





