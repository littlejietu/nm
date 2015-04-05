<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>resources/css/base.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>resources/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>resources/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>resources/js/common.js"></script>
</head>

<body>
<input type="hidden" name="evaimgSrc" value="<?php echo empty($uploadData)?'':$uploadData?>">
<form action="<?php echo base_url('/useraction/loadIframe')?>" method="post" enctype="multipart/form-data" id="eavimgForm">
    <div class="filer_box fl filer_box1">
        <input type='button' class="filer_btn" value='选择文件'/>
        <input type="file" name="fileField" id="fileField" value="" class="filer" onchange="evaFile()"/>
    </div>
    <div class="center_photoTip center_photoTip1 fl">选择图片文件（可上传1M以内的图片）</div>
   
</form>
</body>
</html>