<!--充值-->
<div id="onlinePay" class="tkBox">
    <a href="javascript:;" class="addGoods_close" onclick="addGoodsClose(this)"></a>

    <div class="tkBox_title">在线充值</div>
    <form action="<?php echo base_url() ?>index.php/orderaction/sendGoods" method="post">
        <input type="hidden" name="order_id" class="jsReplaceOrderId">
        <input type="hidden" name="order_type" value="7">
        <table cellpadding="0" cellspacing="0" class="">
            <tr height="40">
                <td>充值方式：</td>
                <td>
                    <select>
                        <option></option>
                        <option>支付宝拍款充值</option>
                    </select>
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>户名：</td>
                <td><input></td>
            </tr>
            <tr height="40">
                <td>淘宝订单号：</td>
                <td>
                    <input>
                </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>充值金额：</td>
                <td>
                    <input>
                </td>
            </tr>
            <tr height="40">
                <td>备注：</td>
                <td colspan="4">
                    <textarea cols="80"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="sub" value="确认"></td>
            </tr>
        </table>
    </form>
</div>

<div id="layer"></div>





