<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
    <div class="container">
        <!--center_left start-->
        <?php include_once('center_nav.php') ?>
        <!--center_left end-->
        <!--center_right start-->
        <div class="centerRight fr" id="centerRight">
            <!--centerRight_top start-->
            <?php include_once('center_top.php') ?>
            <!--centerRight_top end-->

            <!--centerRight_main start-->
            <div class="centerRight_main centerRightBg myOrder" style="padding-top:0;">
                <div class="collection_top">
                    <div class="collection_nav fl">
                        <a href="<?php echo base_url('/useraction/getCollectList')?>" class="cur">收藏的产品</a>
                        <div class="collection_line"></div>
                        <a href="<?php echo base_url('/useraction/getCollectionArticleList')?>">收藏的文章</a>
                    </div>
                    <div class="center_title_r fr">
                        <a href="javascript:;" class="myOrder_all_delete fr" onClick="javascript:if(confirm('确认删除？')){deleteCollect(this,'<?php echo base_url() ?>',1);}">删除</a>
                        <input type="checkbox" name="all" id="action" value="action"
                               onClick="ChkAllClick('chkSon','action')"/>
                        <label for="action" class="label">全选</label>
                    </div>
                </div>
                <div class="collection_main">
                    <?php
                    if (!empty($collectList)) {
                        foreach ($collectList as $key => $value) {
                            ?>
                            <!--collection_list start-->
                            <div class="collection_list">
                                <a target="_blank" href="<?php echo(base_url().'/goodsaction/goodsdetail/'.$value->goods_id)?>" class="collection_con">
                                    <img src="<?php echo $value->goods_thumb?>"/>
                                    <h1><?php echo substr($value->goods_title,0,33)?></h1>
                                </a>
                                <div class="collection_con1">
                                    <input type="checkbox"  name="collection" class="chkSon" id="actlist<?php echo $key+1 ?>" value=" <?php echo $key+1 ?>" onClick="ChkSonClick('chkSon','action')" rel="<?php echo $value->ct_id ?>"/><label class="label" for="actlist<?php echo $key+1 ?>">&nbsp;</label>
                                    <span>￥<?php echo $value->goods_money?></span>
                                </div>
                                <div class="collection_operate">
                                    <a href="javascript:;" onClick="javascript:if(confirm('确认删除？')){deleteCollect(this,'<?php echo base_url() ?>',0);}"  class="collection_operate_det" rel="<?php echo $value->ct_id ?>">删除</a>
                                </div>
                            </div>
                            <!--collection_list end-->
                        <?php }
                    } ?>
                    <div class="clear"></div>
                </div>
                <div class="page mgt40 fr">
                    <?php echo $pageHtml ?>
                </div>
            </div>
            <!--centerRight_main end-->
        </div>
        <!--center_right end-->
        <div class="clear"></div>
        <!--middle_second start-->
        <?php include_once('recommend.php') ?>
        <!--middle_second end-->
    </div>
</div>
</body>
</html>