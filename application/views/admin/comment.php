<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>评论管理</h1>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">被评价用户</td>
	            <td>被评价昵称</td>
	            <td>评价人用户</td>
	            <td>评价人昵称</td>
	            <td>评价人头像</td>
	            <td>回复</td>
	            <td>身材样貌</td>
	            <td>专业技能</td>
	            <td>工作效率</td>
	            <td>工作态度</td>
	            <td>评价内容</td>
	            <td>是否精华</td>
	            <td>时间</td>
	            <td>显示</td>
	            <td>最后操作人</td>
	            <td>最后操作时间</td>
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['touserid'];?></td>
				<td><?php echo $a['tonickname'];?></td>
				<td><?php echo $a['userid'];?></td>
				<td><?php echo $a['nickname'];?></td>
				<td><?php echo $a['logo'];?></td>
				<td><?php echo $a['commentid'];?></td>
				<td><?php echo $a['figure'];?></td>
				<td><?php echo $a['skill'];?></td>
				<td><?php echo $a['efficiency'];?></td>
				<td><?php echo $a['attitude'];?></td>
				<td><?php echo $a['memo'];?></td>
				<td><?php echo $a['good'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>
				<td><?php if($a['display']==1) echo '显示'; else if($a['display']==2) echo '不显示';  else echo '';?></td>
				<td><?php echo $a['op_username'];?></td>
				<td><?php echo $a['op_time'];?></td>
				<td class="con_title">
					<a href="/admin/comment/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/comment/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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