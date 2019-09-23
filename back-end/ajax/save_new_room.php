
<?php
	
	include "../../global_variables_for_mysql_connection.php";
	
	$room_code = $_POST['room_code'];
	$room_name = $_POST['room_name'];
	$status = $_POST['status'];
	
	$query = mysqli_query($conn, "SELECT * from tbl_rooms where room_code = '$room_code' ");
	if(mysqli_num_rows($query) > 0){
		if(mysqli_query($conn, "UPDATE tbl_rooms set room_code = '$room_code', room_desc = '$room_name', room_status = '$status' where room_code = '$room_code'")){
			echo 	"<div class='alert alert-success' role='alert'>
						User Successfully updated!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						User was not updated!".mysqli_error($conn)."
					</div>";
		}
	}
	else{
		if(mysqli_query($conn, "INSERT INTO tbl_rooms(room_code, room_desc, room_status) VALUES ('$room_code','$room_name','$status')")){
			echo 	"<div class='alert alert-success' role='alert'>
						User Successfully added!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						User was not added!".mysqli_error($conn)."
					</div>";
		}
	}

?>
