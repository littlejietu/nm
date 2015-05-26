<div class="introd_top">
    <div class="intopimg"><img src="<?php echo _get_cfg_path('images')?>int_1.jpg" /></div>
    <div class="intcon">
        <div class="fl col_sub">
            <div class="cs_avatar"><img src="<?php echo _get_cfg_path('images')?>int_2.jpg"/></div>
            <ul class="cs_number clearfix">
                <li><strong><?=empty($oUser['concernnum'])?0:$oUser['concernnum'];?></strong><span>关注</span></li>
                <li><strong><?=empty($oUser['fansnum'])?0:$oUser['fansnum'];?></strong> <span>粉丝</span></li>
                <li><strong><?=empty($oUser['photonum'])?0:$oUser['photonum'];?></strong> <span>拍片次数</span></li>
            </ul>
            <div class="cs_popul"><strong><?=empty($oUser['visitnum'])?0:$oUser['visitnum'];?></strong>人气</div>
        </div>
        <div class="fl info_wrap">
        	<div class="clearfix">
                <div class="namebox fl"><span><?=$oUser['company']?></span></div>
                <div class="contact fl"><a href="##"><i class="qq"></i>联系我</a></div>
                <div class="tips piccon fl"><a href="##" rel="牛模网签约经纪公司" class="preview"></a></div>
            </div>
            <div class="namebox"><p><?=$oUser['sex']==1?'男':'女'?> &nbsp;&nbsp; <?=$oUser['city']?> &nbsp;&nbsp;</div>
        </div>
    </div>
</div>

<div class="introd_title" id="introd_title">
    <ul class="clearfix">
        <li<?php if( strpos(strtolower(uri_string()),'i/index')>-1 ) echo ' class="iton"';?>><a href="/i/index/<?=$oUser['id']?>">机构介绍</a></li>
        <li<?php if( strpos(strtolower(uri_string()),'i/works')>-1 ) echo ' class="iton"';?>><a href="/i/works/<?=$oUser['id']?>">作品展示（<?=empty($oUser['photonum'])?0:$oUser['photonum'];?>）</a></li>
        <li<?php if( strpos(strtolower(uri_string()),'i/model')>-1 ) echo ' class="iton"';?>><a href="/i/model/<?=$oUser['id']?>">旗下艺人</a></li>
        <li<?php if( strpos(strtolower(uri_string()),'i/comment')>-1 ) echo ' class="iton"';?>><a href="/i/comment/<?=$oUser['id']?>">拍摄评价（<?=empty($oUser['be_commentnum'])?0:$oUser['be_commentnum'];?>） </a></li>
    </ul>
</div> 
<input type="hidden" name="mid" id="mid" value="<?=_get_key_val( $oUser['id'] )?>">