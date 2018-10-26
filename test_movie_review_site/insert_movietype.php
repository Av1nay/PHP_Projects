<?php
include 'db_ch03-1.php';

//insert movitype into table movitype
$insert_query_into_movietype ='INSERT into movietype
(movietype_label)
values
("sci fi"),
("Drama"),
("Adventure"),
("War"),
("Comedy"),
("Horror"),
("Action"),
("Kids"),
("Romance")
';
mysqli_query($conn, $insert_query_into_movietype) or die(mysqli_error($conn));
echo '<br> Inserted Successfully!!';
?>