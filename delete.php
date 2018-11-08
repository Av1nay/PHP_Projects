<?php 
session_start();
    require 'db_connect.php';
    include 'header.php';

    if($_GET['type']== 'delete'){
        $deleteMovies = 'delete from movies where movie_id='.$_GET['mid'];
        $executeDeleteMovies = mysqli_query($connect_db_movie_review,$deleteMovies)or die(mysqli_error($connect_db_movie_review));
        echo ucfirst('selected movie is deleted');
    } 
?>
