
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>


<body class="resize">
<!--header-->
<div class="header">
    <div class="container clearfix">
       <div class="fl logo"><a href="/admin" title="返回首页"><img alt="牛模网logo" src="<?php echo _get_cfg_path('images')?>logo.png" height="30"/></a></div>
       <div class="fr nav">
          <ul class="clearfix">
             <li>
                <a class="" href="models.php">
                    <p>
                        <span class="navimg"><img alt="模特" src="<?php echo _get_cfg_path('images')?>nav_1.jpg" height="16"/></span>
                        <span class="navzi">模特</span>
                    </p>
                </a>
             </li>
             <li>
                 <a class="" href="institutions.php">
                    <p>
                         <span class="navimg"><img alt="机构" src="<?php echo _get_cfg_path('images')?>nav_2.jpg" height="16"/></span>
                         <span class="navzi">机构</span>
                     </p>
                 </a>
             </li>
             <li>
                 <a class="" href="notlce.php">
                    <p>
                        <span class="navimg"><img alt="通告" src="<?php echo _get_cfg_path('images')?>nav_3.jpg" height="16"/></span>
                        <span class="navzi">通告</span>
                    </p>
                 </a>
             </li>
             <li>
                <a class="" href="news.php">
                    <p>
                        <span class="navimg"><img alt="新闻" src="<?php echo _get_cfg_path('images')?>nav_4.jpg" height="16"/></span>
                        <span class="navzi">新闻</span>
                    </p>
                </a>
             </li>
             <li class="nav_search">
                <a href="##" title="搜索"><img alt="搜索" src="<?php echo _get_cfg_path('images')?>nsos.jpg" height="20"/></a>
             </li>
          </ul>
       </div>
    </div>
    <div class="header_bg"></div>
</div>
<div id="slideBox" class="ibanner">
    <div class="iban">
        <h3>登录账号</h3>
        <div class="fl iban_form">
            <form>
                <ul>
                    <li>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formimg1.jpg" />
                        <input id="name" name="name" type="text" placeholder="用户名"/>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formtt.jpg" />
                    </li>
                    <li>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formimg2.jpg" />
                        <input id="password" name="password" type="password" placeholder="密码"/>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formtt.jpg" /></li>
                    <li>
                        <img src="<?php echo _get_cfg_path('images')?>iban_formimg3.jpg" />
                        <input class="iban_foin" name="code" id="code" type="text" placeholder="验证码"/>
                        <img class="mrgR10" src="<?php echo _get_cfg_path('images')?>iban_formtt.jpg" />
                        <img class="xtml-15" id="yzimg" src="/util/captcha?<?php echo rand(10000,9999);?>" onclick="this.src='/util/captcha?'+Math.random()" alt="验证码" >
                    </li>
                    <li>
                        <input checked="checked" type="checkbox"  name="rem" id="rem" value="rem" />
                        <label for="rem">记住帐号</label>
                        <p class="fr f_prompt" id="prompt">请输入正确的密码</p>
                    </li>
                    <li class="iban_forin">
                        <input class="but" name="submit" value="登   录" type="submit" onclick="return formC();"/>
                    </li>
                    <li>
                        <p class="logmm fl">忘记密码？<a href="##">点击这里</a></p>
                        <a class="iban_forma fr" href="/reg" title="免费注册">免费注册</a>
                    </li>
                </ul>
            </form>
        </div>
        <div class="iban_bot"><span>社交账号直接登录</span>
            <a class="iban_bota" href="#">微博</a><a class="iban_qq" href="#">QQ</a>
        </div>
    </div>
    <div class="hd">
        <ul></ul>
        <a class="prev" title="上一页">上一页</a>
        <a class="next" title="下一页">下一页</a>
    </div>
    <div class="bd">
        <ul>
            <li _src="url(/upload/banner/banner2.jpg)"><a href="##"></a></li>
            <li _src="url(/upload/banner/banner3.jpg)"><a href="##"></a></li>
        </ul>
    </div>
</div>
<div class="ifooter">
    <div class="container clearfix">
        <a class="fl" href="index.php"><img src="<?php echo _get_cfg_path('images')?>logo.png" alt="logo"/></a>
        <p class="fr">
            <a href="#" title="服务条款">服务条款</a>牛模网版权所有&copy;2004-2015
        </p>
    </div>
</div>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>

<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/user/login.js"></script>

</body>
</html>
