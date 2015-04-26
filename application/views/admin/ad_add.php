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
	

	<a href="/admin/ad" class="topBtn">返回列表</a>
	<?php echo validation_errors('<div class="valid_error">', '</div>');?>
	<form action="/admin/ad/save<?php if( !empty($info['id']) ) echo '?id='. _get_key_val( $info['id'] ); ?>" method="post">

		<table class="addTable">
			<tbody>
		        <tr>
		            <td height="25" align="right"><span class="tips">*</span> 广告名称；</td>
		            <td align="left" class="padL10"><input type="text" name="title" value="<?php if( !empty($info['title']) ) echo $info['title']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 广告位id；</td>
		            <td align="left" class="padL10"><input type="text" name="placeid" value="<?php if( !empty($info['placeid']) ) echo $info['placeid']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 图片地址；</td>
		            <td align="left" class="padL10"><input type="text" name="img" value="<?php if( !empty($info['img']) ) echo $info['img']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 链接地址；</td>
		            <td align="left" class="padL10"><input type="text" name="url" value="<?php if( !empty($info['url']) ) echo $info['url']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 简介；</td>
		            <td align="left" class="padL10"><input type="text" name="summary" value="<?php if( !empty($info['summary']) ) echo $info['summary']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 备注；</td>
		            <td align="left" class="padL10"><input type="text" name="memo" value="<?php if( !empty($info['memo']) ) echo $info['memo']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 金额；</td>
		            <td align="left" class="padL10"><input type="text" name="price" value="<?php if( !empty($info['price']) ) echo $info['price']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 开始时间；</td>
		            <td align="left" class="padL10"><input type="text" name="begtime" value="<?php if( !empty($info['begtime']) ) echo $info['begtime']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 结束时间；</td>
		            <td align="left" class="padL10"><input type="text" name="endtime" value="<?php if( !empty($info['endtime']) ) echo $info['endtime']; ?>" /></td>
		        </tr>
		         <tr>
		            <td height="25" align="right"><span class="tips">*</span> 排序；</td>
		            <td align="left" class="padL10"><input type="text" name="sort" value="<?php if( !empty($info['sort']) ) echo $info['sort']; ?>" /></td>
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