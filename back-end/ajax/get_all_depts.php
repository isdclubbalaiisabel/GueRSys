<?php
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$query = mysqli_query($conn, "SELECT a.dept_code, a.dept_name, IF(a.status = 1, 'Active', 'Inactive') from tbl_departments as a ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$dept_code = $rows[0];
		$dept_name = $rows[1];
		$status = $rows[2];
		$result[] = array($dept_code,$dept_name,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
