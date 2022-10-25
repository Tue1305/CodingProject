<?php
require_once('connection.php');

function get_device($conn , $term){	
	$query = "SELECT * FROM device WHERE category LIKE '%".$term."%' ORDER BY category ASC";
	$result = mysqli_query($conn, $query);	
	$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
	return $data;	
}

if (isset($_GET['term'])) {
	$getCity = get_device($conn, $_GET['term']);
	$cityList = array();
	foreach($getCity as $city){
		$cityList[] = $city['category'];
	}
	echo json_encode($cityList);
}
?>