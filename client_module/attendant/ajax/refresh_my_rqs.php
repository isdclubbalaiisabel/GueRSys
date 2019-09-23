<?php
	session_start();
	include "../../../global_variables_for_mysql_connection.php";
	$uid = $_SESSION['attuid'];
	
	$date_now = date('Y-m-d');
	$queryString = mysqli_query($conn,"SELECT b.room_code, a.concern_desc, b.guest_c_no from tbl_concerns as a, tbl_guest_concern as b, tbl_concern_movement as c where a.concern_no = b.concern_no  AND c.guest_c_no = b.guest_c_no AND c.assigned_to = '$uid' AND date_requested LIKE '".$date_now."%' GROUP BY(guest_c_no) ORDER BY c.action_taken") or die(mysqli_error($conn));
	?>
	<table class="table table-bordered " >
		<thead>
			<tr>
				<th>Room</th>
				<th>Request</th>
				<th>Status</th>
			</tr>
		</thead>
										
	<?php
	
	while($rows = mysqli_fetch_array($queryString)){
		$req = $rows[2];
		$q = mysqli_query($conn, "SELECT action_taken FROM tbl_concern_movement where guest_c_no = '$req' AND action_taken IN (1,2,3,4,5) AND assigned_to = '$uid' ORDER BY action_taken DESC LIMIT 1");
		$ro = mysqli_fetch_array($q);
		$status = $ro[0];
?>
			<tr>
				<td>
				<?php
                   
                   
        
					if($status == 3){
						echo $rows[0];
					}
					else if($status == 2){
						?>
						<a href = "attentand_done.php?r=<?php echo $rows[2];?>" ><?php echo $rows[0];?> </a>
					
						<?php
					}
					elseif($status == 1){
						?>
						<a href = "get_details.php?r=<?php echo $rows[2];?>" ><?php echo $rows[0];?> </a>
					
						<?php
					}
					else{
						echo $rows[0];
					}
				
					
					
					?>
				</td>
				<td>
					<?php echo $rows[1];?>
				</td>
				<td>
					<?php 
						
						switch($status){
							
							case 1:
								echo "For Confirmation";
								break;
							case 2:
								echo "Confirmed";
								break;
                            case 3:
								echo "Done";
								break;
							case 4:
								echo "Failed";
								break;
                            
						}
						
					?>
				</td>
			</tr>
		<?php
	}
	
	
?>
	</table>