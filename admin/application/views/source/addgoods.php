<?php include_once("right_head.php") ?>
    <div class="common">
        <b style="font-size:20px;">添加商品</b>
        <form action="<?php echo base_url();?>index.php/sourceaction/goods"  method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="hidden" name="act" value="add" size="20" />
            <?php if(!empty($goodsInfo)){?>
            <input type="hidden" name="id" value="<?php echo $goodsInfo->goods_id?>" size="20" />
            <input type="hidden" name="sku_id" value="<?php echo $goodsInfo->goods_id?>" size="20" />
            <?php }?>
            <div class="tab">
                <ul class="tabtitle">
                    <li class="cur"><a href="javascript:;">基本信息</a></li>
                    <li><a href="javascript:;">属性信息</a></li>
                    <li><a href="javascript:;">商品详情</a></li>
                    <li><a href="javascript:;">专业参数</a></li>
                    <li><a href="javascript:;">微信产品详情</a></li>
                </ul>
                <div class="tabchild" style="display:block;"  id="tabchild1">
                <table class="goodsTable">
                <tr>
                    <td>商品名：</td>
                    <td><input name="goods_name" value="<?php echo empty($goodsInfo)?'':$goodsInfo->goods_name;?>" must="ture" type="text" class="normalText"><span class="tips">*</span></td>
                </tr>
                <tr>
                    <td>货号：</td>
                    <td><input name="goods_sn"  value="<?php echo empty($goodsInfo)?'':$goodsInfo->goods_sn;?>"  must="ture"  type="text"  class="normalText"><span class="tips">*</span></td>
                </tr>
                <tr>
                    <td>缩略图：</td>
                    <td>
                        <?php
                        if(!empty($goodsInfo) && $goodsInfo->goods_thumb){
                            ?>
                            <img src="<?php echo $goodsInfo->goods_thumb;?>" width="100" style="padding: 10px 0px">
                        <?php }?>
                        <input name="goods_img" type="file"  value="<?php echo empty($goodsInfo)?'':$goodsInfo->goods_thumb;?>" >
                    </td>
                </tr>
                    <tr>
                        <td>二维码：</td>
                        <td>
                            <?php
                            if(!empty($goodsInfo) && !empty($goodsInfo->goods_two_dimensional_code_img)){
                                ?>
                                <img src="<?php echo $goodsInfo->goods_two_dimensional_code_img;?>" width="100" style="padding: 10px 0px">
                            <?php }?>
                            <input name="goods_two_dimensional_code_img" type="file"  value="<?php echo empty($goodsInfo->goods_two_dimensional_code_img)?'':$goodsInfo->goods_two_dimensional_code_img;?>" >
                        </td>
                    </tr>
                <tr>
                    <td>品牌：</td>
                    <td><select name="brand_id" class="normalSelect">
                            <?php foreach($brandList as $k => $v){?>
                            <option value="<?php echo $v->brand_id?>" <?php if(!empty($goodsInfo) && $goodsInfo->brand_id == $v->brand_id){echo 'selected';}?>><?php echo $v->brand_name?></option>
                            <?php }?>
                    </select></td>
                </tr>
                    <tr>
                        <td>产品品牌：</td>
                        <td><select name="brand_authorize_id" class="normalSelect">
                                <option>请选择</option>
                                <?php foreach($brandAuthorizeList as $k => $v){?>
                                    <option value="<?php echo $v->brand_id?>" <?php if(!empty($goodsInfo) && $goodsInfo->brand_authorize_id == $v->brand_id){echo 'selected';}?>><?php echo $v->brand_name?></option>
                                <?php }?>
                            </select></td>
                    </tr>
                <tr>
                    <td>分类：</td>
                    <td><select name="cat_id"  class="normalSelect" onChange="getAttr(this,'<?php echo base_url()?>','<?php echo($goodsSkuStr);?>')">
                            <?php foreach($cateList as $k => $v){?>
                            <option rel="<?php echo($v->goods_sku_key_id)?>"  value="<?php echo $v->cat_id?>" <?php if(!empty($goodsInfo) && $goodsInfo->cat_id == $v->cat_id){echo 'selected';}?> ><?php echo $v->cat_name ?></option>
                            <?php }?>
                    </select></td>
                </tr>
                <tr>
                    <td>市场价：</td>
                    <td><input name="market_price" value="<?php echo empty($goodsInfo)?'':$goodsInfo->market_price;?>"  must="ture" type="text"  class="normalText" /><span class="tips">*</span></td>
                </tr>
<!--                <tr>-->
<!--                    <td>进货价：</td>-->
<!--                    <td><input name="in_price" value="--><?php //echo empty($goodsInfo)?'':$goodsInfo->in_price;?><!--"  must="ture"  type="text"  class="normalText" /><span class="tips">*</span></td>-->
<!--                </tr>-->
                <tr>
                    <td>商品价格：</td>
                    <td><input name="shop_price" value="<?php echo empty($goodsInfo)?'':$goodsInfo->shop_price;?>"  must="ture"  type="text"  class="normalText" /><span class="tips">*</span></td>
                </tr>
                    <tr>
                        <td>商品销量：</td>
                        <td><input name="goods_sell_num" value="<?php echo empty($goodsInfo)&& empty($goodsInfo->goods_sell_num)?'':$goodsInfo->goods_sell_num;?>"  must="ture"  type="text"  class="normalText" /><span class="tips">*</span></td>
                    </tr>
                <tr>
                    <td height="110" valign="top"><span style="line-height:40px;">商品介绍：</span></td>
                    <td><textarea cols="60" name="goods_intro" class="normalArea"><?php echo empty($goodsInfo)?'':$goodsInfo->goods_intro;?></textarea></td>
                </tr>
                <tr>
                    <td>商品季节：</td>
                    <td>
                        <select name="goods_spring" class="normalSelect" />
                        <option value="1" <?php if(!empty($goodsInfo) && $goodsInfo->goods_spring == 5){echo 'selected';}?>>全季</option>
                            <option value="1" <?php if(!empty($goodsInfo) && $goodsInfo->goods_spring == 1){echo 'selected';}?>>春季</option>
                            <option value="2" <?php if(!empty($goodsInfo) && $goodsInfo->goods_spring == 2){echo 'selected';}?>>夏季</option>
                            <option value="3" <?php if(!empty($goodsInfo) && $goodsInfo->goods_spring == 3){echo 'selected';}?>>秋季</option>
                            <option value="4" <?php if(!empty($goodsInfo) && $goodsInfo->goods_spring == 4){echo 'selected';}?>>冬季</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品性别：</td>
                    <td>
                        <select name="goods_sex" class="normalSelect">
                            <option value="1" <?php if(!empty($goodsInfo) && $goodsInfo->goods_sex == 2){echo 'selected';}?>>通用</option>
                            <option value="1" <?php if(!empty($goodsInfo) && $goodsInfo->goods_sex == 1){echo 'selected';}?>>男</option>
                            <option value="0" <?php if(!empty($goodsInfo) && $goodsInfo->goods_sex == 0){echo 'selected';}?>>女</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>是否推荐：</td>
                    <td>
                        <label class="normalLabel"><input type="radio" name="is_rmd" value="1" <?php if(!empty($goodsInfo) && $goodsInfo->is_rmd == 1){echo 'checked';}?>>是</label>
                        <label class="normalLabel"><input type="radio" name="is_rmd" value="0" <?php if(empty($goodsInfo) or $goodsInfo->is_rmd == 0){echo 'checked';}?>>否</label>
                    </td>
                </tr>
                <tr>
                    <td>是否新品：</td>
                    <td>
                       <label class="normalLabel"> <input type="radio" name="is_new" value="1" <?php if(!empty($goodsInfo) && $goodsInfo->is_new == 1){echo 'checked';}?>>是</label>
                        <label class="normalLabel"><input type="radio" name="is_new" value="0" <?php if(empty($goodsInfo) or $goodsInfo->is_new == 0){echo 'checked';}?>>否</label>
                    </td>
                </tr>
                <tr>
                    <td>是否热卖：</td>
                    <td>
                        <label class="normalLabel"><input type="radio" name="is_hot" value="1" <?php if(!empty($goodsInfo) && $goodsInfo->is_hot == 1){echo 'checked';}?>>是</label>
                        <label class="normalLabel"><input type="radio" name="is_hot" value="0" <?php if(empty($goodsInfo) or $goodsInfo->is_hot == 0){echo 'checked';}?>>否</label>
                    </td>
                </tr>
                        <?php /*?>
                        <?php if(!empty($goodsInfo)){?>
                            <tr>
                                <td>商品相册：</td>
                                <td>
                                    <a href="<?php echo base_url('sourceaction/goodsPhoto/'.$goodsInfo->goods_id) ?>">添加/更改 商品相册</a>
                                </td>
                            </tr>
                        <?php }?>
                        <?php */?>
            </table>
                </div>
                <div class="tabchild" id="tabchild2">
                   
                        <?php
                            if(!empty($goodsInfo)){
                                foreach($goodsInfo->goodsSku as $k => $v){
                        ?>
                         <table class="goodsTable goodsSkuTable">
                        <tr class="goodsSkuTitle">
                            <td style="font-weight: bold">属性<span class="skuNo"><?php echo $k+1;?></span></td>
                            <td class="deleteNewSku">&nbsp;</td>
                        </tr>
                        <?php
                                    foreach($goodsSkuList as $value){
                        ?>
                        <tr class="goodsSku">
                            <td><?php echo $value->sku_key?>：</td>
                            <td>
                                <select name="skuname[<?php echo $v->goods_sku_id?>][<?php echo $value->goods_sku_key_id?>]" class="normalSelect">
                                    
                                    <?php foreach($value->value as $val){?>
                                    <option value="<?php echo $val->goods_sku_value_id?>" <?php
                                            $isHaveThisSku = 0;
                                            if($value->goods_sku_key_id == 1){//size属性
                                                if($v->sku_size_id == $val->goods_sku_value_id){
                                                    $isHaveThisSku = 1;
                                                }
                                            }elseif($value->goods_sku_key_id == 2){//color属性
                                                if($v->sku_color_id == $val->goods_sku_value_id){
                                                    $isHaveThisSku = 1;
                                                }
                                            }else{//其他自定义属性
                                                /*拆分属性的keyid和valueid*/
                                                $tempSkuKeyIdArr        = explode(',',$v->sku_key_id);
                                                $tempSkuValueIdArr      = explode(',',$v->sku_value_id);
                                                foreach($tempSkuKeyIdArr as $skuK => $skuV){
                                                    if($skuV == $value->goods_sku_key_id){
                                                        foreach($tempSkuValueIdArr as $skuValueK => $skuValueV){
                                                            if($skuValueV == $val->goods_sku_value_id){
                                                                $isHaveThisSku = 1;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            if($isHaveThisSku==1){
                                                echo 'selected';
                                            }
                                    ?>><?php echo $val->goods_sku_value?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                                <?php }?>

                                    <tr>
                                        <td>重量（kg）：</td>
                                        <td><input type="text" name="skuname[<?php echo $v->goods_sku_id?>][weight]" value="<?php echo $v->sku_weight;?>" class="normalText" /></td>
                                    </tr>
                        <tr>
                            <td>库存：</td>
                            <td>
                                <input type="text" name="skuname[<?php echo $v->goods_sku_id?>][inventory]" value="<?php echo $v->sku_number;?>" must="ture" class="normalText" />
                            <span class="tips">*</span></td>
                        </tr>
                        <tr>
                            <td>属性缩略图：</td>
                            <td><?php if($v->goods_thumb){?>
                                <img src="<?php echo $v->goods_thumb?>" width="100px">
                                <?php }?><input name="goods_thumb_<?php echo $v->goods_sku_id?>" type="file" value="<?php echo $v->goods_thumb;?>"></td>
                        </tr>
                                    <?php /*?>
                        <tr>
                            <td>商品相册：</td>
                            <td>
                                <a href="<?php echo base_url('sourceaction/goodsPhoto/'.$goodsInfo->goods_id.'/'.$v->goods_sku_id) ?>">添加/更改 属性相册</a>
                            </td>
                        </tr>
                                    <?php */?>
                        <?php }
						?>
                        </table>
                        <a href="javascript:;" onclick="addAttr(this,0,<?php echo !empty($goodsInfo) && !empty($goodsInfo->goodsSku[0])? $goodsInfo->goodsSku[0]->goods_sku_id:0 ?>)" class="topBtn mrgT20">添加一组属性</a></td>
                        
                        <?php
						}else{?>
                         <table class="goodsTable goodsSkuTable">
                                <tr class="goodsSkuTitle">
                                    <td style="font-weight: bold">属性<span class="skuNo">1</span></td>
                                    <td class="deleteNewSku">&nbsp;</td>
                                </tr>
                                <?php
                                foreach($goodsSkuList as $value){
                                    ?>
                                    <tr class="goodsSku">
                                        <td><?php echo $value->sku_key?>：</td>
                                        <td>
                                            <select name="skuname[0][<?php echo $value->goods_sku_key_id?>]" class="normalSelect">
<!--                                                <option value="">请选择</option>-->
                                                <?php foreach($value->value as $val){?>
                                                    <option value="<?php echo $val->goods_sku_value_id?>"><?php echo $val->goods_sku_value?></option>
                                                <?php }?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php }?>
                                <tr>
                                    <td>重量（kg）：</td>
                                    <td><input type="text" name="skuname[0][weight]" value=""  class="normalText" /></td>
                                </tr>
                                <tr>
                                    <td>库存：</td>
                                    <td>
                                        <input type="text" name="skuname[0][inventory]" value="" must="ture"  class="normalText" /><span class="tips">*</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>属性缩略图：</td>
                                    <td><input name="goods_thumb_0" type="file" value=""></td>
                                </tr>
                                </table><a href="javascript:;" onclick="addAttr(this,1,0)" class="topBtn mrgT20">添加一组属性</a>
                        <?php }?>
                    
                </div>


                <div class="tabchild">
                <script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
                <script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
                    <p style="font-weight: bold">商品详细内容：</p>
                    <p>&nbsp;</p>
                    <script id="goods_detail" style="width:700px;" name="goods_detail" type="text/plain"></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('goods_detail');
                        <?php if(!empty($goodsInfo)){?>
                        ue.addListener("ready", function () {
                            // editor准备好之后才可以使用
                            ue.setContent('<?php echo htmlspecialchars_decode($goodsInfo->goods_detail)?>');

                        });
                        <?php }?>
                    </script>
                </div>

                <div class="tabchild">
                    <p style="font-weight: bold">商品专业参数：</p>
                    <p>&nbsp;</p>
                    <!-- 加载编辑器的容器 -->
                    <script id="goods_parm"  style="width:700px;" name="goods_parm" type="text/plain"></script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue1 = UE.getEditor('goods_parm');
                        <?php if(!empty($goodsInfo)){?>
                        ue1.addListener("ready", function () {
                            // editor准备好之后才可以使用
                            ue1.setContent('<?php echo htmlspecialchars_decode($goodsInfo->goods_parm)?>');

                        });
                        <?php }?>
                    </script>
                </div>

                <div class="tabchild">
                    <p style="font-weight: bold">微信商品详细内容：</p>
                    <p>&nbsp;</p>
                    <script id="goods_micro_channel" style="width:700px;" name="goods_micro_channel" type="text/plain"></script>
                    <script type="text/javascript">
                        var ue2 = UE.getEditor('goods_micro_channel');
                        <?php if(!empty($goodsInfo)){?>
                        ue2.addListener("ready", function () {
                            // editor准备好之后才可以使用
                            ue2.setContent('<?php echo htmlspecialchars_decode($goodsInfo->goods_micro_channel)?>');

                        });
                        <?php }?>
                    </script>
                </div>

            </div>
            <input type="submit" value="提交" class="sub" style="margin:20px 0 0 200px;" onclick="return subForm()" />
        </form>
    </div>

<!--<table cellpadding="0" cellspacing="0" id="addAttr">
	<tr>
		<td style="font-weight: bold"  class="addAttr_num">属性</td>
		<td><a href="javascript:;" class="color900" onclick="deleteNewSku(this)">删除</a></td>
	</tr>
    <!--<?php
    foreach($goodsSkuList as $value){
        ?>
        <tr>
            <td><?php echo $value->sku_key?>：</td>
            <td>
                <select name="skuname[0][<?php echo $value->goods_sku_key_id?>]" class="normalSelect">
                   
                    <?php foreach($value->value as $val){?>
                        <option value="<?php echo $val->goods_sku_value_id?>"><?php echo $val->goods_sku_value?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
    <?php }?>
    <tr>
        <td>重量（kg）：</td>
        <td><input type="text" name="skuname[0][weight]" value="" class="normalText" /></td>
    </tr>
    <tr>
        <td>库存：</td>
        <td><input type="text" name="skuname[0][inventory]" value="" class="normalText newkc"/><span class="tips">*</span></td>
    </tr>
    <tr>
        <td>属性缩略图：</td>
        <td><input name="goods_thumb_0" type="file" value="" /></td>
    </tr>
</table>-->
</body>
</html>