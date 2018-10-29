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

			$movie_running_time = explode(':',$_POST['running_time']);
			$time_in_minutes = $movie_running_time[0]*60+$movie_running_time[1];

			$actor = ($_POST['actor'] !== 'actor_value')? $_POST['actor'] : 0;
			$director = ($_POST['director'] !== 'director_value') ? $_POST['director'] : 0;
			$query_to_insert_movies = 'insert into movies (movie_name,movie_type,movie_year,movie_actor, movie_director,movie_running_time)
										values ("'.$movie_name.'",'.$genre.','.$year.','.$actor.','.$director.','.$time_in_minutes.')';
			$executes_query_to_insert_movies = mysqli_query($connect_db_movie_review,$query_to_insert_movies) or die(mysqli_error($connect_db_movie_review));
			echo ucfirst('new row successfully inserted!!');
			header( 'Refresh:2; URL= inserting_data_in_movies_table.php' );
			break;
//-------------------------------------------------------------------------------------------------------------------------
		//insert users
		case (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['comfirm_password'])):
			if ($_POST['password'] == $_POST['comfirm_password']) {
                    $query_insert_user_details = 'insert into user_details (fullname, username,password)
																values ("' . $_POST['fullname'] . '","' . $_POST['username'] . '","' . password_hash($_POST['password'],PASSWORD_DEFAULT) . '")';$executes_query_insert_user_details = mysqli_query( $connect_db_movie_review, $query_insert_user_details ) or die( mysqli_error( $connect_db_movie_review ) );
                    if(!empty($_POST['image']) && isset($_POST['image'])){
                        $last_insert_user_id = mysqli_insert_id($connect_db_movie_review);

                        //---------------------------------------------------------------------------------------------------------------

                        // check image validation



                        $queryInsertUserProfileImage = 'insert into image (user_id, image_filename, image_upload_date, image_caption) 
                                                                    values('.$last_insert_user_id.','')'
                        $insert_user_profile_image =
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
			foreach ($execute_query_select_user as $value) {
				$user_from_table  = $value['username'];
				$query_select_user_pass = 'select password from user_details where username="'. $user_from_table.'"';
				$execute_query_select_user_pass = mysqli_query($connect_db_movie_review,$query_select_user_pass);
				foreach ($execute_query_select_user_pass as $value){
					$user_pass = $value['password'];
					if (password_verify($_POST['compare_password'],$user_pass)){
						$_SESSION['userpass']= $user_pass;
						$_SESSION['username']= $user_from_table;
						echo 'Successfully Logged in!!';
						if ($_SESSION['username'] == 'admin'){
							header( 'Refresh:2; URL=inserting_data_in_movies_table.php' );
						}else{
							header('Refresh:2; URL=firstpage.php');
						}

					} else {
						echo 'Username or Password provided is incorrect!!';
						die();
					}
				}
			}
			break;
		default:
			echo 'Failed to insert';
			break;
	}
}else{
	echo 'Fill the required field!!!';
}
?>