<?php
	
	include "../../global_variables_for_mysql_connection.php";
	require_once dirname(dirname(__FILE__)) . "../../telerivet/telerivet.php";

	$api_key = "1Cx0h_ddGlRilCx5n1zogB77ZgNOCFxwTbuj"; 
	$project_id = "PJ316ce1e83d7200d3";
	
	//Guest Concern No
	$r = $_POST['r'];

	//Assign to = Attendant
	//$assign_to = $_POST['assign_to'];

	$sql_get_dept = "SELECT DISTINCT a.guest_c_no, b.dept_code from tbl_guest_concern as a, tbl_concern_cate as b, tbl_concerns as c WHERE a.concern_no = c.concern_no AND c.cat_no = b.cat_no AND guest_c_no = '$r'";
	$sql_get_dept_result = mysqli_query($conn,$sql_get_dept );
	$get_dept = mysqli_fetch_assoc($sql_get_dept_result);

	if($get_dept["dept_code"] == "ENGR"){
		$sql_auto_assign = "SELECT `user_id`,`name` FROM `tbl_users` WHERE status = 1 AND work_state = 0 AND login_state = 1 AND dept_code = 'ENGR' ORDER BY RAND() LIMIT 1";
		$sql_auto_assign_result = mysqli_query($conn,$sql_auto_assign);
		$get_att = mysqli_fetch_assoc($sql_auto_assign_result);
		$assign_to = $get_att["user_id"];
	}
	
	if($get_dept["dept_code"] == "HKD"){
		$sql_auto_assign = "SELECT `user_id`,`name` FROM `tbl_users` WHERE status = 1 AND work_state = 0 AND login_state = 1 AND dept_code = 'HKD' ORDER BY RAND() LIMIT 1";
		$sql_auto_assign_result = mysqli_query($conn,$sql_auto_assign);
		$get_att = mysqli_fetch_assoc($sql_auto_assign_result);
		$assign_to = $get_att["user_id"];
	}



	if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$r','$assign_to','1',NOW())")){
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 2 where guest_c_no = '$r'") or die(mysqli_error($conn));

		//Get contact number
		$sql_contact_no = "SELECT contact_no FROM tbl_users where user_id = '$assign_to'";
		$sql_contact_no_result = mysqli_query($conn,$sql_contact_no);
		$c_no = mysqli_fetch_assoc($sql_contact_no_result);
		
		//Get concern details
		$sql_con_det = "SELECT DISTINCT b.room_code, a.concern_desc, b.guest_c_no, b.details from tbl_concerns as a, tbl_guest_concern as b, tbl_concern_movement as c where a.concern_no = b.concern_no AND c.guest_c_no = b.guest_c_no AND c.assigned_to = '$assign_to' AND c.guest_c_no = '$r'";
		$sql_con_det_result = mysqli_query($conn,$sql_con_det);
		$con_det = mysqli_fetch_assoc($sql_con_det_result);


		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
		    $to_number = $c_no["contact_no"];
		    $content = "GRS-CBI\n Assigned to: ".$get_att["user_id"]." ".$get_att["name"]." \n Concern Number: " .$r."\n Room: ".$con_det["room_code"]." \n Concern: ".$con_det["concern_desc"]."\n Details:  ".$con_det["details"]."";
		    
		    $api = new Telerivet_API($api_key);
		    
		    $project = $api->initProjectById($project_id);
		    
		    try
		    {
		        $contact = $project->sendMessage(array(
		            'to_number' => $to_number,
		            'content' => $content
		        ));
		        
		        echo "<div class='alert alert-success' role='alert'>
					Assignment Successfully added / SMS Sent!
				</div>";

		    }
		    catch (Telerivet_Exception $ex)
		    {
		        echo "<div class='alert alert-danger' role='alert'>
					SMS Didnt send.".$ex."
				</div>";
		    }
		}
	}

	/*if(mysqli_query($conn, "UPDATE tbl_concern_movement set assigned_to = '$assign_to', action_taken = '0', datetime = NOW() where guest_c_no = '$r' ")){
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 2 where guest_c_no = '$r'") or die(mysqli_error($conn));
		echo 	"<div class='alert alert-success' role='alert'>
					Assignment Successfully added!
				</div>";
	}	*/
	else{
		echo 	"<div class='alert alert-danger' role='alert'>
					Assignment was not added!".mysqli_error($conn)."
				</div>";
	}
	

?>
