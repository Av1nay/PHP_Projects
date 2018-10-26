<?php
//connect to MySQL
$hostname = "localhost";
$username = "root";
$password = "root";
$databse = "movie";
$port     = 8889;
//$link = mysqli_init();

// Create connection
$conn = mysqli_connect( $hostname, $username, $password,$databse);

// Check connection
if ( ! $conn ) {
	die( "Connection failed: " . mysqli_connect_error() );
};
echo 'connected<br>';
$sql = 'SELECT movie_name, movie_type FROM movies WHERE movie_year>1990 ORDER BY movie_type';
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while ($row= mysqli_fetch_array($result)){
	extract($row);
	echo $movie_name. '-'.$movie_type.'<br>';
}
