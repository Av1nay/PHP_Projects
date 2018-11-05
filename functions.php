<?php
session_start();
include 'db_connect.php';

function generateRatings($ratings){
    $movieRatings ='';
    for ($i=1; $i<=$ratings; $i++){
        $movieRatings .= '<img src="./images/star.png" alt="star">';
    }
    return $movieRatings;

}
function getComments($connect_db_movie_review){
    $selectComments = 'select * from reviews where movie_id'
}