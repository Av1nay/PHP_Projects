<?php
include 'db_connect.php';
//connection via $connect_db_movie_review
//create movies table
$create_movies_query = 'CREATE TABLE IF NOT EXISTS 
movies(
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
$create_movietype_query = 'CREATE TABLE IF NOT EXISTS 
movietype (
	movietype_id int(5) not null primary key auto_increment,
	movietype_label varchar(255) not null unique
	)';
$execute_create_movietype_query = mysqli_query($connect_db_movie_review,$create_movietype_query) or die($connect_db_movie_review);
//create people table
$create_people_query = 'CREATE TABLE IF NOT EXISTS 
people(
	people_id int(5) not null primary key auto_increment,
	people_fullname varchar(255) not null unique,
	people_is_actor int(1) default 0,
	people_is_director int(1) default 0
	)';
$execute_create_people_query = mysqli_query($connect_db_movie_review,$create_people_query) or die($connect_db_movie_review);

//creating table for user
$create_user_query = 'CREATE TABLE IF NOT EXISTS 
user_details (
	`user_id` int(5) not null primary key auto_increment,
	fullname varchar (255) not null,
	username varchar (255) not null unique,
	password varchar (255) not null
	)';
$execute_create_user_query = mysqli_query($connect_db_movie_review, $create_user_query) or die(mysqli_error($connect_db_movie_review));
//create review table
$create_reviews_query = 'CREATE TABLE IF NOT EXISTS
reviews(
	review_id INT(5) not null primary key auto_increment,
	review_date varchar(30) not null,
	reviewer_name varchar(255) not null,
	review_comment varchar(255),
	review_ratings INT(1) not null,
	movie_id INT (5) default 0,
	`user_id` INT (5) default 0,
	CONSTRAINT FK_movies_review foreign key (movie_id) references movies(movie_id) on DELETE CASCADE,
	CONSTRAINT FK_user_details_review foreign key (`user_id`) references user_details(`user_id`) on delete CASCADE
	)';
$execute_create_review_query = mysqli_query($connect_db_movie_review,$create_reviews_query) or die($connect_db_movie_review);
//create images table
$create_images_query = 'CREATE TABLE IF NOT EXISTS
images(
   image_id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
   image_caption VARCHAR(255) NOT NULL,
   image_filename VARCHAR(255),
   image_upload_date DATETIME,
   image_uploader INT(5),
   movie_id INT(5) DEFAULT 0,
   user_id INT(5) DEFAULT 0,
   CONSTRAINT FK_movies_images FOREIGN KEY(movie_id) REFERENCES movies(movie_id) ON DELETE CASCADE,
   CONSTRAINT FK_user_images FOREIGN KEY(user_id) REFERENCES user_details(user_id) ON DELETE CASCADE
	)';
$execute_create_images_query = mysqli_query($connect_db_movie_review,$create_images_query) or die($connect_db_movie_review);
?>