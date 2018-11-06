<?php 
session_start();
    require 'db_connect.php';
    include 'header.php';


    switch(isset($_GET['type'])){
        case 'edit':
        $selectMovies = 'select * from movies where movie_id='.$_GET['mid'];
        $resultSelectMovies = mysqli_query($connect_db_movie_review, $selectMovies);
        while($row = $resultSelectMovies){

        }
        $updateMovies = 'update movies';
    }
?>