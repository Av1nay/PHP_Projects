<html>
<head>
	<title>Multipurpose Form</title>
	<style type="text/css">
		td{
			vertical-align: top;}
	</style>
</head>
<body>
<?php
if($_POST['type']=='movie'){
	echo '<h1>New '.ucwords($_POST['movie_type']).':';
}else{
	echo '<h1>New '.ucwords($_POST['type']).':';
}
echo ucwords($_POST['name']).'</h1>';
echo '<table> ';
if ($_POST['type']=='movie'){
	echo '<tr>
			<td>Year</td>
			<td>'.$_POST['year'].'</td>
			</tr>
			<tr>
			<td>Movie Description - </td>';
} else {
	echo '<td>Biography</td>';
}
echo '<td>'.nl2br($_POST['extra']).'</td>
		</tr>
		</table>';
if (isset($_POST['debug'])){
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
}
?>
</body>
</html>