<?php
	include "../../global_variables_for_mysql_connection.php";
	session_start();
	$uid = $_SESSION['attuid'];
	if(isset($_POST['details'])){
		$details = $_POST['details'];
	}
	else{
		$details = "";
	}
	$rno = $_POST["rno"];
	$status_radio = $_POST["statusradio"];

	//echo("<script>console.log('status_radio: " . $status_radio . "');</script>");



	

	$query = mysqli_query($conn, "SELECT b.user_id FROM tbl_concern_movement as a, tbl_users as b where a.guest_c_no = '$rno' AND b.user_id = a.assigned_to AND action_taken = 2");
	if(mysqli_num_rows($query) > 0){
		$row = mysqli_fetch_array($query);
		$uid = $row[0];
		
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 4 where guest_c_no = '$rno'") or die(mysqli_error($conn));

		
		$checkpending = mysqli_query($conn,"SELECT count(b.guest_c_no) FROM tbl_concern_movement as a,tbl_guest_concern as b WHERE b.status <= 3 AND a.assigned_to = '$uid' ");
		$no_of_pending = mysqli_fetch_assoc($checkpending);

		$pend = $no_of_pending["count(b.guest_c_no)"];

		
		if($status_radio == 1){
			if($pend != 0){
				mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime, remarks) VALUES('$rno','$uid','3',NOW(),'$details')") or die(mysqli_error($conn));
				mysqli_query($conn , "UPDATE tbl_users set work_state = 1 WHERE user_id = '$uid'") or die(mysqli_error($conn));
				mysqli_query($conn, "UPDATE tbl_guest_concern set status = 4 where guest_c_no = '$rno'") or die(mysqli_error($conn));
				//echo "Success. Number of pending. ".$pend;
				}
			else{
				mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime, remarks) VALUES('$rno','$uid','3',NOW(),'$details')") or die(mysqli_error($conn));
				mysqli_query($conn , "UPDATE tbl_users set work_state = 0 WHERE user_id = '$uid'") or die(mysqli_error($conn));
				mysqli_query($conn, "UPDATE tbl_guest_concern set status = 4 where guest_c_no = '$rno'") or die(mysqli_error($conn));
				//echo "Success. No pending. ".$pend;
			}
		}
		else{
			if($pend != 0){
				mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime, remarks) VALUES('$rno','$uid','4',NOW(),'$details')") or die(mysqli_error($conn));
				mysqli_query($conn , "UPDATE tbl_users set work_state = 1 WHERE user_id = '$uid'") or die(mysqli_error($conn));
				mysqli_query($conn, "UPDATE tbl_guest_concern set status = 5 where guest_c_no = '$rno'") or die(mysqli_error($conn));
				//echo "Success. Number of pending. ".$pend;
				}
			else{
				mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime, remarks) VALUES('$rno','$uid','4',NOW(),'$details')") or die(mysqli_error($conn));
				mysqli_query($conn , "UPDATE tbl_users set work_state = 0 WHERE user_id = '$uid'") or die(mysqli_error($conn));
				mysqli_query($conn, "UPDATE tbl_guest_concern set status = 5 where guest_c_no = '$rno'") or die(mysqli_error($conn));
				//echo "Success. No pending. ".$pend;
			}
		}

	}
	else{
		echo "FAILED".mysqli_error($conn);
		
	}
		

?>