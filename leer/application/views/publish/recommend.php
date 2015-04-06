<div class="middle_second hotRecommon">
      <div class="middle_top">热门推荐</div> 
      <div class="middle_new">
	    <div class="hd">
          <a class="prev"></a>
		  <a class="next"></a>
	    </div>
		<div class="bd">
		  <ul class="picList">
            <?php for($i=0;$i<10;$i++) {?>
		    <li><a href="#">
			  <img src="img/new.jpg" />
              <div class="middle_new_title">史努比新品十二种色彩环保袋</div>	
              <div class="middle_new_price">￥<span>3,250.00</span></div>	
              <div class="middle_new_con">2014秋新款双肩包潮女包包抽绳包帆布包束口包环保袋史努比</div>
              <dl class="star">
                <dd class="cur"></dd>
                <dd class="cur"></dd>
                <dd class="cur"></dd>
                <dd class="cur"></dd>
                <dd></dd>
              </dl>	
			</a></li>
            <?php }?>	
		  </ul>
		</div>
	  </div>

	  <script type="text/javascript">
	  jQuery(".middle_new").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",vis:5,scroll:5,interTime:4000,delayTime:1000});
	  </script>
    </div>