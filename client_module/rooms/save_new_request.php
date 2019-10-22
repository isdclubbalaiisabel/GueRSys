<?php
	include "../../global_variables_for_mysql_connection.php";
	
	$concernId = $_POST['concerns'];
	$room_code = $_COOKIE["room_code"];
	$details = $_POST['details'];
	$status = 1;

	$req_id = $room_code."-".date("ymd-his");
	if(mysqli_query($conn, "INSERT INTO tbl_guest_concern VALUES ('$req_id',NOW(),'$concernId','$details','$room_code','$status')")){
		if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no,assigned_to,action_taken,datetime) VALUES ('$req_id','','0',NOW())")){


			function sendMessage() {
			    $content      = array(
			        "en" => 'New Concern!'
			    );
			    
			    $fields = array(
			    	//LOCALHOST
			        // 'app_id' => "46aa99c6-3eae-46b1-8b71-8066805984f9",
			        //LIVE
			        'app_id' => "695fab03-f980-47e8-9d16-ce5be4774c1d",
			        'included_segments' => array(
			            'All'
			        ),
			        //LOCALHOST 
			        // 'url' => "http://localhost/GueRSys/back-end/modules/all_request.php",
			        //LIVE
			        'url' => "http://grs.balaiisabel.com/back-end/modules/all_request.php",
			        'data' => array(
			            "foo" => "bar"
			        ),
			        'contents' => $content,
			    );
			    
			    $fields = json_encode($fields);
			    print("\nJSON sent:\n");
			    print($fields);
			    
			    $ch = curl_init();
			    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			        'Content-Type: application/json; charset=utf-8',
			        //LOCALHOST
			        // 'Authorization: Basic Y2Q0ZGM0YTctMGY1OC00MzlmLWI3OGEtNzUyYzgxZGRmOTA2'
			        //LIVE
			        'Authorization: Basic OWVmNTEzY2MtNjFmOC00YzE3LTk5MWMtN2EzODFhYzcxY2Yw'
			    ));
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			    curl_setopt($ch, CURLOPT_HEADER, FALSE);
			    curl_setopt($ch, CURLOPT_POST, TRUE);
			    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			    
			    $response = curl_exec($ch);
			    curl_close($ch);
			    
			    return $response;
			}

			$response = sendMessage();
			$return["allresponses"] = $response;
			$return = json_encode($return);

			$data = json_decode($response, true);
			//print_r($data);
			$id = $data['id'];
			//print_r($id);

			//print("\n\nJSON received:\n");
			//print($return);
			//print("\n");




			echo 	"<div class='alert alert-success'>
					<center>
					<p><img src = 'imgs/success.png'></img><p>
					<h2><strong>Your request has been recorded!</strong></h2>
					<p>
						Please wait for our Kabalai to attend your concern.
					</p>
					<p>
						System will redirect after 5 seconds.
					</p>
					</center>
				</div>";
		}
		else{
		echo "FAILED".mysqli_error($conn);
		
		}	
	}
	else{
		echo "FAILED".mysqli_error($conn);
		
	}
		

?>

