<?php
include 'db_ch03-1.php';


if (!isset($_GET['do'])|| $_GET['do'] !=1){
	switch ($_GET['type']){
		case 'movie':
			echo 'Are you sure you want to delete this movie?<br>';
			break;
		case 'people':
			echo 'Are you sure you want to delete this person?<br> ';
	}
	echo '<a href="'.$_SERVER['REQUEST_URI'].'&do=1">YES</a> or <br> <a href="admin.php">no</a>';
}else {
	switch ($_GET['type']){
		case 'people':
			$update_movie_query = 'UPDATE movie set movie_leadactor = 0 where movie_leadactor ='.$_GET['id'];
			$update_movie_result = mysqli_query($conn,$update_movie_query) or die(mysqli_error($conn));

		    echo '<p style ="text-align: center;">Your person has been deleted.
		    <a href="movie_index.php">Return to Index</a></p>';
			break;
		case 'movie':
			$delete_from_movie_query = 'delete from movie where movie_id = '. $_GET['id'];
			$delete_from_movie_result = mysqli_query($conn, $delete_from_movie_query) or die(mysqli_error($conn));
			echo '<p style ="text-align: center;">Your movie has been deleted.
			<a href="movie_index.php">Return to Index</a></p>';
			break;
	}

}

?>