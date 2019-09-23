<?php 
	session_start();
	include "../../global_variables_for_mysql_connection.php";
	$r = $_POST['r'];
	$uid = $_SESSION['attuid'];
	$response = $_GET['response'];
	$res = 0;
	if($response == "accept"){
		$res = 2;
		$query = "UPDATE tbl_guest_concern set status = 3 where guest_c_no = '$r'";
        
        if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$r','$uid','$res',NOW())")){

            mysqli_query($conn , "UPDATE tbl_users set work_state = 1 WHERE user_id = '$uid'");

            if(mysqli_query($conn, $query)){
                echo $r;
            }
            else{
                echo "0";
            }
        }
        else
        {
            echo "0";
        }
        
	}
	else{
		$res = 4;
		$query = "UPDATE tbl_guest_concern set status = 4 where guest_c_no = '$r'";
        
        if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$r','$uid','$res',NOW())")){
            if(mysqli_query($conn, $query)){
                echo $r;
            }
            else{
                echo "0";
            }
        }
        else
        {
            echo "0";
        }
	}

	
?>