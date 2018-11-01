<?php
include 'db_connect.php';
include 'header.php';


$querySelectMovies = 'select movie_id from movies';
$executeQuerySelectMovies = mysqli_query($connect_db_movie_review,$querySelectMovies)or die(mysqli_error($connect_db_movie_review));
$numberOfRows = mysqli_num_rows($executeQuerySelectMovies);
print_r($numberOfRows);
for ($i=1; $i<=$numberOfRows;$i++){

}
?>
