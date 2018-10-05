<?php
include 'db_ch03-1.php';
?>
<html>
<head>
	<title>Commit</title>
</head>
<body>
<?php
	switch ($_GET['action']){
		case 'movie':
			$query = 'insert into movie (movie_name, movie_year, movie_type, movie_leadactor, movie_director) 
									values ('.$_POST['movie_name'].',
											'.$_POST['movie_year'].',
											'.$_POST['movie_type'].',
											'.$_POST['movie_leadactor'].',
											'.$_POST['movie_director'].')';
			break;
	}
	if (isset($query)){
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	}
?>
<p>Done!</p>
</body>
</html>
