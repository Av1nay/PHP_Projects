<?php
include 'db_ch03-1.php';?>
<?php

//select the movie titles and their genre after 1990

$query = "SELECT movie_name, movietype_label FROM movie LEFT JOIN movietype ON movie_type = movietype_id";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

//show results
echo '<table border="1">';
while ($row = mysqli_fetch_assoc($result)){
	echo '<tr>';
	foreach ($row as $value){
		echo '<td>'.$value.'</td>';
	}
	  echo '</tr>';
}
echo '</table>';

?>
<?php

//select the movie titles and their genre after 1990

$query = "SELECT * FROM movietype";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

//show results
echo '<table border="1"> <br> List of movie type';
while ($row = mysqli_fetch_assoc($result)){
	echo '<tr>';
	foreach ($row as $value){
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';

?>
<?php
//select the movie titles and their genre after 1990

$query = "SELECT people_name, people_is_dorector, people_is_actor FROM movie_type";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

//show results
echo '<table border="1">';
while ($row = mysqli_fetch_assoc($result)){
	echo '<tr>';
	foreach ($row as $value){
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';

?>
