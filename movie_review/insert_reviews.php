<?php
session_start();
include 'header.php';
?>
<form action="insert_commit.php">
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
                ?>
                <img src="image_web/<?php echo $value['image_filename']; ?>" alt="profileImage" width="100" height="100">
            </td>
            <td>
                <strong sty><?php echo $_SESSION['username'];?></strong>
                <strong style="float: right;">
                    Ratings:
                    <select>
                        <option value="rate movie" selected>Rate Movie</option>
                        <?php
                        for ($i=1; $i<=5; $i++){
                            echo'<option>'. $i.'</option>';
                        }
                        ?>

                    </select>
                </strong>
                <div>
                    <textarea rows="7" cols="150" maxlength="1000" name="comments" style="height: 82px;"></textarea>
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
