<?php
session_start();
//check to see if the user has logged in with a valid password
if($_SESSION['authuser'] != 1){
    echo 'Sorry you don\'t have the permission to view this page!';
    exit();
}
?>
<html>
<head>
    <title>
        My Movie Site - <?php echo $_GET['favmovie'];?>
    </title>
</head>
<body>
<?php
    echo 'Welcome to our site'.$_SESSION['username'].'!<br>';
    echo 'My favorite movie is'. $_GET['favmovie'].'<br>';
    $movierate = 5;
    echo 'My movie rating for this movie is: '. $movierate;
?>
</body>
</html>
