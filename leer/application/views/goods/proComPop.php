<?php $srtarrayid=''; ?>
<!--产品对比-->
<div id="proComPop">
  <div class="proComPop_nav">
    <a href="javascript:;" class="cur">对比栏</a>
    <a href="javascript:;">最近浏览</a>
  </div>
  <a href="javascript:;" class="proComPopClose" onclick="proComClose('<?php echo base_url()?>','del')">隐藏</a>
  <div class="proComPop_main">
    <div class="proComPop_path1">
        <?php
        $num = 0;
        if(!empty($GoodsProComArray)){
            foreach($GoodsProComArray as $kcom => $vcom)
            {
                $GoodsProComArrayal = explode(',',$vcom);
                $srtarrayid[$kcom] = $GoodsProComArrayal[0];
        ?>
     <div class="proComPop_pro" rel="<?php echo $GoodsProComArrayal[1]?>" id="proComOk<?php echo $GoodsProComArrayal[0] ?>" rev="<?php echo $GoodsProComArrayal[0] ?>">
        <a href="<?php echo base_url().'/goodsaction/goodsDetail/'.$GoodsProComArrayal[0] ?>" class="proComPop_img fl"><img src="<?php echo $GoodsProComArrayal[4]?>" /></a>
        <div class="proComPop_con fl">
          <a href="<?php echo base_url().'/goodsaction/goodsDetail/'.$GoodsProComArrayal[0] ?>"><?php echo $GoodsProComArrayal[2]?></a>
          <div class="clearfix">
            <div class="proComPop_price fl">￥<?php echo $GoodsProComArrayal[3]?></div>
            <a href="javascript:;" class="proComPop_det fr" onclick="proComDet('<?php echo base_url()?>','<?php echo $GoodsProComArrayal[0] ?>')"></a>
          </div>
        </div>
      </div>
        <?php
                $num = $kcom+1;
                    }
                $srtarrayid = implode(',',$srtarrayid);
                }
        switch ($num) {case 4: $num = 0;break;case 3:$num = 1;break;case 2:$num = 2;break;case 1:$num = 3;break;case 0:$num = 4;break;}
        for ($i = 0; $i < $num; $i++) {
            ?>
            <div class="proComPop_pro proComPop_empty">
                <a href="#" class="proComPop_img fl"><img src="http://leer.oss-cn-hangzhou.aliyuncs.com/resources/images/proCom-empty.jpg" /></a>
                <div class="proComPop_con fl">
                    <a href="#">您还可继续以添加</a>
                </div>
            </div>
        <?php
        }
        ?>
      <div class="proComPop_right fr">
        <form action="<?php echo base_url()?>/goodsaction/proComIndex" method="post">
        <input type="hidden" name="hidid" value=""/>
        <input type="submit" class="proComPop_db" value="对比" onclick="return proComForm()"/>
        </form>
        
        <a href="javascript:;" class="proComPop_detAll" onclick="proComDet('<?php echo base_url()?>','del')">清空对比栏</a>
      </div>

    </div>
    <div class="proComPop_path2">
      <div class="proComPop_scroll">
        <div class="hd">
            <a class="next"></a>
            <ul></ul>
            <a class="prev"></a>
            <span class="pageState"></span>
        </div>
        <div class="bd">
            <ul class="picList">
            <?php if(!empty($ProComArray)){
              foreach($ProComArray as $k =>$v){
               $ProComArrayVal = explode(',',$v);
                ?>
                <li rel="<?php echo $ProComArrayVal[1] ?>">
                    <div class="proComPop_pro" id="proCom<?php echo $ProComArrayVal[0] ?>" rel="<?php echo $ProComArrayVal[0] ?>">
                      <a href="<?php echo base_url().'/goodsaction/goodsDetail/'.$ProComArrayVal[0] ?>" class="proComPop_img fl"><img src="<?php echo $ProComArrayVal[4] ?>" /></a>
                      <div class="proComPop_con fl">
                        <a href="<?php echo base_url().'/goodsaction/goodsDetail/'.$ProComArrayVal[0] ?>"><?php echo $ProComArrayVal[2] ?></a>
                        <div class="clearfix">
                          <div class="proComPop_price fl">￥<?php echo $ProComArrayVal[3] ?></div>
                          <input type="checkbox"  <?php if(!empty($srtarrayid) && strstr(','.$srtarrayid.',',','.$ProComArrayVal[0].',')){echo 'checked';} ?> name="test"  id="action<?php echo $ProComArrayVal[0] ?>" value="action" rel="$ProComArrayVal[1]" rev="$ProComArrayVal[0]" onClick="proCom('<?php echo base_url()?>','<?php echo $ProComArrayVal[0] ?>','<?php echo $ProComArrayVal[1] ?>',this)"/>
                            <label for="action<?php echo $ProComArrayVal[0] ?>" class="label  <?php if(!empty($srtarrayid) && strstr($srtarrayid,$ProComArrayVal[0])){echo 'checked';} ?>">对比</label>
                        </div>
                      </div>
                    </div>
                </li>
                <?php }
            }?>
            </ul>
        </div>
      </div>
    <script type="text/javascript">
    jQuery(".proComPop_scroll").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:false,vis:4,scroll:1,trigger:"click"});
    </script>
    </div>
  </div>
</div>