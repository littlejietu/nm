<html>
<head>
</head>

<body>
<?php echo validation_errors('<div class="error">', '</div>');?>

<form action="/m/comment/save<?php echo '?id='._get_param($info['id'],TRUE); ?>" method="post">

	标题<input type="text" name="title" value="<?php echo _get_param( $info['title']) ?>" /><br />
	内容<input type="text" name="memo" value="<?php echo _get_param( $info['memo'] );?>" /><br />

	<input type="submit" value="提交">

</form>


</body>
</html>