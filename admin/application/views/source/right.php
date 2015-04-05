<?php include_once("right_head.php")?>
<div class="common">
    <?php
    if(!empty($error)){
        echo $error;
    }elseif(!empty($excel)){
        print_r($excel);
    }else{
        echo form_open_multipart('sourceaction/excelIn');
    ?>

    <input type="file" name="userfile" size="20" />

    <br /><br />

    <input type="submit" value="upload" />

    </form>
    <?php }?>
</div>
</div>
</body>
</html>