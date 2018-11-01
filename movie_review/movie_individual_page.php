<?php
session_start();
include 'db_connect.php';
include 'header.php';

//select image cover
$querySelectMovieDetails = 'select * from movies';
$executeQuerySelectMovieDetails = mysqli_query($connect_db_movie_review,$querySelectMovieDetails) or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectMovieDetails as $value) {
    $movieId = $value['movie_id'];
    $movieName = $value['movie_name'];
    $movie_type = $value['movie_type'];
    $releasedYear = $value['movie_year'];
    $movie_actor = $value['movie_actor'];
    $movie_director = $value['movie_director'];
    $runningTime = $value['movie_running_time'];
    $cost = $value['movie_cost'];
    $earnings = $value['movie_earning'];
    $profit = $value['movie_profit'];
}
//select user profile
$querySelectMovieCover = 'select image_id, movie_id,user_id,image_filename from images';
$executeQuerySelectMovieCover = mysqli_query($connect_db_movie_review,$querySelectMovieCover )or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectMovieCover as $value){
    $imageId = $value['image_id'];
    $movieId = $value['movie_id'];
    $userId = $value['user_id'];
    $imageFileName = $value['image_filename'];
}
//select movie genre
$querySelectGenre = 'select movietype_label from movietype where movietype_id='.$movie_type;
$executeQuerySelectGenre = mysqli_query($connect_db_movie_review,$querySelectGenre)or die(mysqli_error($connect_db_movie_review));
foreach($executeQuerySelectGenre as $value){
    $genre = $value['movietype_label'];
}
//select director
$querySelectDirector = 'select people_fullname from people where people_id='.$movie_director;
foreach(mysqli_query($connect_db_movie_review,$querySelectDirector) as $value ){
    $director = $value['people_fullname'];
}
//select actor
$querySelectActor = 'select people_fullname from people where people_id='.$movie_actor;
foreach(mysqli_query($connect_db_movie_review,$querySelectActor) as $value ){
    $leadactor = $value['people_fullname'];
}
//select reviews and ratings
$querySelectReviewsAndRatings = 'select * from reviews';
$executeQuerySelectReviewsAndRatings = mysqli_query($connect_db_movie_review,$querySelectReviewsAndRatings) or die(mysqli_error($connect_db_movie_review));
foreach ($executeQuerySelectReviewsAndRatings as $value){
    $reviewId = $value['review_id'];
    $reviewDate = $value['review_date'];
    $reviewerName = $value['reviewer_name'];
    $comments = $value['review_comment'];
    $ratings = $value['review_ratings'];
}
?>
<div style="width: 100%; height: auto;">
    <div class="imageThumbnail" style="float: left;width: 40%;">
        <img src="image_web/<?php echo $imageFileName; ?>" alt="<?php echo $movieName.' Cover'; ?>" width="350" height="450">
    </div>
    <div class="movieDescription" style="float: left;width: 60%;">
        <div>
            <h1><?php echo $movieName; ?></h1>
        </div>
        <hr>
        <div>
            <p>Year R eleased: <?php echo $releasedYear; ?> </p>
            <p>Genre: <?php echo ucwords($genre);?></p>
            <p>Director: <?php echo ucwords($director);?></p>
            <p>Lead Actor: <?php echo $leadactor; ?></p>
            <p>Running Time: <?php echo $runningTime.' minutes'; ?></p>
            <p>Movie Cost: <?php echo $cost;?></p>
            <p>Earnings: <?php echo $earnings;?></p>
            <p>Profit: <?php echo $profit;?></p>
        </div>
    </div>
    <div style="clear: both;"></div>
<div>
    <hr>
    <form action="#" method="post">
        <?php
        $queryToSelectUser = 'select user_id from user_details where username = "'.$_SESSION['username'].'"';
        $executeQueryToSelectUser = mysqli_query($connect_db_movie_review, $queryToSelectUser) or die(mysqli_error($connect_db_movie_review));
        foreach ($executeQueryToSelectUser as $value){
        }
        $queryToSelectUserProfile = 'select image_filename from images where user_id ='.$value['user_id'];
        $executeQueryTOSelectProfile = mysqli_query($connect_db_movie_review, $queryToSelectUserProfile) or die($connect_db_movie_review);
        foreach ($executeQueryTOSelectProfile as $value){
        }

        ?>
        <div style="float: left;width:11%;">
            <img src="image_web/<?php echo $value['image_filename']; ?>" alt="profileImage" width="100" height="100">
        </div>
        <div style="float: left; width:89%;">
            <strong style="float: left;"><?php echo $_SESSION['username'];?></strong>
            <strong style="float: right;">
                Ratings:
                <select name="ratings">
                    <option value="" selected>Rate Movie</option>

                    <?php
                    for ($i=1; $i<=5; $i++){
                        echo'<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>

                </select>
            </strong>
            <div style="clear: both;"></div>
            <div>
                <textarea maxlength="1000" name="comments" style="height: 80px; width: 100%"></textarea>
            </div>
        </div>
        <dvi style="clear: both;"></dvi>

        <input type="submit" name="submitReview" value="Post">
    </form>
    <?php
if(isset($_POST['comments'])){
    $reviewDate=date('H:i:s m.d.Y');
    $comments = $_POST['comments'];
    $movieRatings = $_POST['ratings'];
    echo $reviewDate.'<br>';
    echo $comments.'<br>';
    echo $movieRatings.'<br>';
    $queryInsertReview = 'insert into reviews(reiview_date,reviewer_name,review_comment,review_ratings,movie_id,user_id)
                                values ("'.$reviewDate.'","'.$_SESSION['username'].'","'.$comments.'","'.$movieRatings.'")';
    echo $queryInsertReview;
}
?>
</div>
