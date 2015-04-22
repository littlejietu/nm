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
	

	<a href="/admin/user" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/user/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 用户名；</td>
		            <td align="left" class="padL10"><input type="text" name="username" value="<?php if( !empty($info['username']) ) echo $info['username']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 昵称；</td>
		            <td align="left" class="padL10"><input type="text" name="nickname" value="<?php if( !empty($info['nickname']) ) echo $info['nickname']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 用户类型；</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="usertype" value="1" <?php if( !empty($info['usertype']) && $info['usertype']==1 ) echo ' checked' ?> />模特
		            		<input type="radio" name="usertype" value="2" <?php if( !empty($info['usertype']) && $info['usertype']==2 ) echo ' checked' ?> />经纪公司
		            		<input type="radio" name="usertype" value="3" <?php if( !empty($info['usertype']) && $info['usertype']==3 ) echo ' checked' ?> />企业
		            </td>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 真实姓名；</td>
		            <td align="left" class="padL10"><input type="text" name="realname" value="<?php if( !empty($info['realname']) ) echo $info['realname']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 手机；</td>
		            <td align="left" class="padL10"><input type="text" name="photo" value="<?php if( !empty($info['photo']) ) echo $info['photo']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 性别；</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="sex" value="1" <?php if( !empty($info['sex']) && $info['sex']==1 ) echo ' checked' ?> />男
		            		<input type="radio" name="sex" value="2" <?php if( !empty($info['sex']) && $info['sex']==2 ) echo ' checked' ?> />女
		            </td>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 所在城市；</td>
		            <td align="left" class="padL10"><input type="text" name="city" value="<?php if( !empty($info['city']) ) echo $info['city']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 身高；</td>
		            <td align="left" class="padL10"><input type="text" name="height" value="<?php if( !empty($info['height']) ) echo $info['height']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 体重；</td>
		            <td align="left" class="padL10"><input type="text" name="weight" value="<?php if( !empty($info['weight']) ) echo $info['weight']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 胸围；</td>
		            <td align="left" class="padL10"><input type="text" name="bust" value="<?php if( !empty($info['bust']) ) echo $info['bust']; ?>" /></td>
		        </tr>
		          <tr>
		            <td height="25" align="right"><span class="tips">*</span> 腰围；</td>
		            <td align="left" class="padL10"><input type="text" name="waist" value="<?php if( !empty($info['waist']) ) echo $info['waist']; ?>" /></td>
		        </tr>
		          <tr>
		            <td height="25" align="right"><span class="tips">*</span> 臀围；</td>
		            <td align="left" class="padL10"><input type="text" name="hips" value="<?php if( !empty($info['hips']) ) echo $info['mephotomo']; ?>" /></td>
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