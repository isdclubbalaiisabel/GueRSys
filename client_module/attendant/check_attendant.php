<?php
	include "../../global_variables_for_mysql_connection.php";
	
	$pcode = $_POST['pcode'];
	$rno = $_POST["rno"];
	

	$query = mysqli_query($conn, "SELECT b.user_id FROM tbl_concern_movement as a, tbl_users as b where a.guest_c_no = '$rno' AND b.user_id = a.assigned_to AND b.passcode = '$pcode' AND action_taken = 1");
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_array($query);
		$uid = $row[0];
		mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$rno','$uid','2',NOW())");
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 3 where guest_c_no = '$rno'") or die(mysqli_error($conn));
		echo "Success";
	}
	else{
		echo "FAILED".mysqli_error($conn);
		
	}
		

?>