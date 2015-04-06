<?php include_once("right_head.php")?>
    <div class="common">
        <div class="tab orderTab">
            <ul class="tabtitle">
                <li <?php if($searchWhere['searchType'] == ''){?>class="cur"<?php }?>><a href="javascript:;">全部订单</a></li>
                <li <?php if($searchWhere['searchType'] === '0'){?>class="cur"<?php }?>><a href="javascript:;">未付款订单</a></li>
                <li <?php if($searchWhere['searchType'] == '1'){?>class="cur"<?php }?>><a href="javascript:;">待发货订单</a></li>
                <li <?php if($searchWhere['searchType'] == '2'){?>class="cur"<?php }?>><a href="javascript:;">已发货订单</a></li>
                <li <?php if($searchWhere['searchType'] == '3'){?>class="cur"<?php }?>><a href="javascript:;">已收货订单</a></li>
                <li <?php if($searchWhere['searchType'] == '4'){?>class="cur"<?php }?>><a href="javascript:;">售后订单</a></li>
                <li <?php if($searchWhere['searchType'] == '8'){?>class="cur"<?php }?>><a href="javascript:;">售后完成订单</a></li>
                <li <?php if($searchWhere['searchType'] == '9'){?>class="cur"<?php }?>><a href="javascript:;">取消订单</a></li>
                <li <?php if($searchWhere['searchType'] == 'threeMonthAgo'){?>class="cur"<?php }?>><a href="javascript:;">历史订单（三个月之前）</a></li>
            </ul>

            <div class="tabchild"  <?php if($searchWhere['searchType'] == ''){?>style="display:block;"<?php }?>><!--全部订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>

                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] === '0'){?>style="display:block;"<?php }?>><!--未付款订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="0" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>

                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == '1'){?>style="display:block;"<?php }?>><!--已付款未配送订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="1" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>

                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == '2'){?>style="display:block;"<?php }?>><!--已发货订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="2" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>
                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == '3'){?>style="display:block;"<?php }?>><!--已收货订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="3" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>
                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == '4'){?>style="display:block;"<?php }?>><!--售后订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="4" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>
                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == '8'){?>style="display:block;"<?php }?>><!--售后完成订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="8" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>
                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == '9'){?>style="display:block;"<?php }?>><!--取消订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="9" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>
                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="tabchild"  <?php if($searchWhere['searchType'] == 'threeMonthAgo'){?>style="display:block;"<?php }?>><!--三个月之前订单-->
                <form action="<?php echo base_url('orderaction/orderList')?>">
                    <input name="searchType" value="threeMonthAgo" type="hidden">
                    <table class="goodsTable">
                        <tr>
                            <td width="80" align="right">下单日期：</td>
                            <td colspan="3">
                                <input id="d4311" name="startTime" class="Wdate" type="text" value="<?php echo ($searchWhere['startTime'])?$searchWhere['startTime']:''?>"
                                       onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"/> -
                                <input id="d4312" name="endTime" class="Wdate" type="text"  value="<?php echo ($searchWhere['endTime'])?$searchWhere['endTime']:''?>"
                                       onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})"/>
                            </td>
                            <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单号：</td>
                            <td><input type="text" name="orderSn" value="<?php echo ($searchWhere['orderSn'])?$searchWhere['orderSn']:''?>"/></td>
                        </tr>
                        <tr height="50">
                            <td></td>
                            <td colspan="3"><input type="submit" value="查询" class="sub"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

            <div class="goodsList">
                

            <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
                <tr height="39" style="font-size:13px;">
                    <td>编号</td>
                    <td>订单号</td>
                    <td>会员</td>
                    <td>运费价格</td>
                    <td>总价</td>
                    <td>发票抬头</td>
                    <td>备注信息</td>
                    <td>订单状态</td>
                    <td>操作</td>
                </tr>
                <?php if(!empty($orderList)){?>
                <?php foreach((array)$orderList as $value){?>
                    <tr height="30">
                        <td><?php echo $value->order_id;?></td>
                        <td><a href="<?php echo base_url('orderaction/orderDetail/'.$value->order_id)?>"><?php echo $value->order_sn;?></a></td>
                        <td><?php echo $value->userNikeName;?></td>

                        <td><?php echo $value->shipping_price;?></td>
                        <td><?php echo $value->order_price;?></td>
                        <td><?php echo $value->invoice;?></td>
                        <td><?php echo $value->remark;?></td>
                        <td>
                            <?php
                                echo $value->orderType;
                                if($value->orderType == '退货完成'){
                                    echo '<br>';
                                    echo '<font color = "#f00" >退款金额：￥'.$value->exit_money.'</font>';
                                }
                            ?>

                        </td>
                        <td>
                            <?php
                                switch($value->order_type){
                                    case 0:
                                        echo '<a href="javascript:;" onclick="Payment('.$value->order_id.','.$value->order_price.')">支付(￥'.$value->order_price.')</a>';
                                    break;
                                    case 1:
                                        echo '<a href="javascript:;" onclick="Distribution('.$value->order_id.')">配送</a>';
                                    break;
                                    case 2:
                                        echo '<a href="javascript:;" onclick="javascript:if(confirm(\'确认收货？\')){receiveGoods('.$value->order_id.',\''.base_url().'\')}">确认收货</a>';
                                    break;
                                    case 3:
                                        echo '<a href="javascript:;" onclick="ReturnGoods('.$value->order_id.')">退货</a>/<a href="javascript:;" onclick="ExchangeGoods('.$value->order_id.')">换货</a>';
                                    break;
                                    case 4:
                                        echo '<a href="javascript:;" onclick="javascript:if(confirm(\'确定要取消换货？\')){receiveGoods('.$value->order_id.',\''.base_url().'\')}">取消换货</a>';
                                        if(isset($userLevel) && $userLevel < 2){
                                            echo '/<a href="javascript:;" onclick="ReDistribution('.$value->order_id.')">重新配送</a>';
                                        }
                                    break;
                                    case 5:
                                        echo '<a href="javascript:;" onclick="javascript:if(confirm(\'确定要取消退货？\')){receiveGoods('.$value->order_id.',\''.base_url().'\')}">取消退货</a>';
                                        if(!empty($userLevel) && $userLevel < 2){
                                            echo '/<a href="javascript:;" onclick="Refund('.$value->order_id.',\''.empty($myConfig['change_goods'])?'':$myConfig['change_goods'][$value->change_goods].'\',\''.$value->change_goods_intro.'\')">退款</a>';
                                        }
                                    break;
                                    case 6:
                                        echo '订单已完成';
                                    break;
                                    case 7:
                                        echo '<a href="javascript:;" onclick="javascript:if(confirm(\'确认收货？\')){receiveGoodsResend('.$value->order_id.',\''.base_url().'\')}">确认收货</a>';
                                    break;
                                    case 8:
                                        echo '订单已完成';
                                    break;
                                    case 9:
                                        echo '订单已取消';
                                    break;
                                    case 10:
                                        echo '<a href="javascript:;" onclick="Payment('.$value->order_id.','.$value->order_difference.')">支付(￥'.$value->order_difference.')</a>';
                                    break;
                                    case 11:
                                        echo '<a href="javascript:;" onclick="Payment('.$value->order_id.','.($value->order_difference + $value->order_price).')">支付(￥'.($value->order_difference + $value->order_price).')</a>';
                                    break;
                                }
                            ?>
                        </td>
                    </tr>
                <?php }?>
                <?php }?>
            </table>
                <br>
                <div class="page">
                    <?php echo $pageHtml;?>
                </div>
            </div>


    </div>
<?php include_once('ordertypediv.php')?>





<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/js/address.js"></script>
<script type="text/javascript">
$(function(){
$("#sjld").sjld();
})
</script>


</body>
</html>