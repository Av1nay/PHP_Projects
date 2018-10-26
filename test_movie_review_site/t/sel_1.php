<?php
include 'connect.ini.php';



$usedb = mysqli_query($conn, 'use movies') or die();



//select the movie titles and their genre after 1990

$query = 'SELECT movie.movie_name, movietype.movietype_label 
			FROM movie, movietype 
			WHERE MOVIES '
?>

