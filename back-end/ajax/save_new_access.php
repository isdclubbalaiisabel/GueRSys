
<?php
	
	include "../../global_variables_for_mysql_connection.php";
	
	$access_code = $_POST['access_code'];
	$access_desc = $_POST['access_desc'];
	$status = $_POST['status'];
	
	$query = mysqli_query($conn, "SELECT * from tbl_user_access where access_code = '$access_code' ");
	if(mysqli_num_rows($query) > 0){
		if(mysqli_query($conn, "UPDATE tbl_user_access set access_code = '$access_code', access_desc = '$access_desc', status = '$status' where access_code = '$access_code'")){
			echo 	"<div class='alert alert-success' role='alert'>
						Access Successfully updated!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						Access was not updated!".mysqli_error($conn)."
					</div>";
		}
	}
	else{
		if(mysqli_query($conn, "INSERT INTO tbl_user_access(access_code, access_desc, status) VALUES ('$access_code','$access_desc','$status')")){
			echo 	"<div class='alert alert-success' role='alert'>
						Access Successfully added!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						Access was not added!".mysqli_error($conn)."
					</div>";
		}
	}

?>
