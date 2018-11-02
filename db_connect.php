<?php
$hostname = 'localhost';
$user= 'root';
$password= 'root';
$port= '8888';

$connect_db_movie_review = mysqli_connect($hostname, $user, $password);

//check connection
if (!$connect_db_movie_review){
	die('Connection failed');
}
//create database called db_movie_review
$create_db_movie_review = 'create database if not exists db_movie_review';
$query_to_create_db_movie_review = mysqli_query($connect_db_movie_review,$create_db_movie_review) or die(mysqli_error($connect_db_movie_review));

//use db_movie_review
$use_db_movie_review = 'use db_movie_review';
$query_to_use_db_movie_review = mysqli_query($connect_db_movie_review,$use_db_movie_review) or die($connect_db_movie_review);
?>