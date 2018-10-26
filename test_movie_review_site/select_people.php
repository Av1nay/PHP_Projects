<?php

include 'db_ch03-1.php';
//select the movie titles and their genre after 1990

$query = "SELECT people_fullname, people_is_director, people_is_actor FROM people";
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