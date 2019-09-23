<?php
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$query = mysqli_query($conn, "SELECT a.access_code, a.access_desc, IF(a.status = 1, 'Active', 'Inactive') from tbl_user_access as a ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$access_code = $rows[0];
		$access_desc = $rows[1];
		$status = $rows[2];
		$result[] = array($access_code,$access_desc,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
