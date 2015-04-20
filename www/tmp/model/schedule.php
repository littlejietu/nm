<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php")?>
<link href="css/base.css" type="text/css" rel="stylesheet" />
<link href="css/common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include("include/header.php")?>
<div class="mainbody" id="mainbody">
	<div class="introd container">
        <?php include("include/model.php")?>
        <div class="schedule clearfix">
            <div class="clearfix">
                <div class="time_top">
                    <form action="" method="post">
                        <input type="hidden" name="y" id="y" value="2015" />
                        <input type="hidden" name="m" id="m" value="03" />
                        <div class="time">
                            <span id="total_nian">2015.</span><span id="total_yue">03</span>
                        </div>
                        <div class="nianyue fr">
                            <div class="time_select" id="nian">2015年</div>
                            <div class="time_select_click"><i></i></div>
                            <div class="select" id="nianfen">
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
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day teba_kan">
                           <p class="d_number">1</p>
                           <div class="arrang">
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                               <p class="arr_con">周末特色文化广场活动<i>19:30</i></p>
                           </div>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">2</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">3</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day teba_kan">
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
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">6</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day d_reser" onclick="alertWin(this)">
                          <p class="d_number">7</p>
                          <i class="res_b"></i>
                          <p class="res_zi">有空哦，快来预约</p>
                        </div>
                        <div class="day teba_kan">
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
                        <div class="day">
                          <p class="d_number">10</p>
                        </div>
                        <div class="day">
                          <p class="d_number">11</p>
                        </div>
                        <div class="day">
                          <p class="d_number">12</p>
                        </div>
                        <div class="day">
                          <p class="d_number">13</p>
                        </div>
                        <div class="day">
                          <p class="d_number">14</p>
                        </div>
                        <div class="day">
                          <p class="d_number">15</p>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day">
                          <p class="d_number">16</p>
                        </div>
                        <div class="day">
                          <p class="d_number">17</p>
                        </div>
                        <div class="day">
                          <p class="d_number">18</p>
                        </div>
                        <div class="day">
                          <p class="d_number">19</p>
                        </div>
                        <div class="day">
                          <p class="d_number">20</p>
                        </div>
                        <div class="day">
                          <p class="d_number">21</p>
                        </div>
                        <div class="day">
                           <p class="d_number">22</p>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day">
                          <p class="d_number">23</p>
                        </div>
                        <div class="day">
                          <p class="d_number">24</p>
                        </div>
                        <div class="day">
                          <p class="d_number">25</p>
                        </div>
                        <div class="day">
                          <p class="d_number">26</p>
                        </div>
                        <div class="day">
                          <p class="d_number">27</p>
                        </div>
                        <div class="day">
                          <p class="d_number">28</p>
                        </div>
                        <div class="day">
                          <p class="d_number">29</p>
                        </div>
                    </div>
                    <div class="con_day">
                        <div class="day">
                           <p class="d_number">30</p>
                        </div>
                        <div class="day">
                           <p class="d_number">31</p>
                        </div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                        <div class="day"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--mainbody-->
<?php include("include/footer.php")?>

<div class="popover-mask"></div>
<div class="popover">
	<div class="poptit"> <a href="javascript:;" onclick="closeWin(this)" title="关闭" class="close">×</a></div>
	<div class="popbod">
		<div class="fl popimg"><img src="images/mt_12.jpg"/></div>
      <div class="fr poptab">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="80"><font>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 格：</font></td>
                  <td>¥ <em class="money">150.00</em></td>
                </tr>
                <tr>
                  <td><font>工作内容：</font></td>
                  <td>
                  	<select name="" class="txt sele">
                        <option>人物景色</option>
                        <option>景色取点</option>
                        <option>人物广告</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><font>工作场景：</font></td>
                  <td>
                  	 <div class="clearfix scene">
                         <a href="javascript:;" onclick="filt(this)" name="1">室内</a>
                         <a href="javascript:;" onclick="filt(this)" name="2">室外</a>
                         <input name="" id="" value="0" type="hidden"/>
                     </div> 
                  </td>
                </tr>
                <tr>
                  <td><font>计价方式：</font></td>
                  <td>
                      <div class="clearfix scene">
                          <a href="javascript:;" onclick="filt(this)" name="1">时</a>
                          <a href="javascript:;" onclick="filt(this)" name="2">天</a>
                          <a href="javascript:;" onclick="filt(this)" name="3">件</a>
                          <a href="javascript:;" onclick="filt(this)" name="4">场</a>
                          <input name="" id="" value="0" type="hidden"/>
                      </div> 
                  </td>
                </tr>
                <tr>
                  <td><font>数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 量：</font></td>
                  <td>
                  	<div class="i_tips" style="display:none"></div>
					<div class="i_box">
                        <a href="javascript:;" class="J_minus">-</a>
                        <input type="text" value="0" class="J_input" />
                        <a href="javascript:;" class="J_add">+</a>
                    </div>
                  </td>
                </tr>
                <tr>
                   <td valign="top"><font>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 注：</font></td>
                   <td><textarea class="txt text" name="" cols="" rows=""></textarea></td>
                </tr>
                <tr>
                  <td><font>拍片日期：</font></td>
                  <td>2015.2.07</td>
                </tr>
              	<tr><td colspan="2"><p class="line"></p></td></tr>
              	<tr>
                  <td><font>联&nbsp;系&nbsp;&nbsp;人：</font></td>
                  <td><input class="txt" name="" type="text"/></td>
                </tr>
                <tr>
                  <td><font>联系方式：</font></td>
                  <td><input class="txt" name="" type="text"/></td>
                </tr>
                <tr><td height="25"></td></tr>
                <tr>
                   <td colspan="2"><input class="but" name="" type="button" value="立即下单"/></td>
                </tr>
            </table>
        </div>
  </div>
</div>

</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/Quantity.js"></script>
</html>