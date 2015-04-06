<div id="footer">
  <div class="container">
    <div class="footer3">
      <a class="footer3_main fl" href="<?php echo base_url('/isbuildingaction/index')?>">
        <div class="footer3_left fl"></div>
        <div class="footer3_right fl"><h1>七天无理由退货</h1><h2>为您提供售后无忧保障</h2></div>
      </a>
      
      <a class="footer3_main fl" href="<?php echo base_url('/isbuildingaction/index')?>">
        <div class="footer3_left footer3_left1 fl"></div>
        <div class="footer3_right fl"><h1>全场满299顺丰包邮</h1><h2>多家快递公司合作配送</h2></div>
      </a>
      
      <a class="footer3_main fl" href="<?php echo base_url('/isbuildingaction/index')?>">
        <div class="footer3_left footer3_left2 fl"></div>
        <div class="footer3_right fl"><h1>精美包装</h1><h2>给您最好的购物体验</h2></div>
      </a>
      
      <a class="footer3_main fr" href="<?php echo base_url('/isbuildingaction/index')?>" style="width:192px;">
        <div class="footer3_left footer3_left3 fl"></div>
        <div class="footer3_right fl"><h1>货到付款</h1><h2>品质护航  购物无忧</h2></div>
      </a>
    </div>
    <div class="footer1">
      <!--footer1_link start-->
      <div class="footer1_link">
        <a herf="<?php echo base_url('/isbuildingaction/index')?>" class="footer1_link_top">新手帮助</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">注册新用户</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">网站订购流程</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">如何付款</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">忘记密码</a>
        <br />
        <a herf="<?php echo base_url('/isbuildingaction/index')?>" class="footer1_link_top">购物演示</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">购物流程</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">订购流程</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">交易须知</a>
      </div>
      <div class="footer1_link footer1_link1">
        <a herf="<?php echo base_url('/isbuildingaction/index')?>" class="footer1_link_top">关于支付</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">货到付款</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">在线支付</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">礼品卡及账户余额</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">其他支付方式</a>
        <br />
        <a herf="<?php echo base_url('/isbuildingaction/index')?>" class="footer1_link_top">配送说明</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">配送时间及范围 </a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">订单的拆分 </a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">商品验收与签收 </a>
      </div>
      <div class="footer1_link footer1_link1">
        <a herf="<?php echo base_url('/isbuildingaction/index')?>" class="footer1_link_top">退换货原则</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">退换货政策</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">退换货办理流程</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">退换货网上办理</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">退款说明</a>
        <br />
        <a herf="<?php echo base_url('/isbuildingaction/index')?>" class="footer1_link_top">更多的</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">关于用户工厂</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">用户工厂的杂志</a>
        <a href="<?php echo base_url('/isbuildingaction/index')?>">用户工厂的移动</a>
      </div>
      <!--footer1_link end--->
      <div class="footer1_line"></div>
      
      <div class="footer1_right">
        <div class="friend_links fl">
          <p>友情链接</p>
          <div class="friend_links_main">
            <?php
                if(!empty($friendlyLinks))
                {
                foreach($friendlyLinks as $value)
                    {
                        ?>
                        <a href="<?php echo $value->fl_url ?>" target="_blank"><?php echo $value->fl_title ?></a>
                  <?php
                    }
                } ?>
          </div>
        </div>
        <div class="store_search fl">
          <div class="store_search_select">门店搜索</div>
          <ul class="store_search_main">
              <?php
              if(!empty($shopManage))
              {
                  foreach($shopManage as $value)
                  {
               ?>
            <li><?php echo $value->sm_title ?></li>
          <?php
                  }
              }
          ?>
          </ul>
          <a href="javascript:;" class="store_search_btn">搜  索</a>
        </div>
        <div class="clear"></div>

        <div class="footer1_joinus_top">订阅我们的电子邮件，实时关注我们的产品。</div>
        <div class="footer1_joinus">
          <form action="<?php echo base_url(); ?>/articleaction/addSubscribeEmail"><input type="text" class="footer1_joinus_text" name="join_email"/><input type="submit" value="加入我们" class="footer1_joinus_btn" onclick="return joinForm()"/></form>
        </div>
        
        <div class="footer1_ewm fl"><img src="<?php echo base_url()?>resources/img/ewm.jpg" /><p>官方微博</p></div>
        <div class="footer1_ewm fl"><img src="<?php echo base_url()?>resources/img/ewm.jpg" /><p>官方微信</p></div>
        <div class="footer1_tel fl">
          <div class="footer1_tel_title">服务热线 :</div>
          <div class="footer1_tel_main">400-888-8888</div>
        </div>
      </div>
    </div>
    <div class="footer2">
    Copyright©2014  c2mmall.com 浙ICP备 15002230号 全案策划：<a href="http://www.lebang.com" target="_blank">lebang.com</a>
    </div>
  </div>
</div>