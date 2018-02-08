<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	



<!-- Modal_in -->
			<form name="UploadPage" method="post" enctype="multipart/form-data" action="upload_in.php">
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

				      		<input type="file" name="photo_in" accept="image/*" capture="camera" >
				      	</div>
				      	<br>
				      	<p style="color:#f783ac;"><i class="far fa-sticky-note fa-lg"></i>&nbsp;備註:</p>
				      	<input type="text">
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">關閉</button>
				        <button type="submit" class="btn btn-primary">打卡上班</button>
				      </div>
				    </div>
				  </div>
				</div>
		    </form>

</body>
</html>
