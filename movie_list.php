<?php
include 'db_connect.php';
include 'header.php';


$querySelectMovies = 'select movie_id, movie_name from movies';
$executeQuerySelectMovies = mysqli_query($connect_db_movie_review,$querySelectMovies)or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectMovies as $value){
    echo '<a href="movie_individual_page.php?movie_id=">'.$value['movie_name'].'</a><br>';
}
