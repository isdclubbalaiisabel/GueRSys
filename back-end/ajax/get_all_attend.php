<?php
	include "../../global_variables_for_mysql_connection.php";
    session_start();
	$dept = $_GET['dept'];
	$r = $_GET['r'];
    $acc_type = $_SESSION['acc'];

    //echo("<script>console.log('Debug: " . $dept . "');</script>");
    
	$query = mysqli_query($conn, "SELECT a.action_taken FROM tbl_concern_movement as a, tbl_users as b where a.action_taken IN(1,3,4) and guest_c_no = '$r' AND b.user_id = a.assigned_to ORDER BY a.action_taken DESC LIMIT 1");
	
    if(mysqli_num_rows($query) > 0){
		$rowA = mysqli_fetch_array($query);
        $rejectstat = $rowA[0];
        echo $rejectstat;
      
	}
    
   
	else{
        
		if($acc_type == 'SCOO'){
            $queryString = "SELECT * FROM tbl_users where access_code = 'ATTE' AND status = 1 AND work_state = 0 AND login_state = 1 order by dept_code DESC";
            $q = mysqli_query($conn, $queryString) or die (mysqli_error($conn));

            if(mysqli_num_rows($q) > 0){
                while($rows = mysqli_fetch_array($q)){
                    echo "<option value = '".$rows[0]."'>".$rows[2].' Dept: '.$rows[4]."</option>";
                }
            }
            else{
                 echo "5";
            }

        }
        else{
            $queryString = "SELECT * FROM tbl_users where dept_code = '$dept' AND access_code = 'ATTE' AND status = 1 AND work_state = 0 AND login_state = 1 order by dept_code DESC";
            $q = mysqli_query($conn, $queryString) or die (mysqli_error($conn));

            if(mysqli_num_rows($q) > 0){
                
                while($rows = mysqli_fetch_array($q)){
                    echo "<option value = '".$rows[0]."'>".$rows[2]."</option>";
                }
            }
            else{
                 echo "5";
            }  
        }
	}
?>