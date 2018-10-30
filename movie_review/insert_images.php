<?php
include 'db_connect.php';
?>
<form action="validate_image.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" value="Upload">
    <input type="submit" name="submit" value="Upload">
</form>
