<?php
include 'db_ch03-1.php';


//change path to match image directory
$image_directory='./images';

//make sure the upload file transfer is successful
if($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK){
	switch ($_FILES['uploadfile']['error']){
		case UPLOAD_ERR_INI_SIZE:
			die('The uploaded file exceeded the upload_max_filesize directive php.ini.');
			break;
		case UPLOAD_ERR_FORM_SIZE:
			die('The upload file exceeded the MAX_FILE_SIZE directive that was specified in the form.');
			break;
		case UPLOAD_ERR_PARTIAL:
			die('The file was only partially uploaded.');
			break;
		case UPLOAD_ERR_NO_FILE:
			die('No file was uploaded.');
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			die('The server is missing the temporary folder.');
			break;
		case UPLOAD_ERR_CANT_WRITE:
			die('The server failed to write uploaded file to the disk.');
			break;
		case UPLOAD_ERR_EXTENSION:
			die('File upload stopprd by extension.');
			break;
		default:
			break;
	}
}


//get info about the file being uploaded
$image_caption= $_POST['image_caption'];
$image_username= $_POST['image_username'];
$image_upload_date=date('Y-m-d');
list($width, $height, $image_type, $attr)= getimagesize($_FILES['uploadfile']['tmp_name']);
$format_error ='The file you uploaded is not supported filetype.';

//check if the uploaded image is a supported image
switch ($image_type){
	case IMAGETYPE_GIF:
		$create_image= imagecreatefromgif($_FILES['uploadfile']['tmp_name']) or die($format_error);
		$extension = '.gif';
		break;
	case IMAGETYPE_JPEG:
		$create_image= imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']) or die($format_error);
		$extension='.jpeg';
		break;
	case IMAGETYPE_PNG:
		$create_image= imagecreatefrompng($_FILES['uploadfile']['tmp_name']) or die($format_error);
		$extension='.png';
		break;
	default:
		die($format_error);
		break;
}



//insert information into image table
$query_to_insert_image = 'insert into image(image_caption, image_username, image_upload_date)
							values ("'.$image_caption.'","'.$image_username.'","'.$image_upload_date.'")';
$result_query_to_insert_image = mysqli_query($conn,$query_to_insert_image) or die(mysqli_error($conn));
//retrieve the image_id that mysql generated automatically when we inserted the new record
$last_inserted_image_id = mysqli_insert_id($conn);

//because the id is unique, we can use it as the image name as well to make sure we don't overwrite another image that is already exists
$imagename = $last_inserted_image_id.$extension;
//update the image table now that the final filename is known
$query_to_update_image_filename='update image set image_filename="'.$imagename.'" where image_id ='.$last_inserted_image_id;

$result_query_to_update_image_filename=mysqli_query($conn,$query_to_update_image_filename) or die(mysqli_error($conn));

//save the image to its final destination
switch ($image_type){
	case IMAGETYPE_GIF:
		imagegif($create_image,$image_directory.'/'.$imagename);
		break;
	case IMAGETYPE_JPEG:
		imagejpeg($create_image,$image_directory.'/'.$imagename);
		break;
	case IMAGETYPE_PNG:
		imagepng($create_image,$image_directory.'/'.$imagename);
		break;
	default:
		break;
}
imagedestroy($create_image);
?>
<html>
	<head>
		<title>Uploaded Picture</title>
	</head>
	<body>
		<h1>Uploaded Pictures</h1>
		<p>Here is the pictures that you have uploaded to our server.</p>
		<img src="images/<?php echo $imagename ;?>" alt="imagename" style="float: left;">
		<table>
			<tr>
				<tb>Image Saved as:</tb><tb><?php echo $imagename;?></tb>
			</tr>
			<tr><td>Image Type: </td><td><?php echo $extension;?></td></tr>
			<tr><td>Hight:</td><td><?php echo $height;?></td></tr>
			<tr><td>Width:</td><td><?php echo $width;?></td></tr>
			<tr><td>Upload Date:</td><td><?php echo $image_upload_date;?></td></tr>
		</table>
	</body>
</html>
