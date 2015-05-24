<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>会员管理</h1>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">用户名</td>
	            <td>昵称</td>
	            <td>用户类型</td>
	            <td>真实姓名</td>
	            <td>手机</td>
	            <td>性别</td>
	            <td>所在城市</td>
	            <td>身高</td>
	            <td>体重</td>
	            <td>胸围</td>
	            <td>腰围</td>
	            <td>臀围</td>
	            <td>操作</td> 
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['username'];?></td>
				<td><?php echo $a['nickname'];?></td>
				<td><?php if($a['usertype']==1) echo '模特';
				 else if($a['usertype']==2) echo '经纪公司';  
				 else if($a['usertype']==3) echo '企业';  else echo '';?></td>
			
				<td><?php echo $a['realname'];?></td>
				<td><?php echo $a['mobile'];?></td>
				<td><?php if($a['sex']==1) echo '男'; else if($a['sex']==2) echo '女';  else echo '';?></td>
				<td><?php echo $a['city'];?></td>
				<td><?php echo $a['height'];?></td>
				<td><?php echo $a['weight'];?></td>
				<td><?php echo $a['bust'];?></td>
				<td><?php echo $a['waist'];?></td>
				<td><?php echo $a['hips'];?></td>								
				<td class="con_title"> 
					<a href="/admin/message/add?touserid=<?php echo _get_key_val($a['id']);?>">发消息</a>
					<a href="/admin/user/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/user/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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