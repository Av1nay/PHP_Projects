<?php
include 'db_connect.php';
include 'header.php';

//select image cover
$querySelectMovieDetails = 'select * from movies';
$executeQuerySelectMovieDetails = mysqli_query($connect_db_movie_review,$querySelectMovieDetails) or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectMovieDetails as $value){

}
//select user profile
$querySelectMovieCover = 'select image_id, movie_id,user_id,image_filename from images';
$executeQuerySelectMovieCover = mysqli_query($connect_db_movie_review,$querySelectMovieCover )or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectMovieCover as $value){

}

//select reviews and ratings
$querySelectReviewsAndRatings = 'select * from reviews';
$executeQuerySelectReviewsAndRatings = mysqli_query($connect_db_movie_review,$querySelectReviewsAndRatings) or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectReviewsAndRatings as $value){

}
?>
<table>
    <tr>
        <td width="450" height="550">
            <img src="image_web/<?php echo $value['image_filename'];?>" alt="" width="450" height="550" >
        </td>
        <td>
            <h1 style="float: left;">Movie Name</h1>
            <div style="float: right">
                Ratings:
                <?php
                    for ($i=1; $i<=)
                ?>
                <select>
                    <option value="rate movie" selected>Rate Movie</option>
                    <?php
                    for ($i=1; $i<=5; $i++){
                        echo'<option>'. $i.'</option>';
                    }
                    ?>

                </select>
            </div>

        </td>
    </tr>
</table>


