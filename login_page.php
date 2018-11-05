<?php
session_start();
include 'header.php';
?>
<form action="insert_commit.php" method="post">
	<center>
		<h2>Enter Your Login Credentials</h2>
		<hr>
		<table style="alignment: center; width: 500px;">
			<tr>
				<th>Username:</th>
				<td><input type="text" name="compare_username" required></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><input type="password" name="compare_password" required></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center;">
					<input type="submit" value="Login">
				</td>
			</tr>
		</table>
		<hr>
		<a href="create_user.php">New User</a>
	</center>
</form>
