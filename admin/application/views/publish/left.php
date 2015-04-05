<div class="left_nav">
    <?php
        foreach((array)$leftList['stepFirst'] as $k => $v){
            if($v->is_show){
    ?>
        <div class="left_nav2">
            <h1><?php echo $v->sys_name?></h1>
            <ul>
               <?php foreach($leftList['stepSecond'] as $ka => $va){
					if($va->sys_partid == $v->sys_id && $va->is_show){
				?>
                <li>
					<a <?php if(!empty($va->sys_link)){?>onclick="javascript:loadRight('<?php echo base_url()?>index.php/<?php echo $va->sys_link?>');"<?php }?>><?php echo $va->sys_name?></a>
                </li>
                 <?php }}?>
            </ul>
        </div>
    <?php }}?>
</div>
<!--<div class="left">
    <?php foreach((array)$leftList['stepFirst'] as $k => $v){?>
    <p onclick="javascript:showOrHidden(this);"><?php echo $v->sys_name?></p>
    <ul>
        <?php
            foreach($leftList['stepSecond'] as $ka => $va){
                if($va->sys_partid == $v->sys_id){
        ?>
        <li><a <?php if(!empty($va->sys_link)){?>onclick="javascript:loadRight('/index.php/<?php echo $va->sys_link?>');"<?php }?>><?php echo $va->sys_name?></a></li>
        <?php }}?>
    </ul>
    <?php }?>
</div>-->