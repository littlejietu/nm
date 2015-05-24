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
	            <td width="150" height="25" align="center">订单编号</td>
	            <td>订单标题</td>
	            <td>卖家昵称</td>
	            <td>总价</td>
	            <td>买家昵称</td>
	            <td>下单时间</td>
	            <td>支付时间</td>
	            <td>支付状态</td>
	            <td>确认</td>
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['no'];?></td>
				<td><?php echo $a['title'];?></td>
				<td><?php echo $a['seller_nickname'];?></td>
				<td><?php echo $a['totalprice'];?></td>
				<td><?php echo $a['buyer_nickname'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>
				<td><?php if($a['paytime']>0) echo date('Y-m-d H:i:s',$a['paytime']);?></td>
				<td><?php echo $a['paystatus'];?></td>
				<td><?php echo $a['reject'];?></td>
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['op_time']);?></td>				
				<td class="con_title">
					<a href="/admin/order/add?id=<?php echo _get_key_val($a['id']);?>">详细</a>
					
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