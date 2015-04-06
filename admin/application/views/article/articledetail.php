<?php include_once("right_head.php")?>
<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/backstage/ueditor1_4_3/ueditor.all.js"></script>
<div class="common">
    <div class="goodsTitle">
        <a href="<?php echo base_url();?>index.php/articleaction/index" class="topBtn">返回列表</a>
    </div>
    <div class="adduser">
        <?php if($detail){?>
           <div class="article_title"><?php echo $detail->art_title?></div>
           <div class="article_main"><?php echo $detail->art_content?></div>
        <?php }?>
    </div>

</div>
</body>
</html>