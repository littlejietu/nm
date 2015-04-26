<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>认证管理</h1>
	
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">用户</td>
	            <td>用户名</td>
	            <td>真实姓名</td>
	            <td>身份证</td>	           
           		<td>手机号</td>
	            <td>所属经纪公司</td>
	            <td>保证金</td>	                       	           
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['userid'];?></td>
				<td><?php echo $a['username'];?></td>
				<td><?php echo $a['realname'];?></td>
				<td><?php echo $a['idno'];?></td>
				<td><?php echo $a['mobile'];?></td>								
				<td><?php echo $a['company'];?></td>
				<td><?php echo $a['bail'];?></td>												
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo $a['op_time'];?></td>
				<td class="con_title">
					<a href="/admin/cert/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/cert/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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