<?php
include 'db_connect.php';
include 'header.php';

echo '<h3 style="text-align: right;">Hello '.$_SESSION['username'].'</h3><hr>';
$querySelectMovies = 'select movie_id, movie_name from movies';
$executeQuerySelectMovies = mysqli_query($connect_db_movie_review,$querySelectMovies)or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectMovies as $value){
    $movieId = $value['movie_id'];
    echo '<a href="movie_individual_page.php?mid='.$movieId.'">'.$value['movie_name'].'</a><br>';
}
?>