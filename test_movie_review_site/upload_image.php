<?php
echo '
<html>
	<head>
		<title>
		Upload Your Image Here
		</title>
		<style type="text/css">
			td{
			vertical-align: top;
			}
		</style>
	</head>
	<body>
		<form action="check_image.php" method="post" enctype="multipart/form-data">
			<table>
				<tr><td>Your Username:</td><td><input type="text" name="image_username"></td></tr>
				<tr><td>Upload Image:</td><td><input type="file" name="uploadfile"></td></tr>
				<tr><td colspan="2"><small><pre>* Acceptable image formats includes: PNG, GIF, JPG/JPEG.</pre></small></td></tr>
				<tr><td>Image Caption</td><td><input type="text" name="image_caption"></td></tr>
				<tr><td colspan="2" style="text-align:center"><input type="submit" name="upload_image" value="Upload"></td></tr>
			</table>
		</form>
	</body>
</html>
';
?>