<?php //include("index.html") ?>
<script src="js/Photo-Compression.0.0.1.min.js"></script>
<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
<p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file" ><input type="submit" value="Upload">
        </form>
    </body>
</html>
<h2>请选择文件</h2>
		<input id="imgFile" type="file" accept="image/*" placeholder="请选择文件" />
		<br />
		<br />
		<img id="img" src=""/>

		<script>
		var imgFile = document.getElementById('imgFile');
		var img = document.getElementById('img');
		imgFile.onchange = function() {
			var file = this.files[0];
			compressImage(file, function(data) {
				alert('压缩完毕');
				console.log(data);
				img.src=data;
			}, {
				maxWidth: 640, //最大宽度（可选参数，数值）
				maxHeight: 1008, //最大高度（可选参数，数值）
				quality: 0.8, //质量（可选参数，数值，0~1）
				scale: 1, //缩放率（可选参数，数值）
			});
		}
	</script>