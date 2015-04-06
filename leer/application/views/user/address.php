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
      <div class="centerRight_main centerRightBg" >
        <div class="center_title">送货地址</div>
        <!--center_main start-->
        <div class="center_main">
          <!--address start-->
          <div class="address">
            <?php
                if(!empty($addressList[0])){
                    foreach($addressList as $value){
            ?>
            <!--addressInfo start-->
            <div class="addressInfo <?php if($value->is_default){echo 'addSelected';}?>" onClick="setAddressDefault(this,'<?php echo base_url()?>','<?php echo $value->address_id?>')">
               <div class="addressInfo_top"><?php echo $value->province?>省 <?php echo $value->city?> <?php echo $value->area?>&nbsp;&nbsp;<span class="purple">(<?php echo $value->user_real_name?>收)</span></div>
               <div class="addressInfo_main">
                   <?php echo $value->address?>&nbsp;&nbsp;<?php echo $value->user_tel?> <?php echo $value->user_phone?> <br />
                 <a href="<?php echo base_url('/useraction/address/'.$value->address_id)?>" class="changeAddress purple">[修改本地址]</a>
               </div>
            </div>
            <!--addressInfo end-->
            <?php }}?>


            <div class="clear"></div>

            <a href="javascript:;" class="addAddress" id="addAddress">添加新地址</a>
          </div>
          <!--address end-->
          
          
          <div id="addressForm" <?php if(!empty($addressInfo)){echo 'style="display:block"';}?>>
          <form action="<?php echo base_url('/useraction/addEditAddress')?>" method="post">
              <input name="act" value="<?php if(!empty($addressInfo)){echo 'edit';}else{echo 'add';}?>" type="hidden">
              <?php if(!empty($addressId)){?>
              <input name="addressId" value="<?php echo $addressId;?>" type="hidden">
              <?php }?>
          <table cellpadding="0" cellspacing="0" class="centerTable">
            <tr height="58">
              <td width="78" valign="top"><font>所在地区 <span class="red">*</span></font></td>
              <td><div id="sjld">
    			<div class="m_zlxg" id="shenfen">
        		  <p title="<?php if(!empty($addressInfo) && $addressInfo->province){echo $addressInfo->province;}?>"><?php if(!empty($addressInfo) && $addressInfo->province){echo $addressInfo->province;}?></p>
       			  <div class="m_zlxg2">
        			<ul>
        			</ul>
        		  </div>
    			</div>
    			<div class="m_zlxg" id="chengshi">
        		  <p title="<?php if(!empty($addressInfo) && $addressInfo->city){echo $addressInfo->city;}?>"><?php if(!empty($addressInfo) && $addressInfo->city){echo $addressInfo->city;}?></p>
        		  <div class="m_zlxg2">
        		    <ul>
        			</ul>
        		  </div>
     			</div>
    		   <div class="m_zlxg" id="quyu">
       			 <p title="<?php if(!empty($addressInfo) && $addressInfo->area){echo $addressInfo->area;}?>"><?php if(!empty($addressInfo) && $addressInfo->area){echo $addressInfo->area;}?></p>
       			 <div class="m_zlxg2">
       			   <ul>
        		   </ul>
        	     </div>
     		   </div>

     		  <input id="sfdq_num" type="hidden" value="" />
     		  <input id="csdq_num" type="hidden" value="" />
     		  <input id="sfdq_tj"  name="province" type="hidden" value="<?php if(!empty($addressInfo) && $addressInfo->province){echo $addressInfo->province;}?>" />
     		  <input id="csdq_tj"  name="city" type="hidden" value="<?php if(!empty($addressInfo) && $addressInfo->city){echo $addressInfo->city;}?>" />
     		  <input id="qydq_tj"  name="quyu" type="hidden" value="<?php if(!empty($addressInfo) && $addressInfo->area){echo $addressInfo->area;}?>" />
    		  </div>
              </td>
            </tr>
            <tr height="139">
              <td width="78" valign="top"><font>详细地址 <span class="red">*</span></font></td>
              <td><textarea name="address" class="centerArea fl" onBlur="blurText(this,'不需要重复写省市区，必须大于5个字符')" onFocus="focusText(this,'不需要重复写省市区，必须大于5个字符')" onKeyUp="keyupText(this)" id="add"><?php if(!empty($addressInfo) && $addressInfo->address){echo $addressInfo->address;}else{echo '不需要重复写省市区，必须大于5个字符';}?></textarea><div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>邮政编码  <span class="red">*</span></font></td>
              <td><input name="email_code" type="text" value="<?php if(!empty($addressInfo) && $addressInfo->email_code){echo $addressInfo->email_code;}?>" class="centerText fl" id="zip" style="width:388px;" onKeyUp="keyupText(this)"/>
              <div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>收货人  <span class="red">*</span></font></td>
              <td><input type="text" name="user_real_name" value="<?php if(!empty($addressInfo) && $addressInfo->user_real_name){echo $addressInfo->user_real_name;}else{echo '长度不超过25个字符';}?>" class="centerText  nofocus fl" onBlur="blurText(this,'长度不超过25个字符')" onFocus="focusText(this,'长度不超过25个字符')" onKeyUp="keyupText(this)" id="name" style="width:388px;"/>
              <div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>手机号码</font></td>
              <td><input type="text" name="user_tel" value="<?php if(!empty($addressInfo) && $addressInfo->user_tel){echo $addressInfo->user_tel;}else{echo '电话号码、手机号码必须填一项';}?>" class="centerText  nofocus fl" onBlur="blurText(this,'电话号码、手机号码必须填一项')" onFocus="focusText(this,'电话号码、手机号码必须填一项')" onKeyUp="keyupText(this)" id="phone" style="width:388px;"/>
              <div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="58">
              <td width="72" valign="top"><font>电话号码 </font></td>
              <td><input type="text" name="user_phone_1" value="<?php if(!empty($addressInfo) && $addressInfo->user_phone){echo $addressInfo->user_phone1;}else{echo '区号';}?>" class="centerText nofocus fl" onBlur="blurText(this,'区号')" onFocus="focusText(this,'区号')" onKeyUp="keyupText(this)" id="quhao" style="width:97px;"/>
              <div class="fl tel_line">-</div>
              <input type="text" name="user_phone_2" value="<?php if(!empty($addressInfo) && $addressInfo->user_phone){echo $addressInfo->user_phone2;}else{echo '电话号码';}?>" class="centerText nofocus fl" onBlur="blurText(this,'电话号码')" onFocus="focusText(this,'电话号码')" onKeyUp="keyupText(this)" id="dianhua" style="width:97px;"/>
              <div class="fl tel_line">-</div>
              <input type="text" name="user_phone_3" value="<?php if(!empty($addressInfo) && $addressInfo->user_phone){echo $addressInfo->user_phone3;}else{echo '分机';}?>" class="centerText nofocus fl" onBlur="blurText(this,'分机')" onFocus="focusText(this,'分机')" onKeyUp="keyupText(this)" id="fenji" style="width:97px;"/>
              <div class="tips purple_tips fl"><span></span></div></td>
            </tr>
            <tr height="42">
              <td></td>
              <td><div class="defaultAdd"><input type="checkbox" <?php if(!empty($addressInfo) && $addressInfo->is_default){echo 'checked="checked"';}?> name="is_default" id="defaultAdd" value="1" /><label for="defaultAdd">设置为默认收货地址</label></div></td></td>
            </tr>
            <tr><td></td><td><input type="submit" class="centerBtn" value="保 存" onClick="return addressForm();"/></td></tr>
          </table>
          </form>
          </div>
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