<?php
include 'db_ch03-1.php';
//retrieve information

$query = 'SELECT movie_name, movie_year, movie_director, movie_leadactor, movie_type from movie order by movie_name asc , movie_year desc ';

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
			echo '<tr> <td>'.$movie_name.'</td><td>'.$movie_year.'</td><td>'.$movie_director.'</td><td>'.$movie_leadactor.'</td><td>'.$movie_type.'</td></tr>';

		}
		?>
	</table>

</div>
