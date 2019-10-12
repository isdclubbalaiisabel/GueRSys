
<?php
	
	include "../../global_variables_for_mysql_connection.php";
	
	$access_code = $_POST['access_code'];
	$dept_code = $_POST['dept_code'];
	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$pcode = $_POST['pcode'];
	$status = $_POST['status'];
	
	$query = mysqli_query($conn, "SELECT * FROM tbl_users where user_id = '$user_id'");
	if(mysqli_num_rows($query) > 0){
		if(mysqli_query($conn, "UPDATE tbl_users set name = '$user_name', passcode = '$pcode', status = '$status', access_code = '$access_code', dept_code = '$dept_code' where user_id = '$user_id'")){
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
		if(mysqli_query($conn, "INSERT INTO tbl_users(user_id, passcode, name, access_code, dept_code,status) VALUES ('$user_id','$pcode','$user_name','$access_code','$dept_code','$status')")){
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
