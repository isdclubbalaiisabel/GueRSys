<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$query = mysqli_query($conn, "SELECT a.user_id, a.name,  c.dept_code, b.access_code, if(a.status = 1, 'Active', 'Inactive'),a.contact_no from tbl_users as a, tbl_user_access as b, tbl_departments as c where a.access_code = b.access_code and a.dept_code = c.dept_code ORDER BY a.name ") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$user_id = $rows[0];
		$name = $rows[1];
		$dept_code = $rows[2];
		$access_code = $rows[3];
		$status = $rows[4];
		$contact_no = $rows[5];
		
		$result[] = array($user_id,$name,$dept_code,$access_code,$status,$contact_no);
	
	}
	echo json_encode(array("data"=>$result));
	?>
