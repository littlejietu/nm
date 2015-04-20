<?php
function current_url(){//获取当前URL
	$url = $_SERVER['PHP_SELF']; 
	$filename= substr( $url , strrpos($url , '/')+1 );
	return $filename;
}
?>
<?php
    $url = current_url();
?>
<div class="head_top">
	<div class="container">
    	<p class="fl htop_fl">Hi,~<a href="login.php">[<i>请登录</i>]</a> <a href="register.php">[<i>免费注册</i>]</a></p>   
        <div class="fr htop_fr">
            <a class="h_sche" href="schedule.php"><i></i>档期管理</a>
            <a class="h_orde" href="order.php">我的订单(<i>5</i>)</a>
            <a class="h_drop" href="##">下拉</a>
        </div>
    </div>
</div>
<div class="header">
    <div class="container clearfix">
       <div class="fl logo"><a href="index.php" title="返回首页"><img alt="牛模网logo" src="images/logo.png" height="30"/></a></div>
       <div class="fr nav">
          <ul class="clearfix">
             <li>
                <a class="<?php if($url == "models.php") echo "nav_on"?>" href="models.php">
                    <p>
                        <span class="navimg"><img alt="模特" src="images/nav_1.jpg" height="16"/></span>
                        <span class="navzi">模特</span>
                    </p>
                </a>
             </li>
             <li>
                 <a class="<?php if($url == "institutions.php") echo "nav_on"?>" href="institutions.php">
                    <p>
                         <span class="navimg"><img alt="机构" src="images/nav_2.jpg" height="16"/></span>
                         <span class="navzi">机构</span>
                     </p>
                 </a>
             </li>
             <li>
                 <a class="<?php if($url == "notlce.php") echo "nav_on"?>" href="notlce.php">
                    <p>
                        <span class="navimg"><img alt="通告" src="images/nav_3.jpg" height="16"/></span>
                        <span class="navzi">通告</span>
                    </p>
                 </a>
             </li>
             <li>
                <a class="<?php if($url == "news.php") echo "nav_on"?>" href="news.php">
                    <p>
                        <span class="navimg"><img alt="新闻" src="images/nav_4.jpg" height="16"/></span>
                        <span class="navzi">新闻</span>
                    </p>
                </a>
             </li>
             <li class="nav_search">
                <a href="##" title="搜索"><img alt="搜索" src="images/nsos.jpg" height="20"/></a>
             </li>
          </ul>
       </div>
    </div>
    <div class="header_bg"></div>
</div><!--header-->