<?php
include 'db_ch03-1.php';

$query_to_create_image_table='create table image(
												image_id int not null primary key auto_increment,
												image_caption varchar(255) not null,
												image_username varchar(255) not null,
												image_filename varchar(255) ,
												image_upload_date varchar(255) not null)';
mysqli_query($conn,$query_to_create_image_table)or die(mysqli_error($conn));
echo 'image table created successfully...';
?>