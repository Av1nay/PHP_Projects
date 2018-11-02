<?php
include 'db_connect.php';
//connection via $connect_db_movie_review
//create movies table
$create_movies_query = 'create table if not exists movies(
															movie_id int(5) not null primary key auto_increment,
															movie_name varchar(255) not null unique,
															movie_type int(5) not null,
															movie_year year,
															movie_actor int(5),
															movie_director int(5),
															movie_running_time varchar(30),
															movie_cost varchar(255) default 0,
															movie_earning varchar(255) default 0,
															movie_profit varchar(255) default 0
															)';
$execute_create_movies_query = mysqli_query($connect_db_movie_review,$create_movies_query) or die($connect_db_movie_review);
//create movietype table
$create_movietype_query = 'create table if not exists movietype (
																	movietype_id int(5) not null primary key auto_increment,
																	movietype_label varchar(255) not null unique
																	)';
$execute_create_movietype_query = mysqli_query($connect_db_movie_review,$create_movietype_query) or die($connect_db_movie_review);
//create people table
$create_people_query = 'create table if not exists people(
															people_id int(5) not null primary key auto_increment,
															people_fullname varchar(255) not null unique,
															people_is_actor int(1) default 0,
															people_is_director int(1) default 0
															)';
$execute_create_people_query = mysqli_query($connect_db_movie_review,$create_people_query) or die($connect_db_movie_review);

//creating table for user
$create_user_query = 'create table if not exists user_details (
																user_id int(5) not null primary key auto_increment,
																fullname varchar (255) not null,
																username varchar (255) not null unique,
																password varchar (255) not null
																)';
$execute_create_user_query = mysqli_query($connect_db_movie_review, $create_user_query) or die(mysqli_error($connect_db_movie_review));
//create review table
$create_reviews_query = 'create table if not exists reviews(
																review_id int(5) not null primary key auto_increment,
																review_date varchar(30) not null,
																reviewer_name varchar(255) not null,
																review_comment varchar(255),
																review_ratings int(1) not null,
																movie_id int (5) default 0,
																user_id int (5) default 0,
																foreign key (movie_id) references movies(movie_id),
																foreign key (user_id) references user_details(user_id)
																)';
$execute_create_review_query = mysqli_query($connect_db_movie_review,$create_reviews_query) or die($connect_db_movie_review);
//create images table
$create_images_query = 'create table if not exists images(
															image_id int(5) not null primary key auto_increment,
															image_caption varchar(255) not null unique ,
															image_filename varchar(255),
															image_upload_date varchar(30),
															image_uploader int(5),
															movie_id int(5) default 0,
															user_id int (5) default 0,
															foreign key (movie_id) references movies(movie_id),
															foreign key (user_id) references user_details(user_id)
															)';
$execute_create_images_query = mysqli_query($connect_db_movie_review,$create_images_query) or die($connect_db_movie_review);
?>