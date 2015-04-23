<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>订单管理</h1>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">用户</td>
	            <td>订单编号</td>
	            <td>工作内容</td>
	            <td>工作场景</td>
	            <td>计价方式</td>
	            <td>预定价格</td>
	            <td>备 注</td>
	            <td>期望拍片开始日期</td>
	            <td>期望拍片结束日期</td>
	            <td>联 系 人</td>
	            <td>联系方式</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['sellerid'];?></td>
				<td><?php echo $a['no'];?></td>
				<td><?php echo $a['work'];?></td>
				<td><?php echo $a['scene'];?></td>
				<td><?php echo $a['pertime'];?></td>
				<td><?php echo $a['price'];?></td>
				<td><?php echo $a['memo'];?></td>
				<td><?php echo $a['begtime'];?></td>
				<td><?php echo $a['endtime'];?></td>
				<td><?php echo $a['linkman'];?></td>
				<td><?php echo $a['linkway'];?></td>				
				<td class="con_title">
					<a href="/admin/orderbook/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/orderbook/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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