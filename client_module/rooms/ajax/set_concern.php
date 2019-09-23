<?php
	include "../../../global_variables_for_mysql_connection.php";
	$id = $_GET['id'];
	$queryString = mysqli_query($conn,"SELECT * FROM tbl_concerns where status = 1 AND cat_no = '$id'") or die(mysqli_error($conn));
	while($rows = mysqli_fetch_array($queryString)){
		echo "<option value = '".$rows[0]."'>".$rows[1]." ".$rows[4]."</option>";
	}
	
	
?>