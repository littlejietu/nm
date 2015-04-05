<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsList">
        <?php if (!empty($error)) {
            echo $error;
        } elseif (!empty($exXls)) {
            echo '品牌添加成功！';
        } else {
            ?>
            <form
                action="<?php echo base_url(); ?>index.php/sourceaction/<?php echo empty($brandId) ? 'brand/' . $type : 'editBrand/' ?>"
                method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <table style="margin:0;">
                    <tr height="50">
                        <td width="200"><input type="hidden" name="act" value="add" size="20"/>
                            <?php
                            if (!empty($brandId)) {
                                ?>
                                <input type="hidden" name="brand_id" value="<?php echo $brandId ?>">
                                <input type="hidden" name="act" value="editBrand">
                                <input type="hidden" name="type" value="<?php echo $type ?>">
                            <?php } ?>
                            品牌名：<input type="text" name="brand_name"
                                       value="<?php echo empty($brandName) ? '' : $brandName ?>"></td>
                        <td> 图片：<input type="file" name="brand_img" value=""></td>
                        <td>推荐：推荐<input type="radio" name="is_rmd"
                                        value="1" <?php echo !empty($is_rmd) && $is_rmd == 1 ? 'checked' : '' ?> >不推荐<input
                                type="radio" name="is_rmd"
                                value="0" <?php echo empty($is_rmd) || $is_rmd == 0 ? 'checked' : '' ?>  ></td>
                        <td><input type="submit" value="<?php echo empty($brandId) ? '添加' : '修改' ?>" class="sub"/></td>
                    </tr>
                </table>
            </form>
        <?php } ?>
        <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
            <tr height="39" style="font-size:13px;">
                <?php if (!empty($brandList)){ ?>
                <td>编号</td>
                <td>品牌名</td>
                <td>图片</td>
                <td>推荐</td>
                <td>操作</td>
                <?php foreach ((array)$brandList as $key=> $value){ ?>
            <tr height="30">
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value->brand_name; ?></td>
                <td>
                    <?php
                    if (!empty($value->brand_img)) {
                        ?>
                        <img title="点击预览大图" src="<?php echo base_url() ?>resources/backstage/image/pic.gif"
                             class="showPic" rel="<?php echo $value->brand_img; ?>"/>
                        <div style="position: absolute; z-index: 1;"></div>
                    <?php } else { ?>
                        暂无
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?php echo $value->is_rmd == 1 ? '是' : '否' ?>
                </td>
                <td>
                    <a href="<?php echo base_url('index.php/sourceaction/editBrand/' . $value->brand_id . '/' . $value->brand_type) ?>">编辑</a>
                    |
                    <a href="javascript:;"
                       onclick="javascript:if(confirm('确认删除？')){delBrand(this,<?php echo $value->brand_id ?>,'<?php echo base_url() ?>');}">删除</a>
                </td>
            </tr>
            <?php } ?>
            <?php } ?>
        </table>

    </div>
</div>
</body>
</html>