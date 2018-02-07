<!DOCTYPE HTML>
<html>
	<head>
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
				    echo ("星瑋你好:")
				    ?>

				    </div>
				    <br>
				    <div style="min-height: 25vh">
					    <table class="table table-bordered" >
						  
						  <tbody>
						    <tr class="table-primary">
						      <th scope="row">1</th>
						      <td>上班</td>
						      <td>10:28</td>
						      <td>@北大</td>
						    </tr>
						    <tr  class="table-secondary">
						      <th scope="row">2</th>
						      <td>中途</td>
						      <td>14:12</td>
						      <td>@海大</td>
						    </tr>
						    <tr class="table-secondary">
						      <th scope="row">3</th>
						      <td>中途</td>
						      <td>15:12</td>
						      <td>@清大</td>
						    </tr>
						    <tr class="table-danger">
						      <th scope="row">3</th>
						      <td>下班</td>
						      <td>19:12</td>
						      <td></td>
						    </tr>
						  </tbody>
						</table>
					</div>
				    
				    
				    <hr />

				    <div class="row">
				    	<div class="col-4" style="padding: 0 0 0 0" >
				    		
				    		<button type="button" class="btn btn-outline-primary" style="width:95px;height:95px; border-radius:99em; max-width: 98% ;" data-toggle="modal" data-target="#Modal_in">打卡上班</button>
				    	</div>
				    	<div class="col-4" style="padding: 0 0 0 0" >
				    		<button type="button" class="btn btn-outline-secondary" style="width:95px;height:95px; border-radius:99em; max-width: 98% ;" data-toggle="modal" data-target="#Modal_check">中途簽到</button>
				    	</div>
				    	<div class="col-4" style="padding: 0 0 0 0" >
				    		<button type="button" class="btn btn-danger " disabled style="width:95px;height:95px; border-radius:99em; max-width: 98% ;">打卡下班</button>
				    	</div>
				    </div>
				    <br>
				    <div style="text-align: left;">
				    <?php
					include 'functions.php';
					//date_default_timezone_set("Asia/Taipei");
					// $date = date('Y m/d');
					// $time = date('h:i:sa');
					// echo "$date&nbsp;&nbsp;\n";
					// echo "<h2>"."$time&nbsp;&nbsp;\n"."</h2>";
					$connecting_ip = get_ipaddress();
					echo "IP位置&nbsp;$connecting_ip";
					?>
				    </div>
				    <!-- <a style="width:85px;" class="btn" href="register.php">註冊帳號</a> -->
				</section>

				<footer id="footer">
					<ul class="copyright" >
						<li>&copy; GaryHsu</li><li>Design </li>
					</ul>
				</footer>
			</div>

			<!-- Modal_in -->
			<div class="modal fade" id="Modal_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <!-- <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">打卡上班</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div> -->
			      <div class="modal-body" >
			      	<div  style="color:#f783ac;">
			      		<p><i class="fas fa-camera fa-lg"></i>&nbsp;拍照:</p>

			      		<input type="file" accept="image/*" capture="camera" >
			      	</div>
			      	<br>
			      	<p style="color:#f783ac;"><i class="far fa-sticky-note fa-lg"></i>&nbsp;備註:</p>
			      	<input type="text">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">關閉</button>
			        <button type="button" class="btn btn-primary">打卡上班</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Modal_check -->
			<div class="modal fade" id="Modal_check" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-body" >
			      	<div  style="color:#f783ac;">
			      		<p><i class="fas fa-camera fa-lg"></i>&nbsp;拍照:</p>
						<input type = "file" accept= "image/*" capture= "camera" id= "img" />

			      	</div>
			      	<br>
			      	<p style="color:#f783ac;"><i class="far fa-sticky-note fa-lg"></i>&nbsp;備註:</p>
			      	<input type="text">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">關閉</button>
			        <button type="button" class="btn btn-secondary">中途簽到</button>
			      </div>
			    </div>
			  </div>
			</div>


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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>

</html>