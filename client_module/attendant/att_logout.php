<?php
	session_start();
	include "../../global_variables_for_mysql_connection.php";
	
	$user_id = $_SESSION['attuid'];

	mysqli_query($conn,"UPDATE tbl_users set login_state = 0 WHERE user_id = '$user_id'");

	session_destroy();
	header("Location: set_phone_account.php");
?>