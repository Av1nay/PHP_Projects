<?php


//take in the id of a director and return his/her fullname
function get_director($director_id){
	global $conn;
	$query = 'SELECT people_fullname from people where people_id='.$director_id;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	//echo $row;
	return $people_fullname ;
}
//take in the id of a lead actor and return his/her full name
function get_leadactor($leadactor_id)
{
	global $conn;
	$query = 'SELECT people_fullname from people where people_id='. $leadactor_id;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	//echo $row;
	return $people_fullname;
}
//take in the id of a movie tyoe and return the meaningful textual description
function get_movietype($type_id){
	global $conn;
	$query = 'SELECT movietype_label from movietype where movietype_id = '.$type_id;
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	//echo $row;
	return $movietype_label;
}

include 'db_ch03-1.php';
//retrieve information

$query = 'SELECT movie_id, movie_name, movie_year, movie_director, movie_leadactor, movie_type from movie order by movie_name asc , movie_year desc ';
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
//determine number of rows in returned in result
$num_rows = mysqli_num_rows($result);
?>
<div style="text-align: center;">
	<h2>Movie Review Database</h2>
	<table border ="1" cellpadding="2" cellspacing="2" style="width: 70%; margin-left: auto; margin-right: auto;">
		<tr>
			<th>Movie Title</th><th>Year Of Release</th><th>Movie Director</th><th>Lead Actor</th><th>Movie Type</th>
		</tr>
		<?php
		//loop through the results
		while ($row =mysqli_fetch_assoc($result)){
			extract($row);
			$director = get_director($movie_director);
			$leadactor = get_leadactor($movie_leadactor);
			$movietype = get_movietype($movie_type);
			echo'<tr>
             <td><a href=movie_details.php?movie_id='.$movie_id.'>'.$movie_name.'</a></td>
                <td>'.$movie_year.'</td>
                <td>'.$director.'</td>
                <td>'.$leadactor.'</td>
                <td>'.$movietype.'</td>
            </tr>';
		}
		?>
	</table>
	<?php echo '<p>Results: '.$num_rows.' Movies </p>'?>
</div>
