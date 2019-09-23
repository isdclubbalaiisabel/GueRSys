<?php
	include "../../global_variables_for_mysql_connection.php";
	$result = array();
	$query = mysqli_query($conn, "SELECT a.concern_no, a.concern_desc, b.cat_desc, IF(a.status = 1, 'Active', 'Inactive'),a.price from tbl_concerns as a, tbl_concern_cate as b where a.cat_no = b.cat_no") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($query)){
		
		$concern_no = $rows[0];
		$concern_desc = $rows[1];
		$cat_desc = $rows[2];
		$status = $rows[3];
		$price = $rows[4];

		$result[] = array($concern_no,$concern_desc,$cat_desc,$status,$price);
	
	}


	echo json_encode(array("data"=>$result));
	?>
