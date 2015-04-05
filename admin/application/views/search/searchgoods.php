<?php include_once("right_head.php")?>
    <div class="common">
        <form action="<?php echo base_url('index.php/sourceaction/index/goods')?>">
            <span>请输入货号：</span>
            <input name="search" must="ture"><span class="tips"></span>
            <button type="submit" onclick="return subForm()">查询</button>
        </form>
    </div>

</body>
</html>