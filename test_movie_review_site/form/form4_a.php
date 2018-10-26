<?php
//Make sure the user selected a movie type if they are adding a movie. If not, then send them back to the first form.
if($_POST['submit'] == 'Add'){
	if($_POST['type'] == 'movie' && $_POST['movie_type'] == ''){
		header('Location: form4.php');
	}
}
?>
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
<?php
//Show a form to collect more information if the user is adding something

if ($_POST['submit'] == 'Add'){echo '<h1>Add '. ucwords($_POST['type']).'</h1>';
?>
<form action="form4_b.php" method="post">
	<input type="hidden" name="type" value="<?php echo $_POST['type'];?>">
	<table>
		<tr>
			<td>Name</td>
			<td>
				<?php echo ucwords($_POST['name']);?>
				<input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
			</td>
		</tr>
		<?php if ($_POST['type'] == 'movie'){ ?>
		<tr>
			<td>Movie Type</td>
			<td><?php echo $_POST['movie']; ?><input type="hidden" name="movie_type" value="<?php echo $_POST['movie_type']; ?>" </td>
		</tr>
		<tr>
			<td>Year</td>
			<td><input type="text" name="year"> </td>
		</tr>
		<tr>
			<td>Movie Description</td>
			<?php }else{ echo '<tr><td>Biography</td>';} ?>
			<td><textarea name="extra" rows="5" cols="60"></textarea> </td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<?php
				if(isset($_POST['debug'])){
					echo '<input type="hidden" name="debug" value="on">';
				}
				?>
				<input type="submit" name="submit" value="Add">
			</td>
		</tr>
	</table>
</form>
<?php
// the user is just searching for something
}elseif($_POST['submit']=='Search'){
	echo '<h1>Search for'.ucwords($_POST['type']).'</h1>
			<p>Searching for'.$_POST['name'].'</p>';
}
if (isset($_POST['debug'])){
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
}
?>
</body>
</html>
