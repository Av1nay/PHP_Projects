<?php
	include 'db_ch03-1.php';
?>
<html>
<head>
	<title>Add Movie</title>
</head>
<body>
<form action="commit.php?action=add&type=movie" method="post">
	<table>
		<tr>
			<td>Movie Name</td>
			<td><input type="text" name="movie_name"></td>
		</tr>
		<tr>
			<td>Movie Type</td>
			<td><select name="movie_type">
					<?php
						//select the movie type information
					$query = 'select movietype_id, movietype_label from movietype order by movietype_label';
					$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

					//populate the select options with the results

					while ($row = mysqli_fetch_assoc($result)){
						foreach ($row as $value){
							echo '<option value="'.$row['movietype_id'].'">'.$row['movietype_label'].'</option>';
						}
					}
					?>
				</select></td>
		</tr>
		<tr>
			<td>Movie Year</td>
			<td><select name="movie_year">
					<?php
						//populate the select options with years
					for ($year= date("Y"); $year>=1970;$year--){
						echo '<option value ="'.$year.'">'.$year.'</option>';
					}
					?>
				</select> </td>
		</tr>
		<tr>
			<td>Lead Actor</td>
			<td><select name="movie_leadactor">
					<?php
						// select actors
					$query = 'select people_id, people_fullname from people where people_is_actor =1 order by people_fullname';
					$result = mysqli_query($query) or die(mysqli_error($conn));

					//populate the select options with the results
					while ($row = mysqli_fetch_assoc($result)) {
						foreach ( $row as $value ) {
							echo '<option value="' . $row['people_id'] . '">' . $row['people_fullname'] . '</option>';
						}
					}
					?>
				</select> </td>
		</tr>
		<tr>
			<td>Director</td>
			<td>
				<select name="movie_director">
					<?php
						$query = 'select people_id, people_fullname from people where people_is_director = 1 order by people_name';
						$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
						//populate the select options with the results
					while($row = mysqli_fetch_assoc($result)){
						foreach ($row as $value){
							echo '<option value="'.$row['people_id'].'">'.$row['people_fullname'].'</option>';
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="submit" value="Add">
			</td>
		</tr>
	</table>
</form>
</body>
</html>
