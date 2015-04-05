<?php include_once(APPPATH.'views/publish/head.php') ?>
<body id="centerBg">
<div id="center">
  <div class="container">
    <!--center_left start-->
    <?php include_once('center_nav.php')?>
    <!--center_left end-->
    
    <!--center_right start-->
    <div class="centerRight fr">
      <!--centerRight_top start-->
      <?php include_once('center_top.php')?>
      <!--centerRight_top end-->
      
      <!--centerRight_main start-->
      <div class="centerRight_main centerRightBg" >
        <div class="center_title">资料管理</div>
        <!--center_main start-->
        <div class="center_main">
          <form action="<?php echo base_url('/useraction/editUser')?>" method="post" enctype="multipart/form-data">
          <table cellpadding="0" cellspacing="0" class="centerTable">
              <tr height="58">
                  <td width="72" valign="top"><font>真实姓名：</font></td>
                  <td><input type="text" value="<?php if(!empty($userInfo->user_real_name)){echo $userInfo->user_real_name;}?>" name="user_real_name" class="centerText fl" id="user_real_name"  />
                      <div class="tips purple_tips fl"><span>ss</span></div></td>
              </tr>
            <tr height="58">
              <td width="72" valign="top"><font>昵称：</font></td>
              <td><input type="text" value="<?php if($userInfo->user_nikename){echo $userInfo->user_nikename;}?>" name="user_nikename" class="centerText fl" id="name" onKeyUp="keyupText(this)"/>
              <div class="tips purple_tips fl"><span>ss</span></div></td>
            </tr>
            <tr height="118">
              <td width="72" valign="top"><font>头像：</font></td>
              <td>
                <div class="center_photo fl"><img src="<?php if($userInfo->user_image){echo $userInfo->user_image;}else{echo base_url().'resources/img/phone.jpg';}?>" /></div>
                <div class="filer_box fl">
                  <input type='button'  class="filer_btn" value='浏览' />
                  <input type="file" name="user_img" id="fileField" value="" class="filer" /></div>
                <div class="center_photoTip fl">选择图片文件（可上传1M以内的图片）</div>
                </td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>性别：</font></td>
              <td>
                  <input type="radio"  name="user_sex" id="sex1" value="1" <?php if($userInfo->user_sex == '1'){echo 'checked="checked"';}?>/><label for="sex1">男</label>
                  <input type="radio"  name="user_sex" id="sex2" value="0" <?php if($userInfo->user_sex == '0'){echo 'checked="checked"';}?> /><label for="sex2">女</label>
              </td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>手机：</font></td>
              <td><input type="text" class="centerText" name="user_tel" value="<?php if($userInfo->user_tel){echo $userInfo->user_tel;}?>"/> </td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>邮箱：</font></td>
              <td><input type="text" name="user_mail" value="<?php if($userInfo->user_mail){echo $userInfo->user_mail;}?>" class="centerText fl" style="width:342px;" id="email" onKeyUp="keyupText(this)"/>
              <div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>地区：</font></td>
              <td><div id="sjld">
    			<div class="m_zlxg" id="shenfen">
        		  <p title="<?php if($userInfo->user_province){echo $userInfo->user_province;}?>"><?php if($userInfo->user_province){echo $userInfo->user_province;}?></p>
       			  <div class="m_zlxg2">
        			<ul>
        			</ul>
        		  </div>
    			</div>
    			<div class="m_zlxg" id="chengshi">
                    <p title="<?php if($userInfo->user_city){echo $userInfo->user_city;}?>"><?php if($userInfo->user_city){echo $userInfo->user_city;}?></p>
        		  <div class="m_zlxg2">
        		    <ul>
        			</ul>
        		  </div>
     			</div>
    		   <div class="m_zlxg" id="quyu">
                   <p title="<?php if($userInfo->user_area){echo $userInfo->user_area;}?>"><?php if($userInfo->user_area){echo $userInfo->user_area;}?></p>
       			 <div class="m_zlxg2">
       			   <ul>
        		   </ul>
        	     </div>
     		   </div>
     		  <input id="sfdq_num" type="hidden" value="" />
     		  <input id="csdq_num" type="hidden" value="" />
     		  <input id="sfdq_tj"  name="user_province" type="hidden" value="<?php if($userInfo->user_province){echo $userInfo->user_province;}?>" />
     		  <input id="csdq_tj"  name="user_city" type="hidden" value="<?php if($userInfo->user_city){echo $userInfo->user_city;}?>" />
     		  <input id="qydq_tj"  name="user_area" type="hidden" value="<?php if($userInfo->user_area){echo $userInfo->user_area;}?>" />
    		  </div>
              </td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>地址：</font></td>
              <td><input type="text" name="user_address" value="<?php if($userInfo->user_address){echo $userInfo->user_address;}?>" class="centerText" style="width:558px;"/>
              </td>
            </tr>
            <tr><td colspan="2"><input type="submit" class="centerBtn" value="确 认" onClick="return manageForm();"/></td></tr>
          </table>
          </form>
        </div>
        <!--center_main end-->
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