<?php
include 'db_ch03-1.php';

//create table movies
$sqlt = 'create table if not exists movie(
												movie_id int not null AUTO_INCREMENT PRIMARY KEY, 
												movie_name varchar(255) not null, 
												movie_type int not null default 0, 
												movie_year int not null default 0, 
												movie_leadactor int not null default 0, 
												movie_director int not null default 0, 
												KEY movie_type (movie_type,movie_year))';
mysqli_query( $conn, $sqlt );
//create table movie_type
$sqlt = 'create table if not exists movietype(
													movietype_id int not null auto_increment primary key ,
													movietype_label varchar(100) not null
													)';
mysqli_query( $conn, $sqlt );
//create table people
$sql = 'create table if not exists people( 
											people_id int not null auto_increment primary key, 
											people_fullname varchar (255) not null , 
											people_is_actor int(2) not null default 0, 
											people_is_director int (2) not null default 0)';
mysqli_query( $conn, $sql );

?>