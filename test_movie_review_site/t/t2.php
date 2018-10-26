<?php
include 't1.php';
//insert tata into movie table
$sql = 'insert into a (id, movie_name, movie_type,movie_year,movie_leadactor,movie_director) VALUES 
(1, "bruce almighty",5,2003,1,2),
(2, "office space",5,1999,5,6),
(3, "grand canyon",2,1991,4,3)';
mysqli_query($conn, $sql);



//insert into  the movietype table


$sql = 'insert into b (movie_id,movietype_label) values 
("1","Si fi"),("2","Drama"),("3","Adventure"),("4","War"),("5","Comedy"),("6","Horror"),("7","action"),("8","Kids"),("9","Romance")';
mysqli_query($conn,$sql);

$sql = 'insert into c (people_fullname, people_is_actor, people_is_director) values 
(jim carrey,1,0),(tom shadyac,0,1),(lawrence kasdan,0,1),(kevin kline,1,0),(ron livingston,1,0),(mike judge,0,1)';
mysqli_query($conn,$sql);
echo"inserted in c";

?>