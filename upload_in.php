<?php
session_start();

if($_FILES['photo_in']['error']>0){
	echo "錯誤代碼".$_FILES['photo_in']['error']."<br>";
}
else{
	echo "檔案名稱".$_FILES['photo_in']['name']."<br>";
	echo "檔案類型".$_FILES['photo_in']['type']."<br>";
	echo "檔案大小".$_FILES['photo_in']['size']."<br>";
	echo "暫存名稱".$_FILES['photo_in']['tmp_name'];

	move_uploaded_file($_FILES['photo_in']['tmp_name'],"upload_photo/"."7777");
}





// $upload_dir = 'upload_photo/';
// $file_name = $_FILES['Filedata']['name'];
// $upload_file = $upload_dir . basename($file_name);
// while(file_exists($upload_file)){
// 	$i = strrpos($file_name, '.');
// 	$file_name = substr($file_name, 0, $i) . '1' .  substr($file_name, $i);
// 	$upload_file = $upload_dir . basename($file_name);
// }
// $temploadfile = $_FILES['Filedata']['tmp_name'];
// $result=move_uploaded_file($temploadfile , $upload_file);

// if ($result)
// {
	
// 	echo "<script>alert('打卡成功'); location.href ='clock-system.php';</script>";
// }
// else 
// {
// 	echo "<script>alert('打卡失敗，請重試!'); location.href ='clock-system.php';</script>";
// }
 

// date_default_timezone_set("Asia/Taipei");
// $date = date('Y m/d');
// $time = date('h:i:sa');
// echo "$date&nbsp;&nbsp;\n";
// echo "<h2>"."$time&nbsp;&nbsp;\n"."</h2>";
?>