<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$r = $_GET['r'];
	$query = mysqli_query($conn, "Select * from tbl_concern_movement where guest_c_no = '$r'") or die(mysqli_error($conn));

	
	}
	?>