
<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$concern_no = $_POST['concern_no'];
	$con_desc = $_POST['con_desc'];
	$cat_no = $_POST['cat_no'];
	$status = $_POST['status'];
	$item_price = $_POST['con_prc'];

	$query = mysqli_query($conn, "SELECT * from tbl_concerns where concern_no = '$concern_no' ");
	if(mysqli_num_rows($query) > 0){
		if(mysqli_query($conn, "UPDATE tbl_concerns set concern_no = '$concern_no', concern_desc = '$con_desc', cat_no = '$cat_no', status = '$status',price = '$item_price' where concern_no = '$concern_no'")){
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
		if(mysqli_query($conn, "INSERT INTO tbl_concerns(concern_desc, cat_no,status,price) VALUES ('$con_desc','$cat_no','$status','$item_price')")){
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
