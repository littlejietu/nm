<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>广告管理</h1>
	<div><a href='/admin/ad/add' class="sub">添加</a></div>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">广告名称</td>
	            <td>广告位</td>
	            <td>图片地址</td>           
           		<td>金额</td>
	            <td>开始时间</td>
	            <td>结束时间</td>
	            <td>排序</td>
	            <td>显示</td>	            	           
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><a href="<?php echo $a['url'];?>" target="_blank"><?php echo $a['title'];?></a></td>
				<td><?php echo $a['placeid'];?></td>
				<td><img src="<?php echo _get_image_url($a['img']);?>" width="150"></td>
				<td><?php echo $a['price'];?></td>								
				<td><?php echo $a['begtime'];?></td>
				<td><?php echo $a['endtime'];?></td>
				<td><?php echo $a['sort'];?></td>
				<td><?php if($a['display']==1) echo '显示'; else if($a['display']==2) echo '不显示';  else echo '';?></td>								
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo $a['op_time'];?></td>
				<td class="con_title">
					<a href="/admin/ad/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/ad/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
				</td>
			</tr>
			<?php endforeach;?>
			
	    </tbody>
	</table>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td colspan="2" height="32" align="right">
                <div class="page">
                	<?=$list['pages']?>
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>