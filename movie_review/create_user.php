<?php
include 'db_connect.php';
?>

<html>

<form action="insert_commit.php" method="post">
	<center>
		<h2>Register for new users!!</h2>
		<hr>
		<table>
			<tr>
				<th>
					<label for="fullname">Fullname:</label>
				</th>
				<td>
					<input type="text" name="fullname" required>
				</td>
			</tr>
			<tr>
				<th>
					<label for="username">Username:</label>
				</th>
				<td>
					<input type="text" name="username" required>
				</td>
			</tr>
			<tr>
				<th>
					<label for="password">Password:</label>
				</th>
				<td>
					<input type="password" name="password" required>
				</td>
			</tr>
			<tr style="border-bottom: #000 1px solid">
				<th>
					<label for="password">Comfirm Password:</label>
				</th>
				<td>
					<input type="password" name="comfirm_password" required>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<input type="submit" value="Create User">
				</td>
			</tr>
		</table>
	</center>
</form>
</html>
