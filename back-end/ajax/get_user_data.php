<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$user_id = $_GET['u'];
	$result = array();
	$queryString = "SELECT a.user_id,a.passcode,a.name,b.access_code,a.status, c.dept_code FROM tbl_users as a, tbl_user_access as b, tbl_departments as c where user_id = '$user_id' and b.access_code = a.access_code AND a.dept_code = c.dept_code";
	$q = mysqli_query($conn, $queryString) or die (mysqli_error($conn));
	
	if(mysqli_num_rows($q) > 0){
		while($rows = mysqli_fetch_array($q)){
			$user_id = $rows[0];
			$pcode = $rows[1];
			$name = $rows[2];
			$access_code = $rows[3];
			$status = $rows[4];
			$dept_code = $rows[5];
			$result[] = array($user_id,$pcode,$name,$access_code,$status,$dept_code);
		}
		echo json_encode(array("data"=>$result));
	}
?>