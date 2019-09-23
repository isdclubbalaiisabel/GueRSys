<?php
	session_start();
	include "../../global_variables_for_mysql_connection.php";
	
	$user_id = $_POST['user_id'];
	$passcode = $_POST['passcode'];
	$status = 1;
	$access_code = "ATTE";

	$query = mysqli_query($conn, "SELECT a.user_id, a.name, a.access_code, b.dept_name from tbl_users as a, tbl_departments as b where a.dept_code = b.dept_code AND a.user_id = '$user_id' and a.passcode = '$passcode' and a.status = 1 AND a.access_code = '$access_code' ") or die(mysqli_error($conn));
	if(mysqli_num_rows($query) >0){
		$rows = mysqli_fetch_array($query);
		$_SESSION['attuid'] = $rows[0];
		$_SESSION['uname'] = $rows[1];
		$_SESSION['acc'] = $rows[2];
		$_SESSION['dep'] = $rows[3];
		mysqli_query($conn,"UPDATE tbl_users set login_state = '1' where user_id = '$user_id'");
		echo "1";
	}
	else{
		echo "0";
	}
		

?>