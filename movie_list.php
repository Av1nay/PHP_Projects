<?php
session_start();
include 'db_connect.php';
include 'header.php';

echo '<h3 style="text-align: right;">Hello '.$_SESSION['username'].'</h3><hr>';
echo '<table>';
$querySelectMovies = 'select movie_id, movie_name from movies';
$executeQuerySelectMovies = mysqli_query($connect_db_movie_review,$querySelectMovies)or die(mysqli_error($connect_db_movie_review));
while ($row = mysqli_fetch_assoc($executeQuerySelectMovies)){
    $movieId =$row['movie_id'];
    if($_SESSION['username'] == 'admin'){
        echo '<tr><td><a href="movie_individual_page.php?mid='.$movieId.'">'.ucwords($row['movie_name']).'</a></td>
        <td><a href="#">[EDIT]</a></td><td><a href="#">[DELETE]</a></td>
        </tr>';
    }else{
        echo '<tr><td><a href="movie_individual_page.php?mid='.$movieId.'">'.ucwords($row['movie_name']).'</a><td></tr>';
    }
    
}
echo '</table>';
?>