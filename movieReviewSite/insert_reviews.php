<?php
session_start();
include 'header.php';
?>
<form action='insert_reviews.php?movie_id='<?php $movie_id?> method="post">
	<table>
		<tr>
			<td>
                <?php
                    $queryToSelectUser = 'select user_id from user_details where username = "'.$_SESSION['username'].'"';
                    $executeQueryToSelectUser = mysqli_query($connect_db_movie_review, $queryToSelectUser) or die(mysqli_error($connect_db_movie_review));
                    foreach ($executeQueryToSelectUser as $value){
                    }
                    $queryToSelectUserProfile = 'select image_filename from images where user_id ='.$value['user_id'];
                    $executeQueryTOSelectProfile = mysqli_query($connect_db_movie_review, $queryToSelectUserProfile) or die($connect_db_movie_review);
                    foreach ($executeQueryTOSelectProfile as $value){
                    }
                    $select

                ?>
                <img src="image_web/<?php echo $value['image_filename']; ?>" alt="profileImage" width="100" height="100">
            </td>
            <td>
                <strong style="float: left;"><?php echo $_SESSION['username'];?></strong>
                <strong style="float: right;">
                    Ratings:
                    <select name="ratings">
                        <option value="rate movie" selected>Rate Movie</option>

                        <?php
                        for ($i=1; $i<=5; $i++){
                            echo'<option>'. $i.'</option>';
                        }
                        ?>

                    </select>
                </strong>
                <div>
                    <textarea rows="7" cols="150" maxlength="50%" name="comments" style="height: 82px;"></textarea>
                </div>
            </td>
		</tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submitReview" value="Post">
            </td>
        </tr>
	</table>
</form>
<?php
    if(isset($_POST['comments'])){
        $reviewDate=date('H:i:s m.d.Y');
        $comments = $_POST['comments'];
        $ratings = $_POST['ratings'];
        echo $reviewDate.'<br>';
        echo $comments.'<br>';
        echo $ratings;
        die();
        $queryInsertReview = 'insert into reviews(reiview_date,reviewer_name,review_comment,review_ratings,movie_id,user_id)
                                values ("'.$reviewDate.'","'.$_SESSION['username'].'","'.$comments.'","'.$ratings.'")';
}


?>