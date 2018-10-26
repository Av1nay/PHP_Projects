<?php
include 'db_ch03-1.php';
$insert_query_into_people = 'insert into people
(people_fullname, people_is_actor, people_is_director)
values
("Jim Carry",1,0),
("Tom Shadyac" , 0,1),
("Lawrence Kasdan", 0 ,1),
("Kevin Kline",1,0),
("Ron Livingston", 1,0),
("Mike Judge", 0,1)
';
mysqli_query($conn, $insert_query_into_people) or die(mysqli_error($conn));
header("Location: select_people.php");
?>