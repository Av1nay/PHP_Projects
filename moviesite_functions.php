<?php

//take in the id of a director and return his/her fullname
function get_director($director_id){
	global $conn;
	$query = 'SELECT people_fullname from people where people_id='.$director_id;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	//echo $row;
	return $people_fullname ;
}
//take in the id of a lead actor and return his/her full name
function get_leadactor($leadactor_id)
{
	global $conn;
	$query = 'SELECT people_fullname from people where people_id='. $leadactor_id;
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	//echo $row;
	return $people_fullname;
}
//take in the id of a movie tyoe and return the meaningful textual description
function get_movietype($type_id){
	global $conn;
	$query = 'SELECT movietype_label from movietype where movietype_id = '.$type_id;
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	extract($row);
	//echo $row;
	return $movietype_label;
}

//function to calculate if a movie made a profit, loss or just broke even
function calculate_differences($takings,$cost){
	$difference = $takings-$cost;

	if ($difference<0){
		$color ='red';
		$difference = '$'. abs($difference).'million';
	} elseif ($difference>0){
		$color='green';
		$difference = '$'. abs($difference).'million';
	} else{
		$color = 'blue';
		$difference = 'broke even';
	}

	return '<span style="color:'.$color.';">'.$difference.'</span>';
}
?>