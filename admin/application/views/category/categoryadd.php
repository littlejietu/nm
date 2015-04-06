<?php include_once("right_head.php")?>
<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url();?>index.php/categoryaction/index/<?php echo $type ?>" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url();?>index.php/categoryaction/<?php if($act == 'edit'){echo 'editCat';}else{echo 'addCat';}?>" method="post">
            <input name="act" value="<?php if($act == 'edit'){echo 'editCat';}else{echo 'addCat';}?>" type="hidden">
            <input name="type" type="hidden" value="<?php echo $type?>">
            <?php if($act == 'edit'){?>
            <input name="cat_id" type="hidden" value="<?php echo $catId?>">
            <?php }?>
            <table class="addTable">
                <tr>
                    <td align="right">分类名：</td>
                    <td><input id="cat_name" name="cat_name" value="<?php echo empty($catInfo)?'':$catInfo->cat_name?>" must="ture"  class="normalText"/><span class="tips">*</span></td>
                </tr>
                <tr>
                    <td align="right">英文名：</td>
                    <td><input id="cat_name" name="cat_name_en" value="<?php echo empty($catInfo)?'':$catInfo->cat_name_en?>"  class="normalText"/></td>
                </tr>
                <tr>
                    <td align="right">上级分类：</td>
                    <td><select name="part_id" class="fl normalSelect">

                            <?php foreach($categoryList as $v){?>
                                <option
                                    <?php
                                        if($partId == $v->cat_real_id){echo 'selected="selected"';}
                                        if(isset($catId) && $catId == $v->cat_id){echo ' disabled';}
                                    ?> value="<?php echo $v->cat_real_id?>"><?php echo $v->cat_name?></option>
                            <?php }?>
                        </select></td>
                </tr>
                <tr>
                    <td align="right">是否显示：</td>
                    <td>
                        <label class="normalLabel fl"><input type="radio" name="is_show" class="is_show" value="1" <?php if((!empty($catInfo) && $catInfo->is_show == 1) or empty($catInfo)){echo 'checked';}?>>是</label>
                        <label class="normalLabel fl"><input type="radio" name="is_show" class="is_show" value="0" <?php if(!empty($catInfo) && $catInfo->is_show == 0){echo 'checked';}?>>否</label>
                    </td>
                </tr>
                <tr>
                    <td align="right">热门分类：</td>
                    <td>
                        <label class="normalLabel fl"><input type="radio" name="rmd" class="is_show" value="1" <?php if(!empty($catInfo) && $catInfo->is_rmd == 1){echo 'checked';}?>>是</label>
                        <label class="normalLabel fl"><input type="radio" name="rmd" class="is_show" value="0" <?php if(empty($catInfo) or $catInfo->is_rmd == 0){echo 'checked';}?>>否</label>
                    </td>
                </tr>
                <tr>
                    <td align="right">排序：</td>
                    <td><input id="sort" name="sort" value="<?php echo empty($catInfo)?'':$catInfo->sort?>" class="normalText" /></td>
                </tr>
                <tr height="60"><td></td><td><button class="sub" type="submit" onclick="return subForm()">提交</button></td></tr>
            </table>
    
    </form>
    </div>

</div>
</body>
</html>