
<?php
	
	include "../../global_variables_for_mysql_connection.php";
	
	$dept_code = $_POST['dept_code'];
	$dept_name = $_POST['dept_name'];
	$status = $_POST['status'];
	
	$query = mysqli_query($conn, "SELECT * from tbl_departments where dept_code = '$dept_code' ");
	if(mysqli_num_rows($query) > 0){
		if(mysqli_query($conn, "UPDATE tbl_departments set dept_code = '$dept_code', dept_name = '$dept_name', status = '$status' where dept_code = '$dept_code'")){
			echo 	"<div class='alert alert-success' role='alert'>
						Department Successfully updated!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						Department was not updated!".mysqli_error($conn)."
					</div>";
		}
	}
	else{
		if(mysqli_query($conn, "INSERT INTO tbl_departments(dept_code, dept_name, status) VALUES ('$dept_code','$dept_name','$status')")){
			echo 	"<div class='alert alert-success' role='alert'>
						Department Successfully added!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						Department was not added!".mysqli_error($conn)."
					</div>";
		}
	}

?>
