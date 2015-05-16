<div class="fl uc_menu">
    <div class="menu_head">
        <a class="m_himg" href="##">
            <img src="<?php echo _get_cfg_path('images')?>head.jpg"/>
            <div class="head_bj"></div>
        </a>
        <h3 class="m_name"><a href="/n/member.php">范萌</a></h3>
        <p class="m_prompt">哈尼，喝杯下午茶，精神精神！</p>
    </div>
    <div class="menu_box">
        <ul>
            <li class=""><a href="/n/interactive.php">互动总览<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/info' ) echo ' class="current"';?>><a href="/m/info">个人资料<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/product' ) echo ' class="current"';?>><a href="/m/product">服务价格<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/cert' ) echo ' class="current"';?>><a href="/n/authent.php">我的认证<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/works' ) echo ' class="current"';?>><a href="/m/works">作品管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/order' ) echo ' class="current"';?>><a href="/m/order">交易管理<?php if($this->loginUserNum):?><span class="o_mete"><?php echo $this->loginUserNum['be_ordernum_new'];?></span><?php endif?><i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/account' ) echo ' class="current"';?>><a href="##">资金账户<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/comment' ) echo ' class="current"';?>><a href="/m/comment">评论管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/client' ) echo ' class="current"';?>><a href="/m/client">客户管理<i></i></a></li>
            <li<?php if( strtolower(uri_string())=='m/message' ) echo ' class="current"';?>><a href="/m/message">站内信<i></i></a></li>
        </ul>
    </div>
    <div class="m_level">
        <h3 class="clearfix ml_bti"><font class="fl">账户安全级别：</font><em class="fr">中</em></h3>
        <div class="level"><span class="rating_2"></span></div>
    </div>
</div>