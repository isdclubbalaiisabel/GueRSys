<?php
	include "../../../global_variables_for_mysql_connection.php";
	$room = $_COOKIE['room_code'];
	$date_now = date('Y-m-d');
	$queryString = mysqli_query($conn,"SELECT a.concern_desc, b.date_requested, b.status FROM tbl_concerns as a, tbl_guest_concern as b where a.concern_no = b.concern_no AND b.room_code = '$room' and b.status IN (0,1,2,3,4) AND date_requested LIKE '".$date_now."%'") or die(mysqli_error($conn));
	?>
	<table class="table table-bordered " >
		<thead>
			<tr>
				<th>Concern</th>
				<th>Date/ Time Requested</th>
				<th>Status</th>
				
			</tr>
		</thead>
										
	<?php
	
	while($rows = mysqli_fetch_array($queryString)){
		?>
			<tr>
				<td>
					<?php echo $rows[0];?>
				</td>
				<td>
					<?php echo $rows[1];?>
				</td>
				<td>
					<?php
					switch ($rows[2]){
						case 0:
							echo "For assessment";
							break;
						case 1:
							echo "Pending";
							break;
						case 2:
							echo "Processing";
							break;
						case 3:
							echo "Request Acknowledged";
							break;
						case 4:
							echo "Done";
							break;
					}
					
					?>
				</td>
			</tr>
		<?php
	}
	
	
?>

		
	</table>