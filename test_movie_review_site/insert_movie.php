<?php
include 'db_ch03-1.php';

//create table movies
$insert_query_into_movie = 'INSERT INTO movie
			(movie_name, movie_type, movie_year, movie_leadactor, movie_director)
			VALUES 
			("Bruce Almighty",5,2003,1,2),
			("Office Space",5,1995,5,6),
			("Grand Canyon",2,1991,4,3)
			';
mysqli_query($conn, $insert_query_into_movie) or die(mysqli_error($conn));

header("Location: select_movie.php");
?>