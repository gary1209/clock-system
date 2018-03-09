<?php
header('Content-Type: text/html; charset=utf8');
session_start();
date_default_timezone_set("Asia/Taipei");
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>

<?php
$str = date("Y-m-d;H_i_s");
$eng_name = $_SESSION['eng_name'];
$filename = $eng_name.$str.".jpg";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo_in']) && $_FILES['photo_in']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo_in']['tmp_name'])) {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $filename, fopen($_FILES['photo_in']['tmp_name'], 'rb'), 'public-read');
} 
?>


<?php
header('Content-Type: text/html; charset=utf8');
session_start();
date_default_timezone_set("Asia/Taipei");
$ip = $_SESSION['ip'];
$name = $_SESSION['name'];
$eng_name = $_SESSION['eng_name'];
$notes = $_REQUEST['notes_in'];
$latitude = $_REQUEST['latitude_in'];
$longitude = $_REQUEST['longitude_in'];
$accuracy = $_REQUEST['accuracy_in'];
$geolocation = $latitude."+".$longitude;

include 'db_config.php';


$filepath = 'upload_photo/'.$eng_name.'/';
if (!is_dir($filepath)){
	if(!mkdir($filepath,755,true)){
		die("上傳資料夾不存在，並且創建失敗");
	}
}

if($_FILES['photo_in']['error']>0){
	echo "檔案過大，請使用前置鏡頭";
	echo "錯誤代碼".$_FILES['photo_in']['error']."<br>";
	/*
case 1:
  // 檔案大小超出了伺服器上傳限制 UPLOAD_ERR_INI_SIZE
  $this ->setError( "The file is too large (server)." );
  break ;

case 2:
  // 要上傳的檔案大小超出瀏覽器限制 UPLOAD_ERR_FORM_SIZE
  $this ->setError( "The file is too large (form)." );
  break ;

case 3:
  //檔案僅部分被上傳 UPLOAD_ERR_PARTIAL
  $this ->setError( "The file was only partially uploaded." );
  break ;

case 4:
  //沒有找到要上傳的檔案 UPLOAD_ERR_NO_FILE
  $this ->setError( "No file was uploaded." );
  break ;

case 5:
  //伺服器臨時檔案遺失  
  $this ->setError( "The servers temporary folder is missing." );
  break ;

case 6:
  //檔案寫入到站存資料夾錯誤 UPLOAD_ERR_NO_TMP_DIR
  $this ->setError( "Failed to write to the temporary folder." );
  break ;

case 7:
  //無法寫入硬碟 UPLOAD_ERR_CANT_WRITE
  $this ->setError( "Failed to write file to disk." );
  break ;


case 8:
  //UPLOAD_ERR_EXTENSION
  $this ->setError( "File upload stopped by extension." );
  break ;
  */
}
else{
	// echo "檔案名稱".$_FILES['photo_in']['name']."<br>";
	// echo "檔案類型".$_FILES['photo_in']['type']."<br>";
	// echo "檔案大小".($_FILES['photo_in']["size"]/1024)."Kb<br>";
	// echo "暫存名稱".$_FILES['photo_in']['tmp_name']."<br>";
	// echo $ip."<br>";
	// echo $name."<br>";
	// echo $eng_name."<br>";
	// echo $notes."<br>";
	// echo "(".$latitude.",".$longitude.")<br>";
	// echo $accuracy."<br>";
	$str = date("Y-m-d;H_i_s");
	$full_path = $filepath.$str.".jpg";
	$do_work = file_exists($full_path);
	if($do_work)
	{
		echo "檔案已存在，勿重複上傳!";
	}
    else{
    	$result=move_uploaded_file($_FILES['photo_in']['tmp_name'],$filepath.date("Y-m-d;H_i_s").".jpg");
    	if($result){
    		$sql = "insert into record (name,state,notes,ip,photo_path,geolocation,accuracy) values ('$name','上班','$notes','$ip','$full_path','$geolocation','$accuracy')";
			mysqli_query($my_db,$sql);
			echo "<script>alert('打卡成功'); location.href ='clock-system.php'; </script>";
		}

		else {
			echo "<script>alert('打卡失敗，請重試!'); location.href ='clock-system.php';</script>";
		}
    }

}

//; location.href ='clock-system.php'


    //版本1
//    move_uploaded_file($_FILES['photo_in']['tmp_name'],$filepath.date("Y_m_d_H_i_s").".jpg");

    //版本2
	// $result=move_uploaded_file($_FILES['photo_in']['tmp_name'],$filepath.date("Y_m_d_H_i_s").".jpg");
	// if($result){
	// 	echo "<script>alert('打卡成功'); location.href ='clock-system.php';</script>";
	// }

	// else 
	// {
	// 	echo "<script>alert('打卡失敗，請重試!'); location.href ='clock-system.php';</script>";
	// }

	//版本3
// 	if (file_exists($filepath.date("Y_m_d_H_i_s").".jpg")){
// 　　echo "檔案已經存在，請勿重覆上傳相同檔案";
// 　  }
    
//     else{
//     	$result=move_uploaded_file($_FILES['photo_in']['tmp_name'],$filepath.date("Y_m_d_H_i_s").".jpg");
//     	if($result){
// 			echo "<script>alert('打卡成功'); location.href ='clock-system.php';</script>";
// 		}

// 		else {
// 			echo "<script>alert('打卡失敗，請重試!'); location.href ='clock-system.php';</script>";
// 		}
// 　  }



 


// move_uploaded_file($_FILES['photo_in']['tmp_name'],"upload_photo/".$name.date("Y-m-d;H:i:s").$_FILES['photo_in']['name']);

// $upload_dir = 'upload_photo/';
// $file_name = $_FILES['Filedata']['name'];
// $upload_file = $upload_dir . basename($file_name);
// while(file_exists($upload_file)){
// 	$i = strrpos($file_name, '.');
// 	$file_name = substr($file_name, 0, $i) . '1' .  substr($file_name, $i);
// 	$upload_file = $upload_dir . basename($file_name);
// }
// $temploadfile = $_FILES['Filedata']['tmp_name'];
// $result=move_uploaded_file($_FILES['photo_in']['tmp_name'],$filepath.date("Y_m_d_H_i_s").".jpg");

// if($result){
	
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
