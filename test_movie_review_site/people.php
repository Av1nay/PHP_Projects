<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_ch03-1.php';
if ($_GET['action'] == 'edit'){
	//retrieve the record's information
	$select_movie_query = 'select people_fullname, people_is_actor, people_is_director from people where people_id='.$_GET['id'];
	$select_movie_result = mysqli_query($conn, $select_movie_query) or die(mysqli_error($conn));
	extract(mysqli_fetch_assoc($select_movie_result));
}else{
	//set values to blank
	$people_fullname = '';
	$people_is_actor=0;
	$people_is_director=0;
};

echo '<html>
<head>
	<title>'.ucwords($_GET['action']).' People</title>
</head>
<body>
<form action="commit.php?action='.$_GET['action'].'&type=people" method="post">
<!--<form action="#" method="post">-->
	<table>
		<tr>
			<td>People Name</td>
			<td><input type="text" name="people_fullname" value="'.$people_fullname.'" placeholder="Type actor name to add"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<select name="people_is_actor_or_director">
					<option>Actor</option>
					<option>Director</option></select>
			</td>
		</tr>
		
		<tr>
			<td colspan="2" style="text-align: center;">';
if($_GET['action']=='edit'){
	echo '<input type ="hidden" value="'.$_GET['id'].'" name="people_id" />';
}
echo '<input type="submit" name="submit" value="'.ucfirst($_GET['action']).'">

			</td>
		</tr>
	</table>
</form>
</body>
</html>';
?>
