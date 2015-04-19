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
	

	<a href="/admin/activity" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/activity/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
				<tr>
		            <td width="150" height="25" align="right">活动名称；</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		        <tr>
		            <td width="150" height="25" align="right">活动类型；</td>
		            <td align="left" class="padL10"><input type="text" name="type" value="<?php if( !empty($info['type']) ) echo $info['type']; else echo 'http://'; ?>" /></td>
		        </tr>
		        <tr>
		            <td height="25" align="right">活动图片；</td>
		            <td align="left" class="padL10"><input type="text" name="img" value="<?php if( !empty($info['img']) ) echo $info['img']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">简介；</td>
		            <td align="left" class="padL10"><input type="text" name="intro" value="<?php if( !empty($info['intro']) ) echo $info['intro']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">开始时间；</td>
		            <td align="left" class="padL10"><input type="text" name="begtime" value="<?php if( !empty($info['begtime']) ) echo $info['begtime']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">结束时间；</td>
		            <td align="left" class="padL10"><input type="text" name="endtime" value="<?php if( !empty($info['endtime']) ) echo $info['endtime']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">地点；</td>
		            <td align="left" class="padL10"><input type="text" name="place" value="<?php if( !empty($info['place']) ) echo $info['place']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">具体地址；</td>
		            <td align="left" class="padL10"><input type="text" name="address" value="<?php if( !empty($info['address']) ) echo $info['address']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">假报名人数；</td>
		            <td align="left" class="padL10"><input type="text" name="innumfake" value="<?php if( !empty($info['innumfake']) ) echo $info['innumfake']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">报名人数；</td>
		            <td align="left" class="padL10"><input type="text" name="innum" value="<?php if( !empty($info['innum']) ) echo $info['innum']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right">显示</td>
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