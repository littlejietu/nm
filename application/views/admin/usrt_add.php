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
		            <td align="left" class="padL10"><input type="text" name="usertype" value="<?php if( !empty($info['usertype']) ) echo $info['usertype']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 服务态度；</td>
		            <td align="left" class="padL10"><input type="text" name="attitude" value="<?php if( !empty($info['attitude']) ) echo $info['attitude']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 评价内容；</td>
		            <td align="left" class="padL10"><input type="text" name="memo" value="<?php if( !empty($info['memo']) ) echo $info['memo']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 是否精华；</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="good" value="1" <?php if( !empty($info['good']) && $info['good']==1 ) echo ' checked' ?> />精华
		            		<input type="radio" name="good" value="2" <?php if( !empty($info['good']) && $info['good']==2 ) echo ' checked' ?> />非精华
		            </td>
		        </tr>
		        
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span>显示；</td>
		            <td align="left" class="padL10">
		            	<input type="radio" name="display" value="1" <?php if( !empty($info['display']) && $info['display']==1 ) echo ' checked' ?> />显示
		            		<input type="radio" name="display" value="2" <?php if( !empty($info['display']) && $info['display']==2 ) echo ' checked' ?> />不显示
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