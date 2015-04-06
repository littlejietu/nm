<?php include_once("right_head.php")?>
    <div class="common">
        <?php if(!empty($supplierList)){?>
        <ul>
            <?php foreach((array)$supplierList as $value){?>
            <li><?php echo $value->supplier_name;?></li>
            <?php }?>
        </ul>
        <?php }?>

    </div>
</body>
</html>