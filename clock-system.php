<?php session_start();
header('Content-Type: text/html; charset=utf8'); ?>
<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta content='600; url=index.html' http-equiv='refresh'>
		<title>打卡系統</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="css/bootstrap.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		

	</head>
	<body class="is-loading" onload="show_date();show_time()">
			<div id="wrapper" >

				<section id="main" style="color:black;min-height: 85vh" >


				    <form id="clock" runat="server" style="background-color: #495D7A;border-radius: 15px;width: 180px;margin: 0 auto">
						<div id = "show_date" style="color:white;font-size: 1.3em;"></div>
				        <div id = "show_time" style="color:white;font-size: 2.5em; display: inline"></div>
				        <div id = "show_second" style="color:white;font-size: 1.3em;display: inline"></div>
				    </form>
				    <hr />
				    <div style="text-align: left;">
				    
				    <?php
	
					if($_SESSION['eng_name'] != null)
					{
					        echo "你好&nbsp;".$_SESSION['eng_name'];
					}
					else
					{
					        echo  "<script>alert('您無權限觀看此頁面!'); location.href = 'index.html';</script>";
					}
					?>
				    </div>
				    <br>
				    <div style="min-height: 25vh">
					    <table class="table table-bordered" >
					      <thead>
						    <tr>
						      <th scope="col">狀態</th>
						      <th scope="col">時間</th>
						      <th scope="col">備註</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php
				    		$name = $_SESSION['name'];
				    		date_default_timezone_set("Asia/Taipei");
				    		$a = date('Y-m-d');//今天的開始時間
				    		$time = strtotime($a);
				    		$time = strtotime("-8 hours",$time);
				    		$a = date("Y-m-d H:i:s", $time);
				    		$b = date('Y-m-d');//今天的結束時間
				    		$time2 = strtotime($b);
				    		$time2 = strtotime("+16 hours",$time2);
				    		$b = date("Y-m-d H:i:s", $time2);
				    		
				    		include 'db_config.php';
				    		$sql = "SELECT * FROM record WHERE time > '$a' AND time < '$b' AND name = '$name' AND state='上班'";
				    		$result = mysqli_query($my_db,$sql);
				    		if (mysqli_num_rows($result) > 0){
				    			while ($row = mysqli_fetch_array($result)) {
				    				echo "<tr class='table-primary'>";
						    		echo "<td>".$row[2]."</td>";
						    		
						    		$taiwan_time = strtotime($row['3']);//將時間的字串形式轉成時間戳記
						    		$taiwan_time = strtotime("+8 hours",$taiwan_time);//加八小時
						    		$time = date("Y-m-d H:i:s", $taiwan_time);

						    		$time = substr($time, 11,8);
						    		echo "<td>".$time."</td>";
						    		echo "<td>".$row[4]."</td>";
						    		echo "</tr>";

				    			}
				    		}
				    	    ?>
				    	    <?php
				    		$name = $_SESSION['name'];
				    		date_default_timezone_set("Asia/Taipei");
				    		$a = date('Y-m-d');//今天的開始時間
				    		$b = date('Y-m-d',strtotime("+1 day"));//今天的結束時間
				    		include 'db_config.php';
				    		$sql = "SELECT * FROM record WHERE time > '$a' AND time < '$b' AND name = '$name' AND state='中途'";
				    		$result = mysqli_query($my_db,$sql);
				    		if (mysqli_num_rows($result) > 0){
				    			while ($row = mysqli_fetch_array($result)) {
				    				echo "<tr class='table-secondary'>";
						    		echo "<td>".$row[2]."</td>";

						    		$taiwan_time = strtotime($row['3']);//將時間的字串形式轉成時間戳記
						    		$taiwan_time = strtotime("+8 hours",$taiwan_time);//加八小時
						    		$time = date("Y-m-d H:i:s", $taiwan_time);
						    		$time = substr($time, 11,8);

						    		//$time = substr($row['3'], 11,8);
						    		echo "<td>".$time."</td>";
						    		echo "<td>".$row[4]."</td>";
						    		echo "</tr>";

				    			}
				    		}
				    	    ?>
				    	    <?php
				    		$name = $_SESSION['name'];
				    		date_default_timezone_set("Asia/Taipei");
				    		$a = date('Y-m-d');//今天的開始時間
				    		$b = date('Y-m-d',strtotime("+1 day"));//今天的結束時間
				    		include 'db_config.php';
				    		$sql = "SELECT * FROM record WHERE time > '$a' AND time < '$b' AND name = '$name' AND state='下班'";
				    		$result = mysqli_query($my_db,$sql);
				    		if (mysqli_num_rows($result) > 0){
				    			while ($row = mysqli_fetch_array($result)) {
				    				echo "<tr class='table-danger'>";
						    		echo "<td>".$row[2]."</td>";

						    		$taiwan_time = strtotime($row['3']);//將時間的字串形式轉成時間戳記
						    		$taiwan_time = strtotime("+8 hours",$taiwan_time);//加八小時
						    		$time = date("Y-m-d H:i:s", $taiwan_time);
						    		$time = substr($time, 11,8);

						    		//$time = substr($row['3'], 11,8);
						    		echo "<td>".$time."</td>";
						    		echo "<td>".$row[4]."</td>";
						    		echo "</tr>";

				    			}
				    		}
				    	    ?>
						  </tbody>
						</table>
					<div>
				    
				    <hr />

				    <div class="row">
				    	<div class="col-4" style="padding: 0 0 0 0" >
				    		
				    		<button type="button" class="btn btn-outline-primary" style="width:95px;height:95px; border-radius:99em; max-width: 98% ;" data-toggle="modal" data-target="#Modal_in">打卡上班</button>
				    	</div>
				    	<div class="col-4" style="padding: 0 0 0 0" >
				    		<button type="button" class="btn btn-outline-secondary" style="width:95px;height:95px; border-radius:99em; max-width: 98% ;" data-toggle="modal" data-target="#Modal_check">中途簽到</button>
				    	</div>
				    	<div class="col-4" style="padding: 0 0 0 0" >
				    		<button type="button" class="btn btn-outline-danger "  style="width:95px;height:95px; border-radius:99em; max-width: 98% ;" data-toggle="modal" data-target="#Modal_out">打卡下班</button>
				    	</div>
				    </div>
				    <br>
				    <div style="text-align: left;">
				    <?php
					include 'functions.php';
					$ip = get_ipaddress();
					$_SESSION['ip'] = $ip;
					//echo "IP位置&nbsp;$ip";
					?>
				    </div>
				    <!-- <table style='border:solid 1px blue;'>
					    <thead>
					      <tr><th>屬性</th><th>值</th>
					    </thead>
					    <tbody>
					      <tr>
					        <td>經度</td>
					        <td id="latitude"></td>
					      </tr>
					      <tr>
					        <td>緯度</td>
					        <td id="longitude"></td>
					      </tr>
					      <tr>
					        <td>精確度</td>
					        <td id="accuracy"></td>
					      </tr>
					      <tr>
					        <td>時間戳記</td>
					        <td id="timestamp"></td>
					      </tr>
					    </tbody>
					</table> -->

				</section>

				<footer id="footer">
					<ul class="copyright" >
						<li>&copy; GaryHsu</li><li>Design </li>
					</ul>
				</footer>
			</div>

			<!-- Modal_in -->
			<form name="UploadPage" method="post" enctype="multipart/form-data" action="upload_in.php">
				<div class="modal fade" id="Modal_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-body" >
				      	<div  style="color:#f783ac;">
				      		<p><i class="fas fa-camera fa-lg"></i>&nbsp;拍照:</p>

				      		<input type="file" name="photo_in" accept="image/*" capture="camera" required>
				      	</div>
				      	<br>
				      	<p style="color:#f783ac;"><i class="far fa-sticky-note fa-lg"></i>&nbsp;備註:</p>
				      	<input type="text" name="notes_in">
				      	<input type="hidden" name="latitude_in" id="latitude_in">
				      	<input type="hidden" name="longitude_in" id="longitude_in">
				      	<input type="hidden" name="accuracy_in" id="accuracy_in">
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">關閉</button>
				        <button type="submit" class="btn btn-primary">打卡上班</button>
				      </div>
				    </div>
				  </div>
				</div>
		    </form>


			<!-- Modal_check -->
			<form name="UploadPage1" method="post" enctype="multipart/form-data" action="upload_check.php">
				<div class="modal fade" id="Modal_check" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-body" >
				      	<div  style="color:#f783ac;">
				      		<p><i class="fas fa-camera fa-lg"></i>&nbsp;拍照:</p>
							<input type="file" name="photo_check" accept="image/*" capture="camera" required >

				      	</div>
				      	<br>
				      	<p style="color:#f783ac;"><i class="far fa-sticky-note fa-lg"></i>&nbsp;備註:</p>
				      	<input type="text" name="notes_check">
				      	<input type="hidden" name="latitude_check" id="latitude_check">
				      	<input type="hidden" name="longitude_check" id="longitude_check">
				      	<input type="hidden" name="accuracy_check" id="accuracy_check">
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">關閉</button>
				        <button type="submit" class="btn btn-secondary">中途簽到</button>
				      </div>
				    </div>
				  </div>
				</div>
			</form>

			<!-- Modal_out -->
			<form name="UploadPage2" method="post" enctype="multipart/form-data" action="upload_out.php">
				<div class="modal fade" id="Modal_out" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-body" >
				      	<div  style="color:#f783ac;">
				      		<p><i class="fas fa-camera fa-lg"></i>&nbsp;拍照:</p>
							<input type="file" name="photo_out" accept="image/*" capture="camera" required>

				      	</div>
				      	<br>
				      	<p style="color:#f783ac;"><i class="far fa-sticky-note fa-lg"></i>&nbsp;備註:</p>
				      	<input type="text" name="notes_out">
				      	<input type="hidden" name="latitude_out" id="latitude_out">
				      	<input type="hidden" name="longitude_out" id="longitude_out">
				      	<input type="hidden" name="accuracy_out" id="accuracy_out">
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">關閉</button>
				        <button type="submit" class="btn btn-danger">打卡下班</button>
				      </div>
				    </div>
				  </div>
				</div>
			</form>


	<script>
		if ('addEventListener' in window) {
			window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
			document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
		}
	</script>
	<!-- <script language="JavaScript" type="text/javascript">
	    function ShowTime()
	    {
	        var NowDate = new Date();
	        var d = NowDate.getDay();
	        var dayNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
	        document.getElementById('showbox').innerHTML = NowDate.toLocaleString() + '（' + dayNames[d] + '）';
	        setTimeout('ShowTime()', 1000);
	    }
	</script> -->
	<script language="JavaScript">
	function show_time(){
	　var NowDate=new Date();
	　var h=NowDate.getHours();
	　var m=NowDate.getUTCMinutes();
	　var s=NowDate.getSeconds();
	  m = checkTime(m);
      s = checkTime(s);　
	　document.getElementById('show_time').innerHTML = h+':'+m;
	  document.getElementById('show_second').innerHTML = ':'+s;
	　setTimeout('show_time()',1000);
	}
	function checkTime(i) {
	  if (i < 10) {
	    i = "0" + i;
	  }
	  return i;
	}
	function show_date(){
		var today = new Date();
		var y=today.getFullYear();
		var m=(today.getMonth()+1);
		//var m=('0'+(today.getMonth()+1)).slice(-2)
		var d=today.getDate();
		document.getElementById('show_date').innerHTML = y+'年'+m+'月'+d+'日';
	}
	</script>
	<!-- <script language="javascript">
				　var Today=new Date();
				　document.write(Today.getFullYear()+ "/" + (Today.getMonth()+1) + "/" + Today.getDate());
				</script> -->
	<script>
    if (navigator.geolocation) {
        var geo=navigator.geolocation;
        var option={
              enableAcuracy:false,
              maximumAge:0,
              timeout:600000
              };
        geo.getCurrentPosition(successCallback,
                               errorCallback,
                               option
                               );
        }
    else {alert("此瀏覽器不支援地理定位功能!");}
    function successCallback(position) {
      // document.getElementById("latitude").innerHTML = position.coords.latitude;
      // document.getElementById("longitude").innerHTML=position.coords.longitude;
      // document.getElementById("accuracy").innerHTML=position.coords.accuracy;
      // document.getElementById("timestamp").innerHTML=position.timestamp;
      document.getElementById("latitude_in").value = position.coords.latitude;
      document.getElementById("longitude_in").value = position.coords.longitude;
      document.getElementById("accuracy_in").value = position.coords.accuracy;
      document.getElementById("latitude_check").value = position.coords.latitude;
      document.getElementById("longitude_check").value = position.coords.longitude;
      document.getElementById("accuracy_check").value = position.coords.accuracy;
      document.getElementById("latitude_out").value = position.coords.latitude;
      document.getElementById("longitude_out").value = position.coords.longitude;
      document.getElementById("accuracy_out").value = position.coords.accuracy;
      }
    function errorCallback(error) {
      var errorTypes={
            0:"不明原因錯誤",
            1:"使用者拒絕提供位置資訊",
            2:"無法取得位置資訊",
            3:"位置查詢逾時"
            };
      alert(errorTypes[error.code]);
      alert("code=" + error.code + " " + error.message); //開發測試時用
      }
    </script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>

</html>