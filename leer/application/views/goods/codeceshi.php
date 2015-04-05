<?php
include('application/phpqrcode/phpqrcode.php');
//使用举例浏览器输出：
$value= $url;
$errorCorrectionLevel = "L";
$matrixPointSize = "4";
QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
?>
