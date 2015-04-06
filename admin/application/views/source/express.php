<?php include_once("right_head.php")?>
    <div class="common">
        <div class="express">
            
            <?php if(!empty($message)){echo $message;}?>
            <div class="goodsTitle">我的快递：</div>
            <ul class="expressul">
            <?php
                if(!empty($expressList)){
                    foreach((array)$expressList as $value){
            ?>
                <li>
                    <span onclick="sourceAjaxGetData('<?php echo $value->express_id;?>','<?php echo base_url();?>')"><?php echo $value->express_name;?></span>
                    <a href="javascript:;" onclick="javascript:if(confirm('删除快递将导致所有用户有关该快递的运费设置丢失，确认删除？')){deleteExpress($(this),<?php echo $value->express_id?>,'<?php echo base_url()?>');}" class="expressul_dele">删除</a>
                </li>
            <?php }}?>
            </ul>
            <div class="clear"></div>
            <div id="addexpress_btn">
                <a href="javascript:" class="topBtn">新增快递</a>
            </div>
            <input type="text" id="addexpress" onblur="javascript:addExpress($(this),'addExpress','<?php echo base_url()?>');">
            <div class="clear"></div>
        </div>
        <div id="express_cost">

           
        </div>
          <table class="addroute" id="addroute" width="100%">
            <tr align="center">
              <td width="20%">
                  <select onchange="changeExpress($(this),'newCostId','changeStartProvince','<?php echo base_url()?>')">
                      <?php
                        if(!empty($provinceList)){
                           foreach($provinceList as $key => $value){
                      ?>
                      <option value="<?php echo $value->province_id?>"><?php echo $value->province_name?></option>
                      <?php }}?>
                  </select>
              </td>
              <td width="20%">
                  <select onchange="changeExpress($(this),'newCostId','changeEndProvince','<?php echo base_url()?>')">
                      <?php
                      if(!empty($provinceList)){
                          foreach($provinceList as $key => $value){
                              ?>
                              <option value="<?php echo $value->province_id?>"><?php echo $value->province_name?></option>
                      <?php }}?>
                  </select>
              </td>
              <td width="10%"><input type="text" onblur="changeExpress($(this),'newCostId','changeFirstHeightProvince','<?php echo base_url()?>')"/></td>
              <td width="10%"><input type="text" onblur="changeExpress($(this),'newCostId','changeFirstHeightCostProvince','<?php echo base_url()?>')" /></td>
              <td width="10%"><input type="text" onblur="changeExpress($(this),'newCostId','changeLastHeightProvince','<?php echo base_url()?>')" /></td>
              <td width="10%"><input type="text" onblur="changeExpress($(this),'newCostId','changeLastHeightCostProvince','<?php echo base_url()?>')" /></td>
              <td width="10%"><a href='javascript:;'  onclick="delExpressCost($(this),'newCostId','<?php echo base_url()?>')">删除</a></td>
            </tr>
          </table>
        
    </div>
</body>
</html>