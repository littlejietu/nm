
<form method="post" action="<?php echo base_url('/goodsaction/index')?>/">
<div class="centerRight_top">
        <div class="centerSearch fl">
            <input name="search" type="text" value="<?php echo empty($search)?'你要买什么？':$search?>" onblur="blurText(this,'你要买什么？')" onfocus="focusText(this,'你要买什么？')" class="centerSearch_text"/><input type="submit" value=""  class="centerSearch_btn"/>
        </div>
        <a href="<?php echo base_url('/isbuildingaction/index')?>" class="centerRight_top_r fr"><div class="centerRight_top_r_tip">通 知</div></a>
        <a href="<?php echo base_url('/indexaction/index')?>" class="centerRight_top_r centerRight_top_r1 fr" id="backHome"><div class="centerRight_top_r_tip">返回首页</div></a>
</div>
</form>