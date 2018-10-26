<html>
<head>
	<title>Multipurpose Form</title>
	<style type="text/css">
		td{
			vertical-align: top;
		}
	</style>
</head>
<body>
<form action="form4_a.php" method="post">
	<table>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name"> </td>
		</tr>
		<tr>
			<td>Item Type</td>
			<td>
				<input type="radio" name="type" checked value="movie">Movie<br>
				<input type="radio" name="type" value="actor">Actor<br>
				<input type="radio" name="type" value="director">Director
			</td>
		</tr>
		<tr>
			<td>Movie Type<br><small>(if applicable)</small></td>
			<td>
				<select name="movie_type">
					<option value="">Select a movie....</option>
					<option value="action">Action</option>
					<option value="drama">Drama</option>
					<option value="Comedy">Comedy</option>
					<option value="Sci-fi">Sci-fi</option>
					<option value="War">War</option>
					<option value="Other">Other...</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="checkbox" name="debug" checked >Display Debug info.
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="submit" value="Search">
				<input type="submit" name="submit" value="Add">
			</td>
		</tr>
	</table>
</form>
</body>
</html>