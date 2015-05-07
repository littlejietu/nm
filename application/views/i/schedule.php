
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人主页-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('lib')?>uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>

<div class="mainbody" id="mainbody">
	<div class="introd container">
        <div class="introd_top">
    <div class="intopimg"><img src="images/ma_1.jpg" /></div>
    <div class="intcon">
        <div class="fl col_sub">
            <div class="cs_avatar"><img src="images/ma_2.jpg"/></div>
            <ul class="cs_number clearfix">
                <li><strong>272</strong><span>关注</span></li>
                <li><strong>21502</strong> <span>粉丝</span></li>
                <li><strong>15021</strong> <span>拍片次数</span></li>
            </ul>
            <div class="cs_popul"><strong>502137</strong>人气</div>
        </div>
        <div class="fl info_wrap">
        	<div class="clearfix">
            	<div class="namebox fl"><span>杭州乐玛摄影</span></div>
                <div class="contact attention fl"><a href="##" class="atte_cur"><i class="qq atte"></i>未关注</a></div>
            	<div class="contact fl"><a href="##"><i class="qq"></i>联系我</a></div>
            	<div class="tips piccon fl"><a href="##" rel="牛模网签约经纪公司" class="preview"></a></div>
            </div>
            <div class="namebox"><p>女 &nbsp;&nbsp; 浙江，杭州西湖区 &nbsp;&nbsp; 平面模特</p></div>
        </div>
    </div>
</div>
<div class="introd_title" id="introd_title">
    <ul class="clearfix">
        <li class="iton"><a href="malbums.php">TA的作品（45）</a></li>
        <li><a href="personal.php">个人信息</a></li>
        <li><a href="appraisal.php">拍摄评价（423） </a></li>
        <li><a href="schedule.php">档期选择</a></li>
    </ul>
</div>  

<div class="schedule clearfix">
            <div class="clearfix">
                <div class="time_top">
                    <form action="" method="post">
                        <input type="hidden" name="y" id="y" value="2015">
                        <input type="hidden" name="m" id="m" value="03">
                        <div class="time">
                            <span id="total_nian">2015.</span><span id="total_yue">03</span>
                        </div>
                        <div class="nianyue fr">
                            <div class="time_select" id="nian">2015年</div>
                            <div class="time_select_click"><i></i></div>
                            <div class="select" id="nianfen" style="display: none;">
                                <ul>
                                  <li>2015年</li>
                                  <li>2014年</li>
                                  <li>2013年</li>
                                  <li>2012年</li>
                                  <li>2011年</li>
                                  <li>2010年</li>
                                </ul>
                            </div>
                            <div class="time_select" id="yue">03月</div>
                            <div class="time_select_click"><i></i></div>
                            <div class="select" id="yuefen">
                                <ul>
                                  <li>01月</li>
                                  <li>02月</li>
                                  <li>03月</li>
                                  <li>04月</li>
                                  <li>05月</li>
                                  <li>06月</li>
                                  <li>07月</li>
                                  <li>08月</li>
                                  <li>09月</li>
                                  <li>10月</li>
                                  <li>11月</li>
                                  <li>12月</li>
                                </ul>
                            </div>
                        </div>
                        <!--nianyue-->
                        <button type="submit" class="time_select_button" style="display:none;"></button>
                    </form>
                </div>
            </div>
            <div class="piao_list">
                <div class="piao_con_tit">
                    <ul>
                        <li>星期日</li>
                        <li>星期一</li>
                        <li>星期二</li>
                        <li>星期三</li>
                        <li>星期四</li>
                        <li>星期五</li>
                        <li>星期六</li>
                    </ul>
                </div>
                <div class="piao_con">
                    <div style="float:left;width:740px; background:url(images/yanchu_list_bg.gif) left top repeat-y; margin-top:1px;display:none"></div>
                    <div class="con_day">
                        <div class="day"></div>
                        <div class="day bg_day"></div>
                        <div class="day"></div>
                        <div class="day bg_day"></div>
                        <div class="day"></div>
                        <div class="day bg_day"></div>
                        <div class="day teba_kan">
                           <p class="d_number">1</p>
                           <div class="arrang">
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                           </div>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day d_reser bg_day" onclick="alertWin(this)">
                          <p class="d_number">2</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">3</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day teba_kan bg_day">
                          <p class="d_number">4</p>
                          <div class="arrang">
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                          </div>
                        </div>
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">5</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day d_reser bg_day" onclick="alertWin(this)">
                          <p class="d_number">6</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">7</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day teba_kan bg_day">
                           <p class="d_number">8</p>
                           <div class="arrang">
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                           </div>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day">
                          <p class="d_number">9</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">10</p>
                        </div>
                        <div class="day">
                          <p class="d_number">11</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">12</p>
                        </div>
                        <div class="day">
                          <p class="d_number">13</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">14</p>
                        </div>
                        <div class="day">
                          <p class="d_number">15</p>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day bg_day">
                          <p class="d_number">16</p>
                        </div>
                        <div class="day">
                          <p class="d_number">17</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">18</p>
                        </div>
                        <div class="day">
                          <p class="d_number">19</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">20</p>
                        </div>
                        <div class="day">
                          <p class="d_number">21</p>
                        </div>
                        <div class="day bg_day">
                           <p class="d_number">22</p>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day">
                          <p class="d_number">23</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">24</p>
                        </div>
                        <div class="day">
                          <p class="d_number">25</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">26</p>
                        </div>
                        <div class="day">
                          <p class="d_number">27</p>
                        </div>
                        <div class="day bg_day">
                          <p class="d_number">28</p>
                        </div>
                        <div class="day">
                          <p class="d_number">29</p>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day bg_day">
                           <p class="d_number">30</p>
                        </div>
                        <div class="day">
                           <p class="d_number">31</p>
                        </div>
                        <div class="day bg_day"></div>
                        <div class="day"></div>
                        <div class="day bg_day"></div>
                        <div class="day"></div>
                        <div class="day bg_day"></div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
</div>
<!--mainbody-->
<div class="footer">
    <div class="fortop">
    	<div class="clearfix container">
        	<div class="fat_link fl clearfix">
                <ul style="width:300px;">
                	<li class="bt_tes"><a href="##"><i></i>我们的服务</a></li>
                    <li><a href="##"><i></i>优质服务是我们的使命</a></li>
                    <li><a href="##"><i></i>高品质是我们的义务</a></li>
                    <li><a href="##"><i></i>我们承诺24小时内出货</a></li>
                    <li><a href="##"><i></i>我们可以在24小时内回复您的邮件</a></li>
                    <li><a href="##"><i></i>我们是一家工厂竞争力的价格和供应</a></li>
                    <li><a href="##"><i></i>顾客至上</a></li>
                </ul>
                <ul class="flik">
                	<li class="bt_tes"><a href="##"><i></i>经纪合作</a></li>
                    <li><a href="##"><img src="images/flik_1.jpg"/></a></li>
                    <li><a href="##"><img src="images/flik_2.jpg"/></a></li>
                    <li><a href="##"><img src="images/flik_3.jpg"/></a></li>
                    <li><a href="##"><img src="images/flik_4.jpg"/></a></li>
                </ul>
                <ul>
                	<li class="bt_tes"><a href="##"><i></i>关于我们</a></li>
                    <li><a href="#"><i></i>什么是牛模网?</a></li>
                    <li><a href="#"><i></i>公司简介</a></li>
                    <li><a href="#"><i></i>加入我们</a></li>
                    <li><a href="#"><i></i>联系我们</a></li>
                </ul>
                <ul>
                	<li class="bt_tes"><a href="##"><i></i>帮助中心</a></li>
                    <li><a href="##"><i></i>防骗说明</a></li>
                    <li><a href="##"><i></i>官方互动</a></li>
                    <li><a href="##"><i></i>合作链接</a></li>
                </ul>
            </div>
            <div class="fr">
               <div class="fot_img"><img src="images/f_tel.jpg" width="188" height="46" /></div>
               <div class="fot_login">
                   <a title="注册" class="f_reg" href="##"></a>
                   <a title="登陆" class="f_land" href="##"></a>
               </div>
            </div>
        </div>
    </div>
    <div class="foobot">
    	<div class="container">
        	<p class="fl fb_wibo">
            	<a class="f_wb" href="http://weibo.com/guoxingwang0713" target="_blank" title="新浪微博"></a>
                <a class="f_qq" href="##" title="腾讯空间"></a>
            </p>
            <p class="fr">版权所有 &copy; 2015NEWMODELS   浙ICP备10021016号  DESIGNED BY :<a href="http://www.lebang.com/" target="_blank"> LEBANG.COM</a></p>
        </div>
    </div>
</div><!--footer-->

<div id="share">
	<a id="totop" title="" href="javascript:void(0);">返回顶部</a>
</div></body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</html>