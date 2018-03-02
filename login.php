<?php session_start(); ?>

<?php

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

if ($email == '' || $password == ''){  // 沒登入就想進來，重新導回登入頁面
	header('Location: index.html');
}
else{  // 合法登入
	// $my_link = mysqli_connect("127.0.0.1","root","0");
	// mysqli_select_db($my_link,"hw3");
	include("db_config.php");
	//搜尋資料庫資料
	$sql = "SELECT name,eng_name,email,password,status FROM user where email = '$email'";
	$result = mysqli_query($my_db,$sql);
	$row = @mysqli_fetch_array($result);
	
	//判斷MySQL資料庫裡是否有這個會員
	//status==1 是一般使用者
	//status==0 是管理者
	if($row['email'] == $email && $row['password'] == $password &&$row['status']==1){
	        //將帳號寫入session，方便驗證使用者身份
	        $_SESSION['name'] = $row['name'];
	        $_SESSION['eng_name'] = $row['eng_name'];
	        
	        header('Location: clock-system.php');
	}
	else if($row['email'] == $email && $row['password'] == $password &&$row['status']==0){
			$_SESSION['name'] = $row['name'];
			$_SESSION['eng_name'] = $row['eng_name'];
			//echo $_SESSION['name']."<br>管理者頁面興建中";
			header('Location: admin.php');
	}
	else
	{
	        echo "<script>alert('帳號密碼不符，請重新登入'); location.href = 'index.html';</script>";
	        //echo '登入失敗，請重新登入';
	        //echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
	}
}

?>