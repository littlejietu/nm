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
        <div class="appraisal mrgB30">
            <ul>
            	<?php for($i=0;$i<4;$i++){?>
                <li class="clearfix estim">
                   <div class="fl em_lef"><h3>5</h3><h4>顾丽姬</h4><span>2013.06.25  15:13:58</span></div>
                   <div class="fr em_rit">
                   	   <div class="apprtop">
                       	   <div class="fl a_rev"><span>身材样貌：</span><p class="star_on"><i class="star_5">5</i></p></div>
                           <div class="fl a_rev"><span>专业技能：</span><p class="star_on"><i class="star_4">5</i></p></div>
                           <div class="fl a_rev"><span>工作效率：</span><p class="star_on"><i class="star_3">5</i></p></div>
                           <div class="fl a_rev"><span>服务态度：</span><p class="star_on"><i class="star_2">5</i></p></div>
                       </div>
                   	   <div class="apprcon">之前去过那边看赖声川的话剧---《十三角关系》，剧院风格很大方，而且内部也不错。不过就是之前买票买了中档的，并不觉和最低价的那一档有什么太大区别。但是附近，交通并不是很便利，出租车什么都较少。学生党晚上去那边的话，花费会较大些~下面的人均，我就把话剧的费用写上去了。但是附近，交通并不是很便利，出租车什么都较少~~</div>
                   </div>
                </li>
                <?php }?>
            </ul>
            <br />
            <div class="fabiao" style="display:none">
                <input type="hidden" name="act" value="online"/>
                <div class="xzw_starSys clearfix">
                    <h3 class="fl" style="width:80px">发表评论</h3>
                    <div id="xzw_starBox">
                      <ul class="star" id="star">
                          <li><a href="javascript:void(0)" title="1" class="one-star">1</a></li>
                          <li><a href="javascript:void(0)" title="2" class="two-stars">2</a></li>
                          <li><a href="javascript:void(0)" title="3" class="three-stars">3</a></li>
                          <li><a href="javascript:void(0)" title="4" class="four-stars">4</a></li>
                          <li><a href="javascript:void(0)" title="5" class="five-stars">5</a></li>
                      </ul>
                      <div class="current-rating" id="showb"></div>
                      <input class="szhi" id="szhi" name="title" value="" type="hidden" />
                    </div>
                    <div class="description"></div>
                </div>
                <input type="hidden" name="name" value=""/>
                <textarea id="starcontent" name="content" cols="" rows="" class="texta"></textarea>
                <br /><br />
                <input name="" type="submit" class="but" value="提交评论" />
                <br /><br />
            </div>
        </div>
    </div>
</div>
<!--mainbody-->
<?php include("include/footer.php")?>
</body>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!--<script type="text/javascript" src="js/starBox.js"></script>-->
</html>