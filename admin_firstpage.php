<?php
session_start();
include 'header.php';
include 'db_connect.php';

echo '<h3 style="text-align: right;">Hello '.$_SESSION['username'].'</h3><hr>';
?>
<form method="post">
    <table>
        <tr>
            <td><a href="inserting_data_in_movies_table.php">ADD MOVIES</a></td>
        </tr>
        <tr>
            <td>
                <a href="insert_form_movietype.php">ADD GENRE</a>
            </td>
        <tr>
            <td>
                <a href="insert_reviews.php">INSERT REVIEWS</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="movie_individual_page.php">MOVIE INDIVIDUAL PAGE</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="insert_images.php">INSERT IMAGE</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="movie_list.php">MOVIE LIST</a>
            </td>
        </tr>
    </table>
</form>