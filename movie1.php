<?php
//session start
session_start();
$_SESSION['username'] = $_POST['user'];
$_SESSION['userpass'] = $_POST['pass'];
$_SESSION['authuser'] = 0;

// check username and password information
if (($_SESSION['username'] == 'Joe') && ($_SESSION['userpass'] == '12345')){
    $_SESSION['authuser'] = 1;
}elseif ((empty($_SESSION['username']))&& empty($_SESSION['userpass'])){
    echo 'Fill the all fields';
    exit();
}else{
    echo 'Sorry, but you don\'t have permission to view this page!';
    exit();
}
?>
<html>
<head>
    <title>
        Find My Favorite Movie!
    </title>
</head>
<body>
<?php include 'header.php' ?>
<?php
$myfavmovie= urlencode('Life of Brian');
echo '<a href = moviesite_form.php?favmovie='.$myfavmovie.'>Click here to see information about my favorite movie!</a>'
?>
    <br/>
    <!---
    <a href="moviesite.php?movienum=5">Click here to see my top 5 movies.</a>
    <br/>
    <a href="moviesite.php?movienum=10">Click here to see my top 10 movies.</a>
    --->
    <!--
    <a href="moviesite.php">Click here to see my top 10 movies.</a><br>
    <a href="moviesite.php?sorted=true">Click to see my top 10 movies sorted alphabetically.</a>
    --->
    Or choose how many movies you would like to see:
    <br>
    <form method="post" action="moviesite.php">
        <p>Enter number og movies(Up to 10):
        <input type="text" name="num" maxlength="2" size="2"/>
        <br>
        Check to sort them alphabetically :
        <input type="checkbox" name="sorted">
        <p><input type="submit" name="submit"> </p>
    </form>
<?php include 'dev_info.php' ?>
</body>
</html>
