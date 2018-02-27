<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("db_config.php");

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$password2 = $_REQUEST["password2"];
$name = $_REQUEST['name'];
$eng_name = $_REQUEST['eng_name'];

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($email != null && $password != null && $password2 != null && $password == $password2){
        //新增資料進資料庫語法
        $sql = "insert into user (name,eng_name,email,password) values ('$name','$eng_name','$email', '$password')";
        if(mysqli_query($my_db,$sql)){
                echo '新增成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
        }
        else{
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
        }
}
else{
        echo "<script>alert('資料有誤，請重新註冊!'); location.href = 'register.php';</script>";
}
?>