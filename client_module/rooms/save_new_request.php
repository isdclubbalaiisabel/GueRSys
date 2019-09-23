<?php
	include "../../global_variables_for_mysql_connection.php";
	
	$concernId = $_POST['concerns'];
	$room_code = $_COOKIE["room_code"];
	$details = $_POST['details'];
	$status = 1;

	$req_id = $room_code."-".date("ymd-his");
	if(mysqli_query($conn, "INSERT INTO tbl_guest_concern VALUES ('$req_id',NOW(),'$concernId','$details','$room_code','$status')")){
		if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no,assigned_to,action_taken,datetime) VALUES ('$req_id','','0',NOW())")){
			echo 	"<div class='alert alert-success'>
					<center>
					<p><img src = 'imgs/success.png'></img><p>
					<h2><strong>Your request has been recorded!</strong></h2>
					<p>
						Please wait for our Kabalai to attend your concern.
					</p>
					<p>
						System will redirect after 5 seconds.
					</p>
					</center>
				</div>";
		}
		else{
		echo "FAILED".mysqli_error($conn);
		
		}	
	}
	else{
		echo "FAILED".mysqli_error($conn);
		
	}
		

?>