<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>main.css" rel="stylesheet">
    <link href="<?php echo _get_cfg_path('admin_css')?>right.css" rel="stylesheet">

</head>

<body>

<div class="right_con common">

	<h1>站内信管理</h1>
	<table cellpadding="0" cellspacing="0" align="center" bordercolor="#eee" border="1" width="100%" class="listTab">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="250" height="25" align="center">接收方id</td>
	            <td>接收方昵称</td>
	            <td>标题</td>
	            <td>内容</td>
	            <td>是否已读</td>
	            <td>是否删除</td>
	            <td>时间</td>	            	           
	            <td>操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['touserid'];?></td>
				<td><?php echo $a['tonickname'];?></td>
				<td><?php echo $a['title'];?></td>
				<td><?php echo $a['content'];?></td>
				<td><?php if($a['readed']==1) echo '已读'; else echo '未读';?></td>
				<td><?php if($a['status']==1) echo '正常'; else echo '已删除';?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>				
				<td class="con_title">
					<a href="/admin/message/add?id=<?php echo _get_key_val($a['id']);?>">修改</a>
					<a href="/admin/message/del?id=<?php echo _get_key_val($a['id']);?>">删除</a>
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