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
}


$sqldb = 'create database if not exists moviesite';
mysqli_query( $conn, $sqldb );

$sqls = 'use moviesite';
mysqli_query( $conn, $sqls );
?>