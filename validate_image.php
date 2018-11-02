<?php
include 'db_connect.php';

// image error handling
//make sure uploaded image is valid
if ($_FILES['image']['error'] != UPLOAD_ERR_OK){
    switch($_FILES['image']['error']){
        case UPLOAD_ERR_INI_SIZE:
            die('Uploaded file exceded the upload_max_filesize directive php.ini.');
            break;
        case UPLOAD_ERR_FORM_SIZE:
            die('Uploaded file exceeded MAX_FILE_SIZE directive that was specified in the form.');
            break;
        case UPLOAD_ERR_PARTIAL:
            die('The file is partially uploaded');
            break;
        case UPLOAD_ERR_NO_FILE:
            die('No file is uploaded');
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            die('The server is missing the temporary folder');
            break;
        case UPLOAD_ERR_CANT_WRITE:
            die('The server failed to write uploaded file to the disk');
            break;
        case UPLOAD_ERR_EXTENSION:
            die('Unsupported extension');
            break;
        default:
            break;
    }
}else{
    if(isset($_POST['submit'])){
        $imageDetails = $_FILES['image'];
        echo '<pre>';print_r($imageDetails);echo '</pre>';
        $imageFileName = $_FILES['image']['name'];
        $imageFiletype = $_FILES['image']['type'];
        $imagefileTmpName = $_FILES['image']['tmp_name'];
        $imageFileError = $_FILES['image']['error'];
        $imageFileSize = $_FILES['image']['size'];

        $imageExtract = explode('.', $imageFileName);
        echo '<pre>';print_r($imageExtract);echo '</pre>';

        $imageActualExt = strtolower(end($imageExtract));
        $imageExtAllowed = array('jpg','jpeg','png');

        //check if the uploaded image have valid extension

        if (in_array($imageActualExt,$imageExtAllowed)){
            if ($imageFileError ===0){
                if ($imageFileSize < 26214400){
                    $imageNewFileName = bin2hex(openssl_random_pseudo_bytes(5,$crypt_strong)).".".$imageActualExt;
                    $fileUploadDestination = 'image_web/'.$imageNewFileName;
                    move_uploaded_file($imagefileTmpName,$fileUploadDestination);
                    $uploadDate = date('H:i:s m.d.Y');
                    echo $uploadDate;
                }  else{
                    echo 'The size of the file greater than 25mb.';
                }
            } else{
                echo 'There is an error on uploading file...';
            }
        }else{
            echo 'Invalid image format!!!';
        }

    }
}