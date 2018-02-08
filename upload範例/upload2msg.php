<?php
$upload_dir = 'tmp/';
$file_name = $_FILES['Filedata']['name'];
$upload_file = $upload_dir . basename($file_name);
while(file_exists($upload_file)){
	$i = strrpos($file_name, '.');
	$file_name = substr($file_name, 0, $i) . '1' .  substr($file_name, $i);
	$upload_file = $upload_dir . basename($file_name);
}
$temploadfile = $_FILES['Filedata']['tmp_name'];
$result=move_uploaded_file($temploadfile , $upload_file);

if ($result)
{
	$size = getimagesize($upload_file);
	$message =  "<img src=\"tmp/".$file_name."\">";
}
else 
{
	$message = "上傳失敗";
}
 
echo $message;
?>