<?php
include 'db_ch03-1.php';

//create the reviews table

$query = 'create table if not exists reviews(
										review_movie_id int not null auto_increment,
										review_date date not null ,
										reviewer_name varchar (255) not null,
										review_comment varchar (255) not null,
										review_rating int not null default 0,
										key (review_movie_id))';
mysqli_query($conn,$query) or die(mysqli_error($conn));

//insert values in reivews

$query = 'insert into reviews (review_date,reviewer_name, review_comment, review_rating ) 
			values ("2018-10-03", "Jhon Doe", "I thought this was a great movie, Even though my girlfriend made me see against my will.",4),
			("2018-10-03","Billy Bob", "I liked eraserhead better.",2),
			("2018-10-03","Papermint Patty","I wish I\'d have seen it sooner! ",5),
			("2018-10-03","Marvin Martin","This is my favorite movie. I didn\'t wear my flair to the movie but I loved it any way.",5),
			("2018-10-03","George B.","I liked this movie, even though I thought it was an international video from my travel agent.",3)';
mysqli_query($conn,$query) or die(mysqli_error($conn));
echo 'movie database successfully updated';
?>