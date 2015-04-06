<?php include_once("right_head.php")?>
    <div class="common">
        <?php if(!empty($channelList)){?>
        <tr>
            <?php foreach((array)$channelList as $value){?>
            <td><?php echo $value->channel_short_name;?></td>
            <td><?php echo $value->channel_name;?></td>
            <td><?php echo $value->channel_intro;?></td>
            <td><?php echo $value->channel_type;?></td>
            <td><?php echo $value->channel_end_order_time;?></td>
            <td><?php echo $value->channel_feedback_time;?></td>
            <td><?php echo $value->channel_allocation_time;?></td>
            <td><?php echo $value->channel_inventory_update_type;?></td>
            <td><?php echo $value->channel_more_intro;?></td>
            <td><?php echo $value->express_id;?></td>
            <?php }?>
        </tr>
        <?php }?>

    </div>
</body>
</html>