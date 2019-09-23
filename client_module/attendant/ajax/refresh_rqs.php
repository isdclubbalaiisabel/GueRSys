<?php
	include "../../../global_variables_for_mysql_connection.php";
	$room = $_COOKIE['room_code'];
	$date_now = date('Y-m-d');
	$queryString = mysqli_query($conn,"SELECT a.concern_desc, b.date_requested, b.status, b.guest_c_no FROM tbl_concerns as a, tbl_guest_concern as b where a.concern_no = b.concern_no AND b.room_code = '$room' and b.status IN (0,1,2,3,4) AND date_requested LIKE '".$date_now."%'") or die(mysqli_error($conn));
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
		$ahref = "";
		$status = "";
		
		switch ($rows[2]){
			case 0:
				$ahref = $rows[0];
				$status =  "Pending";
				break;
			case 1:
				$ahref = $rows[0];
				$status =  "Processing";
				break;
				
			case 2:
				$ahref = $rows[0];
				$status =  "Processing";
				break;
				
			case 3:
				$ahref = $rows[0];
				$status =  "Processing";
				break;
				
				
			case 4:
				$ahref = "<a href = 'attentand_done.php?r=".$rows[3]."' >" .$rows[0]. "</a>";
				$status =  "Executing";
				break;
			case 5:
				$status =  "Done";
				break;
		}
		?>
			<tr>
				<td>
					<?php echo $ahref;?>
				</td>
				<td>
					<?php echo $rows[1];?>
				</td>
				<td>
					<?php
					echo $status;
					
					?>
				</td>
			</tr>
		<?php
	}
	
	
?>
	</table>