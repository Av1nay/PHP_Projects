<?php
include 'creating_tables.php';
?>
<html>
<head>
	<title>
		<?php echo ucwords('insert movie type') ?>
	</title>
</head>
<body>
<form action="insert_commit.php" method="post">
	<table>
		<th>
			<?php echo ucwords('movietypes:') ?>
		</th>
		<td><input type="text" name="movietype"></td>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="addmovietype" value="ADD">
			</td>
		</tr>
	</table>
</form>
</body>
</html>
