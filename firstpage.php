<?php
session_start();
include 'header.php';
echo '<h3 style="text-align: right;">Hello '.$_SESSION['username'].'</h3><hr>';

$title = 'movie review site';
	echo'
	<html>
		<head>
			<title>'.ucwords($title).'</title>
		</head>		
		<body>
			<table style="width: 100%;">
				<tr>
					<th>S.N.</th>
					<th>Movies</th>
					<th>Date released</th>
					<th>Description</th>
					<th>Casts</th>
					<th>Director</th>
					<th>Ratings</th>
				</tr>
				<tr>
					
				</tr>
			</table>
		</body>
	</html>
	';
?>