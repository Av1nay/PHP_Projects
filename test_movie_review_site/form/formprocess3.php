<?php
if ($_POST['type'] =='movie' && $_POST['movie_type']=='' && empty($_POST['name'])){
	header('Location:form3.php');

}
?>
<html>
<head>
	<title><?php echo $_POST['submit']. ' '.$_POST['type'].' '.$_POST['name'];?></title>
</head>
<body>
<?php
	if (isset($_POST['debug'])){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
	}
	$name = ucwords($_POST['name']);
	if ($_POST['type'] == 'movie'){
		$foo = $_POST['movie_type'].' '.$_POST['type'];
	}else{
		$foo = $_POST['type'];
	}
	echo '<p>You are '.$_POST['submit'].'ing ';
	echo ($_POST['submit'] =='Search')?'for ':'';
	echo 'a '.$foo.' named '.$name.'</p>';
?>
</body>
</html>
