<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$cat_no = $_GET['r'];
	$query = mysqli_query($conn, "SELECT a.cat_no, a.cat_desc, a.dept_code, a.status from tbl_concern_cate as a, tbl_departments as b where cat_no = '$cat_no' AND a.dept_code = b.dept_code") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$cat_no = $rows[0];
		$cat_desc = $rows[1];
		$dept_code = $rows[2];
		$status = $rows[3];
		$result[] = array($cat_no,$cat_desc,$dept_code,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
