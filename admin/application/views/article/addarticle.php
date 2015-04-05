<?php include_once("right_head.php")?>
<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url();?>index.php/articleaction/index" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <form action="<?php echo base_url()?>index.php/articleaction/addArticle/<?php echo empty($articleInfo)?'':$articleInfo->art_id ?>" method="post" enctype="multipart/form-data">
          <input name="act" value="addArticle" type="hidden" class="normalText" />
          <table cellpadding="0" cellspacing="0" class="addTable">
            <tr height="40">
              <td width="80" align="right">标题：</td>
              <td><input id="title" name="title" value="<?php echo empty($articleInfo)?'':$articleInfo->art_title ?>" must="ture" class="normalText"><span class="tips">*</span></td>
            </tr>
            <tr height="160">
              <td align="right" valign="top" style="line-height:40px;">图片：</td>
              <td valign="middle">
                  <?php echo (!empty($articleInfo) && !empty($articleInfo->art_img))?'<img src="'.$articleInfo->art_img.'" width="150px">':'' ?>
                  <input type="file" id="pic" name="art_pic" value="" />
              </td>
            </tr>
            <tr height="40">
              <td align="right">分类：</td>
              <td><select name="class" style="float:left;" class="normalSelect">
                <?php foreach((array)$classList as $v){?>
                <option value="<?php echo $v->cat_id?>" <?php echo empty($articleInfo)?'':(($articleInfo->art_class_id == $v->cat_id)?'selected="selected"':'')?>><?php echo $v->cat_name?></option>
                <?php }?>
            </select></td>
            </tr>

              <tr height="60">
                  <td align="right" valign="top" style="line-height:30px;">介绍：</td>
                  <td height="120"><textarea id="intro" name="art_intro" cols="100" rows="5" class="normalArea" style="width:688px;height:200px;"><?php echo empty($articleInfo)?'':$articleInfo->art_intro ?></textarea></td>
              </tr>
            <tr>
              <td valign="top" align="right">内容：</td>
              <td><div id="myEditor" style="width:700px;margin:5px 0;"></div>
                  <script type="text/javascript">
//                     var editor = new baidu.editor.ui.Editor();
//                     editor.render("myEditor");
                     var ue = UE.getEditor('myEditor');
                     <?php if(!empty($articleInfo)){?>
                     ue.addListener("ready", function () {
                         // editor准备好之后才可以使用
                         ue.setContent('<?php echo htmlspecialchars_decode($articleInfo->art_content)?>');
                     });
                     <?php }?>
                  </script>
              </td>
            </tr>
              <tr height="60">
                  <td align="right">Url：</td>
                  <td><input id="art_url" name="art_url" value="<?php echo empty($articleInfo)?'':$articleInfo->art_url ?>" class="normalText"></td>
              </tr>
              <tr height="60">
                  <td align="right">排序：</td>
                  <td><input id="sort" name="sort" value="<?php echo empty($articleInfo)?'':$articleInfo->sort ?>" class="normalText"><span class="tips">（越大越靠前）</span></td>
              </tr>
              <tr>
                  <td align="right">是否显示：</td>
                  <td>
                      <label class="normalLabel fl"><input type="radio" name="is_show" class="is_show" value="1" <?php if((!empty($articleInfo) && $articleInfo->is_show == 1) or empty($catInfo)){echo 'checked';}?>>是</label>
                      <label class="normalLabel fl"><input type="radio" name="is_show" class="is_show" value="0" <?php if(!empty($articleInfo) && $articleInfo->is_show == 0){echo 'checked';}?>>否</label>
                  </td>
              </tr>
              <tr>
                  <td align="right">是否推荐：</td>
                  <td>
                      <label class="normalLabel fl"><input type="radio" name="is_rmd" class="is_show" value="1" <?php if((!empty($articleInfo) && $articleInfo->is_show == 1)){echo 'checked';}?>>是</label>
                      <label class="normalLabel fl"><input type="radio" name="is_rmd" class="is_show" value="0" <?php if(empty($articleInfo) or $articleInfo->is_show == 0){echo 'checked';}?>>否</label>
                  </td>
              </tr>
            <tr height="60">
            <td></td>
            <td><button class="sub" type="submit" onclick="return subForm()">提交</button></td>
            </tr>
          </table>
      </form>
    </div>

</div>
</body>
</html>