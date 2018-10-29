<?php
if (!isset($_SESSION['started'])){
	$_SESSION['started'] = time();
}elseif (time() - $_SESSION['started'] > 3600){
	session_destroy();
	header('Location: login_page.php');
}
include 'creating_tables.php';
$title = ucwords('movie reviews and ratings');
echo '
<html>
<head>
    <title>'.$title.'</title>
</head>
<body>';
