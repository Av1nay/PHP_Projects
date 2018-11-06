<?php
session_start();
include 'header.php';
include 'db_connect.php';

echo '<h3 style="text-align: right;">Hello '.$_SESSION['username'].'</h3><input type="submit" value="logout" name="logout"><hr>';

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
        </tr>
        <tr>
            <td>
                <a href="create_user.php">CREATE USER</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="movie_list.php">MOVIE LIST</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="insert_in_people_form.php">INSERT PEOPLE</a>
            </td>
        </tr>
    </table>
</form>
