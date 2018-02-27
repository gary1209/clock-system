<!DOCTYPE HTML>
<html>
	<head>
		<title>新成員加入!</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">
			<div id="wrapper">
					<section id="main">
						<h2>新成員加入!</h2><br>
						<hr />
						<!-- <span class="avatar"><img src="images/avatar.jpg" alt="" /></span> -->
						<form method="post" action="register_finish.php">
						  <label for="inputName" class="sr-only">Name</label>
						  <input type="text" name="name" id="inputName" class="form-control" placeholder="中文名字" required autofocus><br>
						  <label for="inputEnglish" class="sr-only">English Name</label>
						  <input type="text" name="eng_name" id="inputEnglish" class="form-control" placeholder="English Name" required ><br>
						  <label for="inputEmail" class="sr-only">Email</label>
						  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required ><br>
						  <label for="inputPassword" class="sr-only">Password</label>
						  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required><br>
						  <input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="repeat your Password" required><br>
						  <div class="field">
							<input type="checkbox" id="human" name="human" /><label for="human">I'm not a robot</label>
						  </div>
						  <button style="width:85px;font-size: 14px;" class="btn" type="submit">註冊</button>
						</form>
						<hr />
					</section>
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; GaryHsu</li><li>Design </li>
						</ul>
					</footer>

			</div>
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>
	</body>
</html>