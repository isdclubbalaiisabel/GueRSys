<?php
	include "../../../global_variables_for_mysql_connection.php";
	
	$queryString = mysqli_query($conn,"SELECT * FROM tbl_concern_cate where status = 1");
	while($rows = mysqli_fetch_array($queryString)){
		echo "<option value = '".$rows[0]."'>".$rows[1]."</option>";
	}
	
	
?>