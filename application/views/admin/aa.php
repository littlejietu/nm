<html>
<head>
	<link href="<?php echo _get_cfg_path('admin_css')?>base.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo _get_cfg_path('admin_css')?>common.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="right_con">

	<h1>aa管理</h1>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="1" width="100%">
		<tbody>
			<tr height="39" style="font-size:13px;">
	            <td width="139" height="25" align="center">标题</td>
	            <td align="left" class="p60">内容</td>
	            <td align="left" class="p60">时间</td>
	            <td align="left" class="p60">操作</td>
	        </tr>
	        <?php foreach ($list['rows'] as $key => $a): ?>
			<tr>
				<td height="30"><?php echo $a['name'];?></td>
				<td><?php echo $a['memo'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$a['addtime']);?></td>
				<td><a href="/admin/aa/add?id=<?php echo _get_key_val($a['id']);?>">修改</a></td>
			</tr>
			<?php endforeach;?>
			
	    </tbody>
	</table>
	<table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
		<tr>
            <td colspan="2" height="32" align="right">
                <div class="page">
                    <span>共0条</span>&nbsp;&nbsp;<span>共0页</span>&nbsp;&nbsp;<a class="sy" href="/admin/indexaction/indexpage/1">首页</a><a class="syy" href="/admin/indexaction/indexpage/1">上一页</a><a class="xyy" href="/admin/indexaction/indexpage/0">下一页</a><a class="my" href="/admin/indexaction/indexpage/0">尾页</a>                        </div>
            </td>
        </tr>
    </table>
</div>
<a href='/admin/aa/add'>添加</a><br /><br />

</body>
</html>