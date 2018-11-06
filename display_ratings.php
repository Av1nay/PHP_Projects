<?php 
    include 'db_connect.php';
    $ratings = 2;
    
    function generateRatings($ratings){
        $x=0;
        while($x<$ratings){
            echo '<img src="images/star.png" width="30px" height="30px">';
            $x++;
        }
    }
generateRatings($ratings);
?>