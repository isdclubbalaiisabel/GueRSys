<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$concern_no = $_GET['r'];
	$query = mysqli_query($conn, "SELECT a.concern_no, a.concern_desc, a.cat_no, a.status from tbl_concerns as a where a.concern_no = '$concern_no'") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$concern_no = $rows[0];
		$concern_desc = $rows[1];
		$status = $rows[3];
		$cat_desc = $rows[2];
		$result[] = array($concern_no,$concern_desc,$cat_desc,$status);
	
	}
	echo json_encode(array("data"=>$result));
	?>
