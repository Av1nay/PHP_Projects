<?php
include 'db_ch03-1.php';

//take in the id of a director and return his/her fullname
function get_director($director_id){
	global $conn;
	$query = 'SELECT people_fullname from people where people_id='.$director_id;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	return $people_fullname ;
}
//take in the id of a lead actor and return his/her full name
function get_leadactor($leadactor_id) {
	global $conn;
	$query = 'SELECT people_fullname from people where people_id='. $leadactor_id;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	return $people_fullname;
}
//take in the id of a movie tyoe and return the meaningful textual description
function get_movietype($type_id){
	global $conn;
	$query = 'SELECT movietype_label from movietype where movietype_id = '.$type_id;
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	return $movietype_label;
}

//function to calculate if a movie made a profit, loss or just broke even
function calculate_differences($takings,$cost){
	$difference = $takings-$cost;

	if ($difference<0){
		$color ='red';
		$difference = '$'. abs($difference).' million';
	} elseif ($difference>0){
		$color='green';
		$difference = '$'. abs($difference).' million';
	} else{
		$color = 'blue';
		$difference = 'broke even';
	}

	return '<span style="color:'.$color.';">'.$difference.'</span>';
}


// function to generate ratings
function generate_ratings($rating){
    $movie_rating='';
    for($i=0;$i< $rating; $i++){
        $movie_rating .= '<img src="../movie_review/images/star.png" style="width: 1em; height: 1em;" alt="star">';
    }
    return $movie_rating;
}

//retrieve information

$query = "select movie_name, movie_year, movie_director,movie_leadactor, movie_cost, movie_takings from movie where movie_id =".$_GET['movie_id'];
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$row = mysqli_fetch_assoc($result);
$movie_name =$row['movie_name'];
$movie_director = get_director($row['movie_director']);
$movie_leadactor = get_leadactor($row['movie_leadactor']);
$movie_year = $row['movie_year'];
$movie_running_time = $row['movie_running_time'].' mins';
$movie_takings = $row['movie_takings'].' million';
$movie_cost = $row['movie_cost'].' million';
$movie_health = calculate_differences($row['movie_takings'],$row['movie_cost']);
?>

<html>
<head>
	<title>Details and reviews for <?php echo $movie_name ?></title>
</head>
<body>
	<div style="text-align: center;">
		<h2><?php echo $movie_name?></h2>
		<h3><em>Details</em></h3>
		<table cellpadding="2" cellspacing="2"
		       style="width: 70%;
					margin-left: auto;
					margin-right: auto;">
			<tr>
				<td><strong>Title</strong></td>
				<td><?php echo $movie_name?></td>
				<td><strong>Release Year</strong></td>
				<td><?php echo $movie_year?></td>
			</tr>
			<tr>
				<td><strong>Director</strong></td>
				<td><?php echo $movie_director?></td>
				<td><strong>Cost</strong></td>
				<td><?php echo '$'.$movie_cost ?> </td>
			</tr>
			<tr>
				<td><strong>Lead Actor</strong></td>
				<td><?php echo $movie_leadactor?></td>
				<td><strong>Takings</strong></td>
				<td><?php echo'$'. $movie_takings?></td>
			</tr>
			<tr>
				<td><strong>Running Time</strong></td>
				<td><?php echo $movie_running_time?></td>
				<td><strong>Health</strong></td>
				<td><?php echo $movie_health?></td>
			</tr>
		</table>
        <?php
        // retrives for this movie
        $query = 'select review_movie_id, review_date, reviewer_name, review_comment, review_rating from reviews where review_movie_id = '.$_GET['movie_id'].' order by review_date desc';
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

// displays the reviews
        echo '
        <h3><em>Reviews</em></h3>
        <table cellspacing="2" cellpadding="2" 
        style="
                width: 90%; 
                margin-left: auto; 
                margin-right: auto;
                ">
            <tr>
                <th style="width: 7em;">Date</th>
                <th style="width: 10em;">Reviewer</th>
                <th>Comments</th>
                <th style="width: 5em;">Ratings</th>
            </tr>
        ';


        while ($row = mysqli_fetch_assoc($result)){
            $date = $row['review_date'];
            $name = $row['reviewer_name'];
            $comment = $row['review_comment'];
            $rating = generate_ratings($row ['review_rating']);
        }

        echo '
            <tr>
                <td style="vertical-align: top; text-align: center;">'.$date.'</td>
                <td style="vertical-align: top; text-align: center;">'.$name.'</td>
                <td style="vertical-align: top; text-align: center;">'.$comment.'</td>
                <td style="vertical-align: top; text-align: center;">'.$rating.'</td>
            </tr>
            </table>
           
        ';

        ?>
	</div>
</body>
</html>
