<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>index.css" rel="stylesheet">
</head>

<body>

<div class="right_con common adduser">
	

	<a href="/admin/cert" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/cert/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
		        <tr>
		            <td height="25" align="right"> 用户id；</td>
		            <td align="left" class="padL10"><?php if( !empty($info['userid']) ) echo $info['userid']; ?></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"> 用户名(冗余)；</td>
		            <td align="left" class="padL10"><?php if( !empty($info['username']) ) echo $info['username']; ?></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 真实姓名；</td>
		            <td align="left" class="padL10"><input type="text" name="realname" value="<?php if( !empty($info['realname']) ) echo $info['realname']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 身份证；</td>
		            <td align="left" class="padL10"><input type="text" name="idno" value="<?php if( !empty($info['idno']) ) echo $info['idno']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 手机号；</td>
		            <td align="left" class="padL10"><input type="text" name="mobile" value="<?php if( !empty($info['mobile']) ) echo $info['mobile']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"> 身份证照片；</td>
		            <td align="left" class="padL10"><input type="text" name="idnoimg" value="<?php if( !empty($info['idnoimg']) ) echo $info['idnoimg']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 所属经纪公司；</td>
		            <td align="left" class="padL10"><input type="text" name="company" value="<?php if( !empty($info['company']) ) echo $info['company']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"> 保证金；</td>
		            <td align="left" class="padL10"><input type="text" name="bail" value="<?php if( !empty($info['bail']) ) echo $info['bail']; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 认证状态；</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="status" value="1" <?php if( !empty($info['status']) && $info['status']==1 ) echo ' checked' ?> />成功
		            		<input type="radio" name="status" value="-1" <?php if( !empty($info['status']) && $info['status']==-1 ) echo ' checked' ?> />失败
		            </td>
		        </tr>
		        
				<tr>
		            <td></td>
		            <td class="padL10"><input type="submit" class="sub" value="提交"></td>
		        </tr>
		    </tbody>
		</table>
	</form>
</div>

</body>
</html>