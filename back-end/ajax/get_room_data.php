<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$room_code = $_GET['r'];
	$query = mysqli_query($conn, "SELECT * from tbl_rooms where room_code = '$room_code' ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$room_code = $rows[0];
		$room_name = $rows[1];
		$status = $rows[2];
		$result[] = array($room_code,$room_name,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
