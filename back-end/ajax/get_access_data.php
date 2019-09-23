<?php
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$access_code = $_GET['r'];
	$query = mysqli_query($conn, "SELECT * from tbl_user_access where access_code = '$access_code' ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$access_code = $rows[0];
		$access_desc = $rows[1];
		$status = $rows[2];
		$result[] = array($access_code,$access_desc,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
