<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
  <div class="container">
    <!--center_left start-->
    <?php include_once('center_nav.php')?>
    <!--center_left end-->
    
    <!--center_right start-->
    <div class="centerRight fr" id="centerRight">
      <!--centerRight_top start-->
      <?php include_once('center_top.php')?>
      <!--centerRight_top end-->
      
      <!--centerRight_main start-->
      <div class="centerRight_main centerRightBg myOrder" >
      <form>
        <div class="center_title">
          <div class="fl">我的积分</div>
          <div class="center_title_r fr">
            <a href="javascript:;" class="myOrder_all_delete fr"  onClick="IntegralDelete(this,'<?php echo base_url() ?>',1)">删除</a>
            <input type="checkbox" name="test"  id="action" value="action" onClick="ChkAllClick('chkSon','action')" />
			<label for="action" class="label">全选</label>
            <p class="font12 fr">可用积分：<strong class="purple">800</strong>点</p>
          </div>
        </div>
        <!--center_main start-->
        <div class="center_main">
          <ul class="myOrder_title">
            <li style="width:277px;padding:0 0 0 62px;text-align:left;">产品信息</li>
            <li style="width:212px;">收入</li>
            <li style="width:213px;">支出</li>
            <li style="width:80px;">操作</li>
          </ul>
         
          <div class="myOrder_main">
              <ul class="myOrder_list clearfix">
                <li style="width:42px;" class="myIntegralCheck"><input type="checkbox"  name="integralId" class="chkSon" id="actlist" value="actlist" onclick="ChkSonClick('chkSon','action')"/><label class="label1" for="actlist">&nbsp;</label></li>
                <li style="width:297px;" class="myOrder_info">
                 <a href="#"> <img src="<?php echo base_url()?>resources/img/detail.jpg" width="100" height="77"/>
                   <h1>秋冬装加绒加厚T恤男长袖头衫纯色打底衫外套</h1>
                   <p style="padding:5px 0 0 0;">165/84A</p>
                 </a>
                </li>
                <li style="width:212px;" class="alignC"><p class="Arial19">/</p></li>
                <li style="width:213px;" class="alignC"><p class="ArialBold15 purple">80</p></li>
                <li style="width:80px;" class="pdT28"><a href="#" class="cartDelete"></a></li>
              </ul>
          </div>
          <div class="myOrder_main">
              <ul class="myOrder_list clearfix">
                <li style="width:42px;" class="myIntegralCheck"><input type="checkbox"  name="integralId" class="chkSon" id="actlist1" value="actlist" onclick="ChkSonClick('chkSon','action')"/><label class="label1" for="actlist1">&nbsp;</label></li>
                <li style="width:297px;" class="myOrder_info">
                 <a href="#"> <img src="<?php echo base_url()?>resources/img/detail.jpg" width="100" height="77"/>
                   <h1>秋冬装加绒加厚T恤男长袖头衫纯色打底衫外套</h1>
                   <p style="padding:5px 0 0 0;">165/84A</p>
                 </a>
                </li>
                <li style="width:212px;" class="alignC"><p class=" ArialBold15 purple">80</p></li>
                <li style="width:213px;" class="alignC "><p class="Arial19">/</p></li>
                <li style="width:80px;" class="pdT28"><a href="#" class="cartDelete" onClick="IntegralDelete(this,'<?php echo base_url() ?>',1)"></a></li>
              </ul>
          </div>
         <div class="borderB"></div>
          
          <div class="page pdTB34 clearfix pageCenter">
            <a href="#" class="page_btn fr">&gt;</a>
     
            <a href="#" class="fr">5</a>
            <a href="#" class="fr">4</a>
            <a href="#" class="fr">3</a>
            <a href="#" class="fr">2</a>
            <a href="#" class="cur fr">1</a>
            <a href="#" class="page_btn fr">&lt;</a>
          </div> 
          
          <div class="integralCriteria">
            <div class="integralCriteria_title">积分准则：</div>
            <p class="pdB10">积分=阳光值+爱心值+雨露值+营养值（即该用户的四项属性之和）  随着用户空间积分的增多，用户也将得到相应的空间等级。 </p>
            <p><span class="purple">例如：  </span> 积分810 等级16 对应的等级图标为  下图为等级.等级图标和积分的对应列表  说明：用户在10级以上，每级（n）对应分数的计算公式为：(n-7)2*10  例如16级，所需积分为（16-7）2*10=810分  等级 对应图标 用户积分  0 0  1 5  2 10  3 15  4 20  5 30  6 40  7 50  8 60  9 75  10 90  11 160  12 250  13 360  14 490  15 640  16 810  32 6250  48 16810  积分增长规则？</p>
          </div>
        </div>
        <!--center_main end-->
      </form>
      </div>
      <!--centerRight_main end-->
    </div>
    <!--center_right end-->
    <div class="clear"></div>
    
    <!--middle_second start-->
    <?php include_once('recommend.php')?>
    <!--middle_second end-->
  </div>
  
  
  
</div>


</body>
</html>