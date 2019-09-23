<?php
	
	include "../../global_variables_for_mysql_connection.php";

	$queryString = "SELECT * FROM tbl_concern_cate where status = 1";
	$q = mysqli_query($conn, $queryString) or die (mysqli_error($conn));
	
	if(mysqli_num_rows($q) > 0){
		while($rows = mysqli_fetch_array($q)){
			echo "<option value = '".$rows[0]."'>".$rows[1]."</option>";
		}
	}
?>