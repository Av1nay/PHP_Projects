<?php
include 'table_queries.php';


//insert dat into the movie table
$insert_query_into_movie = 'INSERT INTO movie
			(movie_name, movie_type, movie_year, movie_leadactor, movie_director)
			VALUES 
			("Bruce Almighty",5,2003,1,2),
			("Office Space",5,1995,5,6),
			("Grand Canyon",2,1991,4,3)
			';
mysqli_query($conn, $insert_query_into_movie) or die(mysqli_error($conn));



//insert data into the movietype table

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


//insert into people table


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
mysqli_query($conn,$insert_query_into_people)or die(mysqli_error($conn));

echo 'Inserted successfully';
?>