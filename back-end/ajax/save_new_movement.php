<?php
	
	include "../../global_variables_for_mysql_connection.php";
	
	
	$r = $_POST['r'];
	$assign_to = $_POST['assign_to'];

	if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$r','$assign_to','1',NOW())")){
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 2 where guest_c_no = '$r'") or die(mysqli_error($conn));
		echo 	"<div class='alert alert-success' role='alert'>
					Assignment Successfully added!
				</div>";



	

	}

	/*if(mysqli_query($conn, "UPDATE tbl_concern_movement set assigned_to = '$assign_to', action_taken = '0', datetime = NOW() where guest_c_no = '$r' ")){
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 2 where guest_c_no = '$r'") or die(mysqli_error($conn));
		echo 	"<div class='alert alert-success' role='alert'>
					Assignment Successfully added!
				</div>";
	}	*/
	else{
		echo 	"<div class='alert alert-danger' role='alert'>
					Assignment was not added!".mysqli_error($conn)."
				</div>";
	}
	

?>
