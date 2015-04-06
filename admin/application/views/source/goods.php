<?php include_once("right_head.php") ?>
<div class="common">
    <div>
        <?php if (empty($isSearch)) { //不是搜索信息?>
            <!--            <div class="goodsTitle"><a href="--><?php //echo base_url('sourceaction/addGoods') ?><!--" class="topBtn"><b>添加商品</b></a>-->
            <!--            </div>-->

            <?php /*?><table style="margin:20px 0 30px 0;">
                <tr>
                    <td valign="top">
                        <div class="goodsTitle"><a href="javascript:"><b>批量导入商品:</b></a></div>
                    </td>
                    <td>
                        <?php
                        if (!empty($error)){
                            echo $error;
                        } elseif (!empty($exXls)) {
                            echo '商品添加成功！';
                        }
                        else{
                        echo form_open_multipart('sourceaction/goods');
                        ?>

                        <input type="hidden" name="act" value="upload" size="20"/>
                        <input class="fl" type="file" name="userfile" size="20" style="width: 160px"/>
                        <label class="right_label fl"><input type="radio" name="inserttype" value="1">添加商品</label>
                        <label class="right_label fl"><input type="radio" name="inserttype" value="2" checked>更新库存</label>
                        <input type="submit" value="开始上传" class="sub"/>
                        </form>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <?php */
            ?>
        <?php } else { //是搜索信息?>
           <!-- <form action="<?php /*echo base_url('sourceaction/index/goods') */?>">
                <span>请输入货号：</span>
                <input name="search" must="ture"><span class="tips"></span>
                <button type="submit" onclick="return subForm()">查询</button>
            </form><br>-->
        <?php } ?>
     </div>
    <form name="form1" method="post" action="<?php echo base_url(); ?>index.php/sourceaction/goods">
        <div class="seach">
          <div class="fl">查询：</div>
          <div class="fl">
            <div class="clearfix mrgB10">
              <input type="text" name="search" value="<?php echo !empty($search)?$search:'商品名称' ?>"  onblur="blurText(this,'商品名称')" onfocus="focusText(this,'商品名称')" class="normalText fl mrgR10"/>
         	  <input type="text" name="goodssn" value="<?php echo !empty($goodssn)?$goodssn:'货号' ?>"  onblur="blurText(this,'货号')" onfocus="focusText(this,'货号')" class="normalText fl mrgR10"/>
         		<select name ="catid" class="normalSelect fl mrgR10">
            	  <option value="">商品分类</option>
              	  <?php foreach($cateList as $k => $v){?>
                  <option  <?php echo $classId == $v->cat_id ?'selected':'' ?>   value="<?php echo $v->cat_id?>"><?php echo $v->cat_name ?></option>
                  <?php }?>
                </select>
          		<select name="brandid" class="normalSelect fl mrgR10">
                  <option value="">品牌</option>
                  <?php foreach($brandList as $k => $v){?>
                  <option value="<?php echo $v->brand_id?>" <?php echo $brandid == $v->brand_id?'selected':''?>><?php echo $v->brand_name?></option>
                  <?php }?>
          		</select>
            </div>
            <div class="clearfix mrgB10">
              <select name="brandauthorizeid" class="normalSelect fl mrgR10">
                <option value="">产品品牌</option>
                <?php foreach($brandAuthorizeList as $k => $v){?>
                    <option value="<?php echo $v->brand_id?>" <?php echo $brandauthorizeid == $v->brand_id?'selected':'';?>><?php echo $v->brand_name?></option>
                <?php }?>
              </select>
              <select name="isonsale" class="normalSelect fl mrgR10">
                <option value="">是否在售</option>
                <option <?php echo $isonsale == 1?'selected':'';?>  value="1">是</option>
                <option <?php echo $isonsale == 0?'selected':'';?>  value="0" >否</option>
              </select>
              <select name="isdelete" class="normalSelect fl mrgR10">
                <option value="">是否已删除</option>
                <option <?php echo $isdelete == 1?'selected':'';?>  value="1">是</option>
                <option <?php echo $isdelete == 0?'selected':'';?> value="0" >否</option>
              </select>
              <select name="isrmd" class="normalSelect fl mrgR10">
                <option value="">是否推荐</option>
                <option <?php echo $isrmd == 1?'selected':'';?> value="1">是</option>
                <option <?php echo $isrmd == 0?'selected':'';?> value="0" >否</option>
              </select>
            </div>
          </div>
          <input type="submit" class="sub" value="查询"/>
        </div>
    </form>
    <?php if (!empty($goodsList)) { ?>
        <div class="goodsList">
            <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
                <tr height="39" style="font-size:13px;">
                    <td>编号</td>
                    <td>商品分类</td>
                    <td>商品名称</td>
                    <td>货号</td>
                    <td>品牌</td>
                    <td>缩略图</td>
                    <td>是否在售</td>
                    <?php if ($user['userLevel'] < 3) { ?>
                        <td>是否已删除</td>
                    <?php } ?>
                    <td>操作</td>
                </tr>
                <?php foreach ((array)$goodsList as $value) { ?>
                    <tr>
                        <td><?php echo $value->goods_id; ?></td>
                        <td><?php echo $value->cat_name; ?></td>
                        <td><a <?php if ($value->isOutOfDate) {echo 'style="color:#f00" title="商品已过期！"';} else {?> href="javascript:;" onclick="showGoodsDetail(this,<?php echo $value->goods_id; ?>,'<?php echo base_url() ?>');"<?php } ?> ><?php echo $value->goods_name; ?></a></td>
                        <td><?php echo $value->goods_sn; ?></td>
                        <td><?php echo $value->brand_name; ?></td>
                        <td>
                            <?php if ($value->goods_thumb) {?><img src="<?php echo $value->goods_thumb; ?>" width="100" style="padding: 10px 0px"> <?php } ?>
                        </td>
                        <td><?php echo $value->is_on_sale; ?></td>
                        <td><?php echo $value->is_delete; ?></td>
                        <td>
                            <a href="<?php echo base_url('sourceaction/addgoodsphoto/' . $value->goods_id . '/' . $value->goods_name) ?>">添加产品图</a>
                            <span class="caozuo_line">|</span>
                            <a href="<?php echo base_url('sourceaction/addGoods/' . $value->goods_id) ?>">编辑</a>
                            <span class="caozuo_line">|</span>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){delGoods(this,<?php echo $value->goods_id ?>,'<?php echo base_url() ?>');}">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br>

            <div class="page">
                <?php echo $pageHtml; ?>
            </div>
        </div>
    <?php } ?>


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
                    <button type="button"
                            onclick="autoChangeAddress($('#addressAll').val(),'<?php echo base_url() ?>')">拆分
                    </button>
                </td>
            </tr>
            <tr height="40">
                <td>选择快递：</td>
                <td>
                    <select name="express" id="expressId"
                            onchange="changeExpressCost($('#expressId').val(),$('#sfdq_tj').val(),$('#buy_goods_sku_weight').val(),'<?php echo base_url() ?>')"
                            class="normalSelect">
                        <option>请选择</option>
                        <?php
                        if (!empty($expressList)) {
                            foreach ($expressList as $key => $value) {
                                ?>
                                <option
                                    value="<?php echo $value->express_id ?>"><?php echo $value->express_name ?></option>
                            <?php
                            }
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