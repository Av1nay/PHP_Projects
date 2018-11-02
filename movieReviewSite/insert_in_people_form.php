<?php
include 'header.php';
?>
<form action="insert_commit.php" method="post">
	<table>
		<tr>
			<th>Full Name:</th>
			<td><input type="text" value="" name="fullname" ></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="checkbox" value="actor_checkbox" name="actor_or_director[]">
				<label>Actor</label>
				<br>
				<input type="checkbox" value="director_checkbox" name="actor_or_director[]">
				<label>Director</label>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="addpeople" value="ADD">
			</td>
		</tr>
	</table>
</form>
