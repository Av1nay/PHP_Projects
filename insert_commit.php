<?php
session_start();
include 'db_connect.php'; 

if(!empty($_POST)) {
	switch ( isset( $_POST ) ) {
		//insert genre
		case ( isset( $_POST["movietype"] ) ):
			$insert_movitypes_in_movietype_table_query = 'insert into movietype(movietype_label) values ("' . $_POST['movietype'] . '")';
			$execute_insert_movitypes_in_movietype_table = mysqli_query( $connect_db_movie_review, $insert_movitypes_in_movietype_table_query ) or die( $connect_db_movie_review );
			echo 'Inserted and added new row!!';
			header( 'Refresh:2; URL=insert_form_movietype.php' );
			break;
//-------------------------------------------------------------------------------------------------------------------------
		//insert people actor or director
		case ( isset( $_POST['actor_or_director'] ) ):
			$post_count_actor_or_director = count( $_POST['actor_or_director'] );
			if ( $post_count_actor_or_director == 1 ) {
				$array_actor_or_director = $_POST['actor_or_director'];
				switch ( $array_actor_or_director[0] ) {

					//insert actor
					case 'actor_checkbox':
						$insert_people_query         = 'insert into people (people_fullname, people_is_actor)
																values (
																"' . $_POST['fullname'] . '",1
																)';
						$execute_insert_people_query = mysqli_query( $connect_db_movie_review, $insert_people_query );
						echo 'Inserted new row';
						break;

						//insert director
					case 'director_checkbox':
						$insert_people_query         = 'insert into people(people_fullname, people_is_director) 
																values (
																"' . $_POST['fullname'] . '",1
																)';
						$execute_insert_people_query = mysqli_query( $connect_db_movie_review, $insert_people_query );
						echo 'Inserted new row';
						break;
					default:
						break;
				}
			} else {
				$insert_people_query         = 'insert into people (people_fullname, people_is_actor, people_is_director)
																values (
																"' . $_POST['fullname'] . '",1,1
																)';
				$execute_insert_people_query = mysqli_query( $connect_db_movie_review, $insert_people_query );
				echo 'Inserted new row';
			}
			header( 'Refresh:2; URL= insert_in_people_form.php' );
			break;
//-------------------------------------------------------------------------------------------------------------------------
		//insert moviename
		case ( isset( $_POST['moviename'] ) ):
			$movie_name = $_POST['moviename'];
			$genre=$_POST['genre'];
			$year = $_POST['year'];
			if(isset($_POST['running_time'])){
                $movie_running_time = explode(':',$_POST['running_time']);
                $time_in_minutes = $movie_running_time[0]*60+$movie_running_time[1];
            }else{
			    echo 'Set running time of the movie';
            }

			$actor = ($_POST['actor'] !== 'actor_value')? $_POST['actor'] : 0;
            $director = ($_POST['director'] !== 'director_value') ? $_POST['director'] : 0;
            if(isset($_POST['submit'])){
                $query_to_insert_movies = 'insert into movies (movie_name,movie_type,movie_year,movie_actor, movie_director,movie_running_time)
										values ("'.$movie_name.'",'.$genre.','.$year.','.$actor.','.$director.','.$time_in_minutes.')';
            }else{
                $query_to_insert_movies = 'update movies
										set movie_name = "'.$movie_name.'", movie_type = '.$genre.',movie_year = '.$year.', movie_actor = '.$actor.',movie_director = '.$director.',movie_running_time = '.$time_in_minutes.' where movie_id='.$_GET['mid'].'';
            }
			$executes_query_to_insert_movies = mysqli_query($connect_db_movie_review,$query_to_insert_movies) or die(mysqli_error($connect_db_movie_review));
            $last_insert_movie_id = mysqli_insert_id($connect_db_movie_review);

// inserting movie image cover

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
                    $imageFileName = $_FILES['image']['name'];
                    $imageFiletype = $_FILES['image']['type'];
                    $imagefileTmpName = $_FILES['image']['tmp_name'];
                    $imageFileError = $_FILES['image']['error'];
                    $imageFileSize = $_FILES['image']['size'];

                    $imageExtract = explode('.', $imageFileName);

                    $imageActualExt = strtolower(end($imageExtract));
                    $imageExtAllowed = array('jpg','jpeg','png');

                    //check if the uploaded image have valid extension

                    if (in_array($imageActualExt,$imageExtAllowed)){
                        if ($imageFileError ===0){
                            if ($imageFileSize < 26214400){
                                $imageNewFileName = bin2hex(openssl_random_pseudo_bytes(5,$crypt_strong)).".".$imageActualExt;
                                $fileUploadDestination = 'image_web/'.$imageNewFileName;
                                move_uploaded_file($imagefileTmpName,$fileUploadDestination);
                                $uploadDate = date('Y-m-d H:i:s');
                                $query_select_user= 'select user_id from user_details where username="'.$_SESSION['username'].'"';
                                $execute_query_select_user = mysqli_query($connect_db_movie_review,$query_select_user)or die(mysqli_error($connect_db_movie_review));
                                foreach ($execute_query_select_user as $value){
                                    $user_id = $value['user_id'];
                                }
                                $query_insert_movie_cover = 'insert into images(movie_id,image_caption,image_filename,image_upload_date,image_uploader) 
                                                                            values('.$last_insert_movie_id.',"movie_cover_image","'.$imageNewFileName.'","'.$uploadDate.'",'.$user_id.')';
                                $execute_insert_movie_cover = mysqli_query($connect_db_movie_review,$query_insert_movie_cover) or die(mysqli_error($connect_db_movie_review));
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
			echo ucfirst(isset($_POST['update']) ? 'updated successfully inserted!!' : 'new row inserted successfully');
			isset($_POST['update']) ? header('Refresh:2; URL=movie_list.php') : header( 'Refresh:2; URL= inserting_data_in_movies_table.php' );
            break;
//-------------------------------------------------------------------------------------------------------------------------
		//insert users
		case (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['comfirm_password'])):
			if ($_POST['password'] == $_POST['comfirm_password']) {
                    $query_insert_user_details = 'insert into user_details (fullname, username,password)
																values ("' . $_POST['fullname'] . '","' . $_POST['username'] . '","' . password_hash($_POST['password'],PASSWORD_DEFAULT) . '")';
                    $executes_query_insert_user_details = mysqli_query( $connect_db_movie_review, $query_insert_user_details ) or die( mysqli_error( $connect_db_movie_review ) );
                    if(!empty($_FILES['image']) && isset($_FILES['image'])){
                        $last_insert_user_id = mysqli_insert_id($connect_db_movie_review);
                        //---------------------------------------------------------------------------------------------------------------

                        // check image validation

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
                                $imageFileName = $_FILES['image']['name'];
                                $imageFiletype = $_FILES['image']['type'];
                                $imagefileTmpName = $_FILES['image']['tmp_name'];
                                $imageFileError = $_FILES['image']['error'];
                                $imageFileSize = $_FILES['image']['size'];

                                $imageExtract = explode('.', $imageFileName);

                                $imageActualExt = strtolower(end($imageExtract));
                                $imageExtAllowed = array('jpg','jpeg','png');

                                //check if the uploaded image have valid extension

                                if (in_array($imageActualExt,$imageExtAllowed)){
                                    if ($imageFileError ===0){
                                        if ($imageFileSize < 26214400){
                                            $imageNewFileName = bin2hex(openssl_random_pseudo_bytes(5,$crypt_strong)).".".$imageActualExt;
                                            $fileUploadDestination = 'image_web/'.$imageNewFileName;
                                            move_uploaded_file($imagefileTmpName,$fileUploadDestination);
                                            $uploadDate = date('Y-m-d H:i:s');
                                            $imageCaption = 'Profile image of '.$last_insert_user_id;
                                            $query_insert_profile_image = 'insert into images(user_id, image_filename,image_upload_date,image_caption,image_uploader)
                                                                                          values ('.$last_insert_user_id.',"'.$imageNewFileName.'","'.$uploadDate.'","'.$imageCaption.'",'.$last_insert_user_id.')';
                                            $execute_query_insert_profile_image = mysqli_query($connect_db_movie_review,$query_insert_profile_image) or die($connect_db_movie_review);
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
                    }
                    echo 'created successfully!!';
                   header( 'Refresh:3; URL=login_page.php' );
			}else{
				echo 'Password do not match!!!';
            }
            break;
//-------------------------------------------------------------------------------------------------------------------------
		//comparing username and password to login
        case (isset($_POST['compare_username']) && isset($_POST['compare_password'])):
			$query_select_user = 'select username from user_details where username="'.$_POST['compare_username'].'"';
            $execute_query_select_user = mysqli_query($connect_db_movie_review,$query_select_user);
            $noOfRows = $execute_query_select_user ->num_rows;
            if($noOfRows !== 0){
                foreach ($execute_query_select_user as $value) {
                    $user_from_table  = $value['username'];
                    if($_POST['comapre_username'] == $user_from_table){
                        $query_select_user_pass = 'select password from user_details where username="'. $user_from_table.'"';
                        $execute_query_select_user_pass = mysqli_query($connect_db_movie_review,$query_select_user_pass);
                        foreach ($execute_query_select_user_pass as $value){
                            $user_pass = $value['password'];
                            if (password_verify($_POST['compare_password'],$user_pass)){
                                $_SESSION['userpass']= $user_pass;
                                $_SESSION['username']= $user_from_table;
                                echo 'Successfully Logged in!!';
                                if ($_SESSION['username'] == 'admin'){
                                    header( 'Refresh:2; URL=admin_firstpage.php' );
                                }else{
                                    header('Refresh:2; URL=movie_list.php');
                                }
    
                            } else {
                                echo 'Username or Password provided is incorrect!!';
                                die();
                            }
                       } 
                    }else{
                        echo 'User or password is incorrect';
                    }
                }
            }else{
                echo 'No user, create new user from the link provided ---> <a href="create_user.php">CREATE USER</a>';
            }
			break;
		default:
			echo 'Failed to execute';
			break;
	}
}else{
	echo 'Fill the required field!!!';
}
?>