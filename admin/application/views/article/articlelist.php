<?php include_once("right_head.php")?>
<div class="common">
    <span class="fl" style="line-height:30px;">分类搜索：</span><select name="class" style="float:left;margin:0 0 10px 0;" class="normalSelect fl">
		<?php foreach((array)$classList as $v){?>
        <option onclick="window.location='<?php echo base_url('articleaction/index/1/'.$v->cat_id)?>'" value="<?php echo $v->cat_id?>" <?php echo empty($classId)?'':(($classId == $v->cat_id)?'selected="selected"':'')?>><?php echo $v->cat_name?></option>
        <?php }?>
    </select>
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%">日期</td>
            <td style="width: 10%">分类</td>
            <td style="width: 30%">标题</td>
            <td style="width: 10%">排序</td>
            <td style="width: 10%">显示</td>
            <td style="width: 10%">推荐</td>
            <td style="width: 10%">操作</td>
        </tr>
        <?php
        if(!empty($articleList)){
            foreach($articleList as $value){
        ?>
        <tr height="30">
            <td>[<?php echo date('Y-m-d',$value->add_time)?>]</td>
            <td><?php if(!empty($value->classInfo)){echo '[',$value->classInfo,']';}?></td>
            <td><a href="<?php echo base_url()?>index.php/articleaction/detail/<?php echo  $value->art_id?>"><?php echo $value->art_title?></a></td>
            <td><?php echo $value->sort?></td>
            <td><?php echo ($value->is_show)?'显示':'不显示'?></td>
            <td><?php echo ($value->is_rmd)?'推荐':'不推荐'?></td>
            <td><a href="<?php echo base_url('articleaction/addArticle/'.$value->art_id)?>">编辑</a> | <a href="javascript:;" onclick="articleDelete(this,'<?php echo  $value->art_id?>','<?php echo base_url()?>')">删除</a> </td>
        </tr>
        <?php }}?>
        <tr><td>&nbsp;</td></tr>
    </table>
    <div class="page">
        <?php echo $pageHtml; ?>
    </div>
</div>
</body>
</html>