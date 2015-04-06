<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsTitle"><a href="<?php echo base_url('sourceaction/addGoods') ?>"><b>添加图片</b></a></div>
        <div class="goodsList">
            <table class="listTab">
                <tr>
                    <td>编号</td>
                    <?php if(!empty($photoType) && $photoType == 'goods'){?>
                    <td>商品ID</td>
                    <?php }else{?>
                    <td>属性ID</td>
                    <?php }?>
                    <td>缩略图</td>
                    <td>原图</td>
                    <td>排序</td>
                    <td>操作</td>
                </tr>
                <?php foreach ((array)$goodsPhoto as $value) { ?>
                    <tr>
                        <td><?php echo $value->photo_id; ?></td>
                        <?php if(!empty($photoType) && $photoType == 'goods'){?>
                            <td><?php echo $value->goods_id?></td>
                        <?php }else{?>
                            <td><?php echo $value->goods_sku_id?></td>
                        <?php }?>
                        <td><?php echo $value->goods_sn; ?></td>
                        <td><?php echo $value->brand_name; ?></td>
                        <td><?php echo $value->channel_name; ?></td>
                        <td>
                            <a href="<?php echo base_url('sourceaction/goodsPhoto/' . $value->goods_id) ?>">商品相册</a>|
                            <a href="<?php echo base_url('sourceaction/addGoods/' . $value->goods_id) ?>">编辑</a>|
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){delGoods(this,<?php echo $value->goods_id ?>,'<?php echo base_url() ?>');}">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>



</div>

<div id="addGoods">
    <a href="javascript:;" class="addGoods_close" onclick="addGoodsClose(this)"></a>

    <form action="<?php echo base_url() ?>index.php/orderaction/addOrder" method="post">
        <input type="hidden" id="baseUrl" value="<?php echo base_url() ?>">
        <input type="hidden" id="buy_goods_id" name="goods_id" value=""/>
        <input type="hidden" id="buy_goods_sku_id" name="goods_sku_id" value=""/>
        <input type="hidden" id="buy_goods_sku_weight" name="goods_sku_weight" value=""/>

        <table cellpadding="0" cellspacing="0" class="addGoods_tab">
            <tr height="40">
                <td>数量：</td>
                <td>
                    <input name="goods_num" value="1" id="goodsNum"
                           onchange="changeExpressCost($('#expressId').val(),$('#sfdq_tj').val(),$('#buy_goods_sku_weight').val(),'<?php echo base_url() ?>')">
                </td>
            </tr>
            <tr>
                <td>地址拆分：</td>
                <td><textarea id="addressAll" cols="60"></textarea></td>
                <td>
                    <button type="button" onclick="autoChangeAddress($('#addressAll').val(),'<?php echo base_url()?>')">拆分</button>
                </td>
            </tr>
            <tr height="40">
                <td>选择快递：</td>
                <td>
                    <select name="express" id="expressId"
                            onchange="changeExpressCost($('#expressId').val(),$('#sfdq_tj').val(),$('#buy_goods_sku_weight').val(),'<?php echo base_url() ?>')"  class="normalSelect">
                        <option>请选择</option>
                        <?php
                        if (!empty($expressList)) {
                            foreach ($expressList as $key => $value) {
                                ?>
                                <option
                                    value="<?php echo $value->express_id ?>"><?php echo $value->express_name ?></option>
                            <?php }
                        } ?>
                    </select>
                    <span><font color="#f00">&nbsp;&nbsp;运费：<span id="express_cost">0</span>元</font></span>
                    <input class="express_cost" name="express_cost" value="" type="hidden">
                </td>
            </tr>
            <tr height="40">
                <td>选择地址：</td>
                <td>
                    <div id="sjld">
                        <div class="m_zlxg" id="shenfen">
                            <p title="" id="sfdq_title"></p>

                            <div class="m_zlxg2">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="m_zlxg" id="chengshi">
                            <p title="" id="csdq_title">选择城市</p>

                            <div class="m_zlxg2">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <div class="m_zlxg" id="quyu">
                            <p title="" id="qydq_title">选择区/县</p>

                            <div class="m_zlxg2">
                                <ul>
                                </ul>
                            </div>
                        </div>
                        <input id="sfdq_num" type="hidden" value=""/>
                        <input id="csdq_num" type="hidden" value=""/>

                        <input id="sfdq_tj" name="province" type="hidden" value=""/>
                        <input id="csdq_tj" name="city" type="hidden" value=""/>
                        <input id="qydq_tj" name="area" type="hidden" value=""/>
                    </div>
                </td>
            </tr>
            <tr height="40">
                <td></td>
                <td><input type="text" name="address" placeholder="输入详细地址" class="addText" id="addDet"/></td>
            </tr>
            <tr height="40">
                <td>收件人：</td>
                <td><input type="text" id="name" name="name"/></td>
            </tr>
            <tr height="40">
                <td>手机号：</td>
                <td><input type="text" id="tel" name="tel"/></td>
            </tr>
            <tr height="40">
                <td>座机电话：</td>
                <td><input type="text" id="phone" name="phone"/></td>
            </tr>
            <tr height="40">
                <td>填写邮编：</td>
                <td><input type="text" id="zip" name="zip_code"/></td>
            </tr>
            <!--<tr height="40">
                <td>支付方式：</td>
                <td>
                    <input type="radio" name="payment" value="1" checked>余额支付
                    <input type="radio" name="payment" value="2" disabled>支付宝支付
                    <input type="radio" name="payment" value="3" disabled>银联支付
                </td>
            </tr>-->
            <tr height="40">
                <td>备注：</td>
                <td><input type="text" class="addText" name="remark"/></td>
            </tr>
            <tr height="40">
                <td></td>
                <td><input type="submit" class="sub" value="提交订单" onclick="return buyForm()"></td>
            </tr>
        </table>
    </form>
</div>
<div id="layer"></div>

<script type="text/javascript" src="<?php echo base_url(); ?>resources/backstage/js/address.js"></script>
<script type="text/javascript">
    $(function () {
        $("#sjld").sjld();
    })
</script>
</body>
</html>