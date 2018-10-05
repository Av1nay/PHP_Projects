<?php
	include 'db_ch03-1.php';

?>
<html>
<head>
	<title>Movie Database</title>
	<style>
		th{
			background-color: #808b93;
		}
		.odd_row{
			background-color: #eeeeee;
		}
		.even_row{
			background-color: #ffffff;
		}
	</style>
</head>
<body>
<table style="width: 100%;">
	<tr>
		<th colspan="2">Movies<a href="movie.php?action=add">[ADD]</a> </th>
	</tr>
	<?php
		$query = 'select * from movie';
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		$odd = true;

		while($row = mysqli_fetch_assoc($result)){
			echo ($odd == true)?'<tr class="odd_row">':'<tr class="even_row">';
			$odd = !$odd;
			echo '<td style="width:75%;">'.$row['movie_name'].'</td>
				<td><a href=movie.php?action=edit&id = '.$row['movie_id']. '>[EDIT]</a>
					<a href=movie.php?action=edit&id = '.$row['movie_id']. '>[DELETE]</a>
				</td>';
		}
	?>
	<tr>
		<th colspan="2">People<a href="people.php?action=add">[ADD]</a></th>
	</tr>
	<?php
		$query = 'select * from people';
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$odd=true;
		while ($row = mysqli_fetch_assoc($result)){
			echo ($odd == true)?'<tr class="odd_row">':'<tr class="even_row">';
			$odd =!$odd;
			echo '<td style="width: 25%;">'.$row['people_fullname'].'</td><td><a href="people.php?action=edit&id='.$row['people_id'].'">[EDIT]</a>
					<a href="delete.php?type=people&id='.$row['people_id'].'">[DELETE]</a></td></tr>';
		}
	?>
</table>
</body>
</html>

