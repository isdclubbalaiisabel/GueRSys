<?php
	
	include "../../global_variables_for_mysql_connection.php";

	$result = array();
	$query = mysqli_query($conn, "SELECT a.room_code, a.room_desc, IF(a.room_status = 1, 'Active', 'Inactive') from tbl_rooms as a ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$room_code = $rows[0];
		$room_name = $rows[1];
		$status = $rows[2];
		$result[] = array($room_code,$room_name,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
