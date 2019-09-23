<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$dept_code = $_GET['r'];
	$query = mysqli_query($conn, "SELECT * from tbl_departments where dept_code = '$dept_code' ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$dept_code = $rows[0];
		$dept_desc = $rows[1];
		$status = $rows[2];
		$result[] = array($dept_code,$dept_desc,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
