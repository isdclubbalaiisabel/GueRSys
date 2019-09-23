<?php
	session_start();
	include "../../global_variables_for_mysql_connection.php";
    
	$u = $_POST['username'];
	$p = $_POST['password'];
	$query = mysqli_query($conn, "SELECT * from tbl_users where user_id = '$u' and passcode = '$p' and status = 1 ") or die(mysqli_error($conn));
	if(mysqli_num_rows($query) >0){
		$rows = mysqli_fetch_array($query);
		$_SESSION['uid'] = $rows[0];
		$_SESSION['uname'] = $rows[2];
		$_SESSION['acc'] = $rows[3];
		$_SESSION['dep'] = $rows[4];
		if($rows[3] == 'ADMN'){
			echo "1";
		}
		else if($rows[3] == 'COOR'){
			echo "2";
		}
		else if($rows[3] == 'SCOO'){
			echo "2";
		}
		else{
			echo "0";
            echo("<script>console.log('Debug: Login fail" . $_SESSION['uid'] . "');</script>");
		}
		
	}
	else{
		echo "0";
        
	}

	?>
