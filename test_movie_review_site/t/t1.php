<?php
//connect to MySQL
$hostname = "localhost";
$username = "root";
$password = "root";
$port     = 8889;
//$link = mysqli_init();

// Create connection
$conn = mysqli_connect( $hostname, $username, $password );

// Check connection
if ( ! $conn ) {
	die( "Connection failed: " . mysqli_connect_error() );
} else {
	$sqldb = 'create database if not exists movie';
	mysqli_query( $conn, $sqldb );

	$sqls = 'use movie';
	mysqli_query( $conn, $sqls );
//create table movies
	$sqlt = 'create table if not exists a(
												id int not null AUTO_INCREMENT PRIMARY KEY, 
												movie_name varchar(255) not null, 
												movie_type int not null default 0, 
												movie_year int not null default 0, 
												movie_leadactor int not null default 0, 
												movie_director int not null default 0, 
												KEY movie_type (movie_type,movie_year))';
	mysqli_query($conn,$sqlt);
	//create table movie_type
	$sqlt = 'create table if not exists b(
													movie_id int not null auto_increment primary key ,
													movitype_label varchar(100) not null
													)';
	mysqli_query($conn,$sqlt);
	//create table people
	$sql = 'create table if not exists c(
											  people_id int not null auto_increment primary key,
											  people_fullname varchar (255) not null ,
											  people_is_actor int(2) not null default 0,
											  people_is_director int (2) not null default 0)';
	mysqli_query($conn,$sql);
}
?>