<?php
session_start();

//check if the user is logged in with valid password
if($_SESSION['authuser'] !=1){
    echo 'Sorry you are not verified as user to view this page';
    exit();
}
?>
<html>
<head>
    <title>
        <?php
            if(isset($_GET['favmovie'])){
                echo ' - '. $_GET['favmovie'];
            }
        ?>
    </title>
</head>
<body>
<?php include 'header.php' ?>
<?php

//example working with functions
    /*function listofmovies_1(){
        echo '1. Life o Brian<br>2. Stripes<br>3. Office Space<br>4. The Holy Grail<br>5. Matrix';
    }
    function listofmovies_2(){
        echo '6. Terminator_2 <br>7. Star Trek IV <br>8.Close Encounters of the Third Kind<br>9. Sixteen Candles <br> 10. Caddyshack<br>';
    }
    if(isset($_GET['favmovie'])){
        echo 'Welcome to our site, '. $_SESSION['username'].'!<br> My favorite movie is '. $_GET['favmovie'].'<br>';
        $movierate = 5;
        echo 'My movie rating for this movie is: '. $movierate;
    }else{
        echo 'My top' . $_GET['movienum']. 'movies are<br>';
        listofmovies_1();
        if($_GET['movienum']==10){
            listofmovies_2();
        }
    }*/


    //adding arrays removing functions

$favmovies = array(
    'Life of Brian',
    'Stripes',
    'Office Space',
    'The Holly Grail',
    'Matrix',
    'Terminator',
    'Stra Trek IV',
    'Close Encounters of the Third Kind',
    'Sixteen Candles',
    'Candyshack');
if(isset($_GET['favmovie'])){
    echo 'Welcome to our site,'. $_SESSION['username'] . '!<br>';
    echo 'My favorite movie is '. $_GET['favmovie'].',<br>';
    $movierate = 5;
    echo 'My movie rating is '.$movierate;
}else{
    /*
     echo 'My top 10 movies are:<br>';
    if(isset($_GET['sorted'])){
        sort($favmovies);
    }
    echo '<ol>';
    foreach ($favmovies as $movies){
        echo '<li>'.$movies.'</li>';
    }
    echo '</ol>';
    */
    echo 'My top '. $_POST['num'] . ' favorite movies ';
    if(isset($_POST['sorted'])){
        sort($favmovies);
        echo ' sorted alphabetically ';
    }
    echo 'are: <br>';
    $numlist = 0;
    echo '<ol>';
    while($numlist < $_POST['num']){
        echo '<li>'.$favmovies[$numlist].'</li>';
        $numlist = $numlist + 1;
    }
    echo '</ol>';
}
?>
<?php include 'dev_info.php' ?>
</body>
</html>
