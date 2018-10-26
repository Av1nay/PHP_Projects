<?php
include 'db_ch03-1.php';

//alter the movie table to include running time,cost and taking fields

/*$query = 'alter table movie add column (
                                      movie_running_time int null,
                                      movie_cost decimal(4,1) null ,
                                      movie_takings decimal (4,1) null )';
mysqli_query($conn,$query) or die(mysqli_error($conn));
*/


//insert new data into movie table for each movie

$query = 'update movie set movie_running_time = 101,
                          movie_cost = 81,
                          movie_takings = 242.6
                          where movie_id=1';
mysqli_query($conn, $query) or die(mysqli_error($conn));


$query = 'update movie set movie_running_time = 89,
                          movie_cost = 10,
                          movie_takings = 10.8
                          where movie_id=2';
mysqli_query($conn, $query) or die(mysqli_error($conn));


$query = 'update movie set movie_running_time = 134,
                          movie_cost = null ,
                          movie_takings = 33.2
                          where movie_id=3';
mysqli_query($conn, $query) or die(mysqli_error($conn));
echo 'Movie database updated successfully';
exit();
?>