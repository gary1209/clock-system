<!-- aws S3 -->
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
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo_out']) && $_FILES['photo_out']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo_out']['tmp_name'])) {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $filename, fopen($_FILES['photo_out']['tmp_name'], 'rb'), 'public-read');
} 
?>
<!-- aws S3 -->

<?php
header('Content-Type: text/html; charset=utf8');
session_start();
date_default_timezone_set("Asia/Taipei");
$ip = $_SESSION['ip'];
$name = $_SESSION['name'];
$eng_name = $_SESSION['eng_name'];
$notes = $_REQUEST['notes_out'];
$latitude = $_REQUEST['latitude_out'];
$longitude = $_REQUEST['longitude_out'];
$accuracy = $_REQUEST['accuracy_out'];
$geolocation = $latitude."+".$longitude;

include 'db_config.php';


$filepath = 'upload_photo/'.$eng_name.'/';
if (!is_dir($filepath)){
	if(!mkdir($filepath,755,true)){
		die("上傳資料夾不存在，並且創建失敗");
	}
}

if($_FILES['photo_out']['error']>0){
	echo "錯誤代碼".$_FILES['photo_out']['error']."<br>";
}
else{
	$str = date("Y-m-d;H_i_s");
	$full_path = $filepath.$str.".jpg";
	$do_work = file_exists($full_path);
	if($do_work)
	{
		echo "檔案已存在，勿重複上傳!";
	}
    else{
    	$result=move_uploaded_file($_FILES['photo_out']['tmp_name'],$filepath.date("Y-m-d;H_i_s").".jpg");
    	if($result){
    		$sql = "insert into record (name,state,notes,ip,photo_path,geolocation,accuracy) values ('$name','下班','$notes','$ip','$full_path','$geolocation','$accuracy')";
			mysqli_query($my_db,$sql);
			echo "<script>alert('打卡成功'); location.href ='clock-system.php'; </script>";
		}

		else {
			echo "<script>alert('打卡失敗，請重試!'); location.href ='clock-system.php'; </script>";
		}
    }

}

?>