
<?php
	
	include "../../global_variables_for_mysql_connection.php";
	
	$r = $_POST['r_oos'];
	$remarks = $_POST['remarks'];
	$query = mysqli_query($conn, "SELECT a.assigned_to FROM tbl_concern_movement as a where a.action_taken = 1 and a.guest_c_no = '$r'");
	$rows= mysqli_fetch_array($query);

   

	$id = $rows[0];
	if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$r','$id','3',NOW())")){
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 3 where guest_c_no = '$r'") or die(mysqli_error($conn));
		echo 	"<div class='alert alert-success' role='alert'>
					Successfully saved!
				</div>";
	}
	else{
		echo 	"<div class='alert alert-danger' role='alert'>
					Not Saved!".mysqli_error($conn)."
				</div>";
	}
	

?>
