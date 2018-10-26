<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include 'db_ch03-1.php';
?>
<html>
<head>
	<title>Commit</title>
</head>
<body>
<?php
$query_to_add_people ='';
	switch ($_GET['action']) {
		case 'add':
			switch ( $_GET['type'] ) {
				case 'movie':
					$query_to_add_movie = 'insert into movie (movie_name, movie_year, movie_type, movie_leadactor, movie_director) 
                                        values ("' . $_POST['movie_name'] . '",
                                                ' . $_POST['movie_year'] . ',
                                                ' . $_POST['movie_type'] . ',
                                                ' . $_POST['movie_leadactor'] . ',
                                                ' . $_POST['movie_director'] . ')';
					break;
				case 'people':
					$people_name_to_locase = strtolower( $_POST['people_is_actor_or_director'] );
					echo $_POST['people_fullname'] . ' is ' . $_POST['people_is_actor_or_director'] . '<br>';
					switch ( $people_name_to_locase ) {
						case 'actor':
							$query_to_add_people = 'insert into people (people_fullname,people_is_actor,people_is_director)
                                              values("' . $_POST['people_fullname'] . '",1,0)';
							break;
						case 'director':
							$query_to_add_people = 'insert into people (people_fullname,people_is_actor,people_is_director)
                                              values("' . $_POST['people_fullname'] . '",0,1)';
							break;
						default:
							break;
					}
					break;
			}
			if ( isset( $query_to_add_movie ) && ! empty( $query_to_add_movie ) ) {
				$adding_movie_result = mysqli_query( $conn, $query_to_add_movie ) or die( $conn );
				echo '<p>Inserted new row of movie!</p>';
			} else if ( isset( $query_to_add_people ) && ! empty( $query_to_add_people ) ) {
				$adding_people_result = mysqli_query( $conn, $query_to_add_people ) or die( $conn );
				echo '<p>Inserted new row of people!</p>';
			} else {
				echo '<p>Failed to insert!</p>';
			}
		case 'edit':
			switch ( $_GET['type'] ) {
				case 'movie':
					$query_update_movie = 'update movie set 
                                          movie_name="' . $_POST['movie_name'] . '",
                                          movie_year="' . $_POST['movie_year'] . '",
                                          movie_type="' . $_POST['movie_type'] . '",
                                          movie_leadactor="' . $_POST['movie_leadactor'] . '",
                                          movie_director="' . $_POST['movie_director'] . '"
                                          where movie_id=' . $_POST['movie_id'] . '
                                          ';
					break;
				case 'people':
					$people_name_to_locase = strtolower( $_POST['people_is_actor_or_director'] );
					switch ( $people_name_to_locase ) {
						case 'actor':
							$query_to_update_people = 'update people set 
                                                                    people_fullname = "' . $_POST['people_fullname'] . '",
                                                                    people_is_actor = 1,
                                                                    people_is_director = 0
                                                                    where people_id ='.$_POST['people_id'].'
                                                                    ';
							break;
						case 'director':
							$query_to_update_people = 'update people set 
                                                                    people_fullname = "' . $_POST['peple_fullname'] . '",
                                                                    people_is_actor = 0,
                                                                    people_is_director = 1
                                                                    where people_id ='.$_POST['people_id'].'
                                                                    ';
					}
					break;
				default:
					break;
			}

			if ( isset( $query_update_movie ) && ! empty( $query_update_movie ) ) {
				$updating_movie_result = mysqli_query( $conn, $query_update_movie ) or die( mysqli_error( $conn ) );
				echo '<p>movie updated!</p>';
			} else if ( isset( $query_to_update_people ) && ! empty( $query_to_update_people ) ) {
				$updating_people_result = mysqli_query( $conn, $query_to_update_people ) or die( mysqli_error( $conn ) );
				echo '<p>people updated!</p>';
			} else {
				echo '<p>Failed to Update!</p>';
			}

	}
?>
</body>
</html>
