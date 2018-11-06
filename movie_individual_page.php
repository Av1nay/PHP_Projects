<?php
session_start();
include 'header.php';
include 'db_connect.php';


//select image cover
$querySelectMovieDetails = 'select * from movies where movie_id='.$_GET['mid'];
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
$querySelectUser = 'select * from user_details where username="'.$_SESSION['username'].'"';
$executeQuerySelectUser = mysqli_query($connect_db_movie_review,$querySelectUser) or die(mysqli_error($connect_db_movie_review));
$uId='';
while($row = mysqli_fetch_assoc($executeQuerySelectUser)){
    $uId = $row['user_id'];
    $userName = $row['username'];
}


//select images
$querySelectMovieCover = 'select image_id, movie_id,user_id,image_filename from images where movie_id='.$movieId;
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

//select people from people table
$queryToSelectPoeple = 'select PA.people_fullname as actor,PD.people_fullname as director from movies as M left join people as PA on PA.people_id = M.movie_actor left join people as PD on PD.people_id = M.movie_director  where movie_id ='.$_GET['mid'];
$executeQueryToSelectPeople = mysqli_query($connect_db_movie_review, $queryToSelectPoeple) or die(mysqli_error($connect_db_movie_review));
foreach($executeQueryToSelectPeople as $value){
$actor = $value['actor'];
$director = $value['director'];
}
//select reviews and ratings
$querySelectReviewsAndRatings = 'select * from reviews';
$executeQuerySelectReviewsAndRatings = mysqli_query($connect_db_movie_review,$querySelectReviewsAndRatings) or die(mysqli_error($connect_db_movie_review));

while($row = mysqli_fetch_assoc($executeQuerySelectReviewsAndRatings)){
}
/*foreach ($executeQuerySelectReviewsAndRatings as $value){
    $reviewId = $value['review_id'];
    $reviewDate = $value['review_date'];
    $reviewerName = $value['reviewer_name'];
    $comments = $value['review_comment'];
    $ratings = $value['review_ratings'];
}*/
function generateRatings($ratings){
    $x=0;
    while($x<$ratings){
        echo '<img src="images/star.png" width="30px" height="30px">';
        $x++;
    }
}
$selectRatings = 'select round(avg(review_ratings),0) as ratings from reviews where movie_id='.$_GET['mid'];
$executeSelectRatings = mysqli_query($connect_db_movie_review, $selectRatings) or die(mysqli_error($connect_db_movie_review));
while($row = mysqli_fetch_assoc($executeSelectRatings)){
    $ratings = $row['ratings'];
}
?>

<div style="width: 1000px; height: auto;">
    <div class="imageThumbnail" style="float: left;width: 40%;">
        <img src="image_web/<?php echo $imageFileName; ?>" alt="<?php echo $movieName.' Cover'; ?>" width="350" height="450">
    </div>
    <div class="movieDescription" style="float: left;width: 60%;">
        <div>
            <h1 style="float: left;"><?php echo ucwords($movieName); ?></h1>
            <small style="float: right;">
                <?php
                generateRatings($ratings);
                ?>
            </small>
        </div>
        <div style="clear: both;"></div>
        <hr>
        <div>
            <p>Year R eleased: <?php echo $releasedYear; ?> </p>
            <p>Genre: <?php echo ucwords($genre);?></p>
            <p>Director: <?php echo ucwords($director);?></p>
            <p>Lead Actor: <?php echo ucwords($actor); ?></p>
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
        <div style="clear: both;"></div>

        <input type="submit" name="submitReview" value="Post">
    </form>
<?php
if(isset($_POST['submitReview'])){
    if(!empty($_POST['comments'])){
        $reviewDate=date('Y-m-d H:i.s');
        $comments = $_POST['comments'];
        $movieRatings = $_POST['ratings'];
        $queryInsertReview = 'insert into reviews(review_date,reviewer_name,review_comment,review_ratings,movie_id,user_id)
                                    values ("'.$reviewDate.'","'.$_SESSION['username'].'","'.$comments.'",'.$movieRatings.','.$_GET['mid'].','.$uId .')';
        $executeQueryInsertReview = mysqli_query($connect_db_movie_review,$queryInsertReview) or die(mysqli_error($connect_db_movie_review));
    }
    
}
$querySelectReview = 'select * from reviews where movie_id='.$_GET['mid'].' order by review_date desc';

$exectueQuerySelectReview = mysqli_query($connect_db_movie_review,$querySelectReview) or die(mysqli_error($connect_db_movie_review));
    while($row = mysqli_fetch_assoc($exectueQuerySelectReview)){
        
        echo '<br><br><p>'.$row['review_comment'].'</p>
            <h3>'.$row['reviewer_name'].'</h3><small>'.$row['review_date'].generateRatings($row['review_ratings']).'</small>
            <hr>';
    }
?>
</div>
