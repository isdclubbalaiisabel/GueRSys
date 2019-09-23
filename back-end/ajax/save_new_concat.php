
<?php

	include "../../global_variables_for_mysql_connection.php";
	$cat_no = $_POST['cat_no'];
	$cat_desc = $_POST['cat_desc'];
	$dept_code = $_POST['dept_code'];
	$status = $_POST['status'];

	$query = mysqli_query($conn, "SELECT * from tbl_concern_cate where cat_no = '$cat_no' ");
	if(mysqli_num_rows($query) > 0){
		if(mysqli_query($conn, "UPDATE tbl_concern_cate set cat_desc = '$cat_desc', dept_code = '$dept_code', status = '$status' where cat_no = '$cat_no'")){
			echo 	"<div class='alert alert-success' role='alert'>
						Category Successfully updated!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						Category was not updated!".mysqli_error($conn)."
					</div>";
		}
	}
	
	else{
		if(mysqli_query($conn, "INSERT INTO tbl_concern_cate(cat_desc, dept_code,status) VALUES ('$cat_desc','$dept_code','$status')")){
			echo 	"<div class='alert alert-success' role='alert'>
						Category Successfully added!
					</div>";
		}
		else{
			echo 	"<div class='alert alert-danger' role='alert'>
						Category was not added!".mysqli_error($conn)."
					</div>";
		}
	}

?>
