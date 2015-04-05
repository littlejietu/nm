<script type="text/javascript">
// 加入收藏 兼容360和IE6
function shoucang(sTitle,sURL)
{
try
{
window.external.addFavorite(sURL, sTitle);
}
catch (e)
{
try
{
window.sidebar.addPanel(sTitle, sURL, "");
}
catch (e)
{
alert("加入收藏失败，请使用Ctrl+D进行添加");
}
}
}
</script>
<div id="header">
  <!--header_top start-->
  <div class="header_top">
    <div class="container">
      <a href="<?php echo base_url('index.php')?>" class="header_top_logo fl">C2M mall</a>
      <div class="header_top_line fl"></div>
      <div class="header_top_tel fl ">服务热线：400-888-8888</div>
      <a href="javascript:void(0)" onclick="shoucang(document.title,window.location)" class="fr">加入收藏</a>
      <div class="header_top_line fr"></div>
      <a href="#" class="header_top_mes fr" target="_blank">消息（0）</a>
      <div class="header_top_line fr"></div>
      <a href="<?php echo base_url()?>useraction/getCollectList" class="fr">我的收藏</a>
      <div class="header_top_line fr"></div>
      <a href="<?php echo base_url('useraction/userOrder')?>" class="fr">我的订单</a>
      <div class="header_top_line fr"></div>
      <div class="header_top_my fr"><p>我的用户工厂</p>
        <div class="header_top_my_main">
          <a href="<?php echo base_url()?>useraction/userOrder/3/<?php echo empty($page)?1:$page?>">已买商品</a>
          <a href="#" target="_blank">我的积分</a>
          <a href="<?php echo base_url()?>useraction/muCoupon" target="_blank">我的优惠券</a>
          <a href="<?php echo base_url('useraction/myshow')?>" target="_blank">秀空间</a>
          <a href="#" target="_blank">我的定制</a>
        </div>
      </div>
	  <div class="header_top_line fr"></div>

	  <?php
            $is_login_id        = empty($_SESSION['user_id'])?'':$_SESSION['user_id'];
            $is_login_nikename  = empty($_SESSION['user_name'])?'':$_SESSION['user_name'];
        ?>
        <?php if(empty($is_login_id)){?>
      <a href="<?php echo base_url('useraction/register')?>" class="header_top_reg fr">免费注册</a>
        <?php }else{?>
        <a class=" fr" href="<?php echo base_url('useraction/logout')?>">退出登录</a>
        <?php }?>
      <div class="header_top_line fr"></div>
      <a href="<?php echo empty($is_login_id)?base_url('login.html'):base_url('useraction/index')?>" class="header_top_reg header_top_login fr">
          <?php
          if(empty($is_login_id)){
              echo '请登陆';
          }else{
              echo $is_login_nikename;
          }
          ?>
      </a>
      <div class="header_top_line fr"></div>
      <a href="<?php echo base_url('index.php')?>" class="header_top_home fr">用户工厂首页</a>

    </div>
  </div>
  <!--header_top end-->

  <!--header_middle start-->
  <div class="header_middle">
    <div class="header_middle_first"><a href="<?php echo base_url('')?>"></a></div>
    <div class="header_middle_second">
      <div class="header_type">
        <a href="<?php echo base_url()?>goodsaction/index/3" class="header_type1"></a>
        <a href="<?php echo base_url()?>goodsaction/index/4" class="header_type2"></a>
        <a href="<?php echo base_url()?>goodsaction/index/5" class="header_type3"></a>
        <a href="<?php echo base_url()?>goodsaction/index/6" class="header_type4"></a>
        <a href="<?php echo base_url()?>goodsaction/index/10" class="header_type5"></a>
        <a href="<?php echo base_url()?>goodsaction/index/8" class="header_type6"></a>
        <a href="<?php echo base_url()?>goodsaction/index/46" class="header_type7"></a>
      </div>
    </div>
  </div>
  <!--header_middle end-->

  <!--hrader_bottom start-->
  <div class="hrader_bottom">
    <div class="container">
      <!--header_hot start-->
       <div class="header_hot fl">
          <div class="header_hot_main fl">
            <div class="header_hot_title fl" style="width:30px;">国 同际 步</div>
            <div class="header_hot_con fl">
              <a href="<?php echo base_url('articleaction/index/13')?>">时尚周</a>
              <a href="<?php echo base_url('articleaction/index/14')?>">影视剧</a>
              <a href="<?php echo base_url('articleaction/index/15')?>">明星</a>
              <a href="#" class="light">设计师</a>
              <a href="#" class="light">艺术家</a>
            </div>
          </div>

          <div class="header_hot_main header_hot_main1 fl" style="width:185px;">
            <div class="header_hot_title fl">活动</div>
            <div class="header_hot_con fl" style="width:135px">
              <a href="<?php echo base_url('articleaction/index/17')?>">粉丝会</a>
              <a href="<?php echo base_url('articleaction/index/18')?>">演出</a>
              <a href="<?php echo base_url('articleaction/index/19')?>">赛事</a>
              <a href="<?php echo base_url('articleaction/index/20')?>">慈善</a>
              <a href="#" class="light">新品</a>
            </div>
          </div>

          <div class="header_hot_main fl" style="width:197px;">
            <div class="header_hot_title fl">推荐</div>
            <div class="header_hot_con fl">
              <a href="#" target="_blank">专家</a>
              <a href="#" target="_blank">设计师</a>
              <a href="#" target="_blank">新品</a>
              <a href="#" target="_blank">搭配</a>
              <a href="<?php echo base_url()?>goodsaction/index/49" target="_blank">预售</a>
              <a href="#" target="_blank" class="light">卡通时尚</a>
            </div>
          </div>

          <div class="header_hot_main header_hot_main1 fl" style="width:187px">
            <div class="header_hot_title fl">定制</div>
            <div class="header_hot_con fl" style="width:132px">
              <a href="#" target="_blank">私人订制</a>
              <a href="#" target="_blank">高级定制</a>
              <a href="#" target="_blank">个性定制</a>
            </div>
          </div>

        </div>
      <!--header_hot end-->

      <!--header_search start-->
      <div class="header_search fr">
          <div class="search">
              <form method="post" action="<?php echo base_url('goodsaction/index')?>/">
                  <input type="text" name="search" class="searchText fl" placeholder="请输入产品名称" value="<?php echo empty($search)?'':$search?>"/>
                  <input type="submit" class="searchBtn fl" value=""/>
              </form>
          </div>
          <div class="search_link">
              <a href="<?php echo base_url('goodsaction/index/1/1/0/0/0/1-0-0-0/设计师')?>">设计师</a>
              <a href="<?php echo base_url('goodsaction/index/1/1/0/0/0/1-0-0-0/明星')?>">明星</a>
              <a href="<?php echo base_url('goodsaction/index/1/1/0/0/0/1-0-0-0/国际同步')?>">国际同步</a>
              <a href="<?php echo base_url('goodsaction/index/1/1/0/0/0/1-0-0-0/预售')?>">预售</a>
              <a href="<?php echo base_url('goodsaction/index/1/1/0/0/0/1-0-0-0/定制')?>">定制</a>
              <a href="<?php echo base_url('goodsaction/index/1/1/0/0/0/1-0-0-0/专家评测')?>">专家评测</a></div>
        </div>
        <!--header_search end-->
    </div>
  </div>
  <!--hrader_bottom end-->
</div>
<!--悬浮-->
<div id="xuanfu">
    <?php
    $userCartNum = $this->session->userdata('userCartNum');
    ?>
  <a href="<?php echo base_url('orderaction/cart')?>" class="xuanfu_cart" >购物车<div class="cart_num"><?php echo empty($userCartNum)?0:$userCartNum?></div></a>
  <!--<a href="#" class="xuanfu_img">图案</a>
  <a href="#" class="xuanfu_xianxia">线下体验</a>-->
<?php
if(!empty($goodsDetailUrl) && ($goodsDetailUrl=='//goodsaction/goodsDetail'||$goodsDetailUrl=='//goodsaction/goodsdetail')){?>
  <a href="javascript:;" class="xuanfu_ewm" style="border:none;">二维码<div class="xuanfu_ewm_main">
          <img src="<?php echo base_url() ?>goodsaction/verificationCode/<?php echo $goodsid ?>">
      </div></a>
    <?php } ?>
  <a href="javascript:;" class="xuanfu_gotop" id="gotop">返回顶部</a>
</div>

<!--登录弹框-->
<div id="tipsPop" class="loginPop">
  <div class="loginPop_box clearfix">
      <a href="javascript:;" class="tipsPop_close" onClick="hidePop()"></a>
      <div class="loginPop_top">账户登录</div>
      <div class="loginPop_main">
        <div class="loginPop_left fl">
          <form>
          <div class="loginPop_tips"></div>
          <input type="text" value="请输入用户名"  class="loginPop_text" id="user" name="username" onblur="blurText(this,'请输入用户名')" onfocus="focusText(this,'请输入用户名')" onKeyUp="keyupText(this)"/>
          <input type="text" value="请输入登录密码" class="loginPop_text"  onblur="blurText(this,'请输入登录密码','showpwd')" onfocus="focusText(this,'请输入登录密码','showpwd')" />
          <input type="password" value="请输入登录密码" class="loginPop_text" id="pwd" name="password" onblur="blurText(this,'请输入登录密码','pwd')" onfocus="focusText(this,'请输入登录密码','pwd')" style="display:none;" onKeyUp="keyupText(this)"/>
          <div class="loginPop_first">
            <div class="loginPop_lock fl" id="lock">
                记住我
                <input type="hidden" value="" name="is_remember" />
            </div>
            <a href="javascript:;" class="loginPop_forgetPwd fr">忘记密码？</a>
          </div>

          <input type="button" value="登 录" class="loginPop_btn" onclick="return loginPopForm('<?php echo base_url()?>');"/>
          </form>
        </div>

        <div class="loginPop_right fl">
          <p>还没有C2M账号？</p>
          <a href="<?php echo base_url()?>useraction/register" class="loginPop_reg">立即注册</a>
          <p>使用以下账号直接登录：</p>
          <div class="loginPop_link">
            <a href="#"></a>
            <a href="#" class="loginPop_sina"></a>
          </div>
        </div>
      </div>
  </div>
  <div class="loginforgetPwd_main">
    <div class="loginforgetPwd_con">
      <input type="text" value="请输入用户名"  class="forgetPwdText" onblur="blurText(this,'请输入用户名')" onfocus="focusText(this,'请输入用户名')"  onKeyUp="keyupText(this)" id="forgetPwd_user"/>
      <input type="text" value="请输入绑定邮箱"  class="forgetPwdText" onblur="blurText(this,'请输入绑定邮箱')" onfocus="focusText(this,'请输入绑定邮箱')"  onKeyUp="keyupText(this)" id="forgetPwd_email"/>

      <input type="button" onclick="loginPop_forgetPwd('<?php echo base_url()?>')" class="forgetPwdBtn" value="发送邮件"/>
      <div class="clear"></div>
      <div class="loginPop_forgetPwd_tips"></div>
    </div>
  </div>
</div>
<div id="layer" style="display:none;"></div>

