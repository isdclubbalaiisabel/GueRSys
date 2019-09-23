<?php
	
	include "../../global_variables_for_mysql_connection.php";
	$r = $_GET['r'];
	$query = mysqli_query($conn, "Select * from tbl_guest_concern where guest_c_no = '$r'") or die(mysqli_error($conn));

	while($rows = mysqli_fetch_array($query)){
	?>
		<tr>
			<td>
				<?php echo $rows[0];?>
			</td>
			<td>
				Requested by guest.
			</td>
			<td>
				<?php echo $rows[1];?>
			</td>
			<td>
				Guest
			</td>
	<?php
	}
	
	$query = mysqli_query($conn, "Select a.guest_c_no, b.name, b.access_code, a.action_taken, a.datetime from tbl_concern_movement as a, tbl_users as b where a.assigned_to = b.user_id AND guest_c_no = '$r'") or die(mysqli_error($conn));
	if(mysqli_num_rows($query) == 0){
		?>
			<tr>
				<td colspan = 4>
					No Movement Yet
				</td>
			</tr>
		<?php
		//mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no, assigned_to, action_taken, datetime) VALUES('$r','','0',NOW())") or die(mysqli_error($conn));
		mysqli_query($conn, "UPDATE tbl_guest_concern set status = 1 where guest_c_no = '$r'") or die(mysqli_error($conn));
	}
	else{
		
		while($rows = mysqli_fetch_array($query)){
		?>
			<tr>
				<td>
					<?php echo $rows[0];?>
				</td>
				<td>
                    
					<?php 
                    
					switch ($rows[3]){
						case 0:
							echo "Confirmed by ".$rows[2]." ".$rows[1];
							break;
						case 1:
							echo "Assigned to ".$rows[2]." ".$rows[1];
							break;
                        case 2:
							echo "Confirmed by ".$rows[2]." ".$rows[1];
							break;
						case 3:
							echo "Request completed by ".$rows[2]." ".$rows[1];
							break;
                        case 4:
							echo "Attended but failed to deliver - ".$rows[2]." ".$rows[1];
							break;
						default:
							echo "";
					}
					?>
				</td>
				<td>
					<?php echo $rows[4];?>
				</td>
				<td>
					<?php echo $rows[1];?>
				</td>
				
			</tr>
		
		<?php
		}
	}
	?>