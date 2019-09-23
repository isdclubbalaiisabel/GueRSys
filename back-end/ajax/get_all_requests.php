<?php
	session_start();
    
	include "../../global_variables_for_mysql_connection.php";

	$dep = $_SESSION['dep'];

	


	$date_now = date('Y-m-d');
	$result = array();

    if($dep == 'FO'){
        $query = mysqli_query($conn, "Select a.guest_c_no, a.room_code,c.concern_desc, a.details, a.date_requested, b.dept_code from tbl_guest_concern as a, tbl_concern_cate as b, tbl_concerns as c WHERE a.concern_no = c.concern_no AND c.cat_no = b.cat_no AND b.dept_code = '' LIKE '".$date_now."%' ORDER BY date_requested DESC") or die(mysqli_error($conn));
    }
    else{
        $query = mysqli_query($conn, "Select a.guest_c_no, a.room_code,c.concern_desc, a.details, a.date_requested, b.dept_code from tbl_guest_concern as a, tbl_concern_cate as b, tbl_concerns as c where a.concern_no = c.concern_no and c.cat_no = b.cat_no AND b.dept_code = '$dep' AND date_requested LIKE '".$date_now."%' ORDER BY date_requested DESC") or die(mysqli_error($conn));
    }
	
	if(mysqli_num_rows($query) >0){
		
		while($rows = mysqli_fetch_array($query)){
		?>
			<tr>
				<td>
					<a href= "view_request.php?r=<?php echo $rows[0];?>"><?php echo $rows[0];?></a>
				</td>
				<td>
					<?php echo $rows[1];?>
				</td>
				<td>
					<?php echo $rows[2];?>
				</td>
				<td>
					<?php echo $rows[3];?>
				</td>
				<td>
					<?php echo $rows[4];?>
				</td>
				<td>
					<?php echo $rows[5];?>
				</td>

				<?php 
					$query_stat = mysqli_query($conn, "SELECT * from tbl_concern_movement where guest_c_no = '".$rows[0]."' ORDER BY action_taken DESC LIMIT 1");
					if(mysqli_num_rows($query_stat) == 0) {
						?>
						<td>
							Pending
						</td>
						<?php
					}
					else{
						$rowstat = mysqli_fetch_array($query_stat);
							if($rowstat[3] == 0){
								?>
								<td>
									Confirmed
								</td>
								<?php

							}
							else if($rowstat[3] == 1){
								?>
								<td>
									Assigned
								</td>
								<?php

							}
							else if($rowstat[3] == 2){
								?>
								<td>
									Attendant on the way
								</td>
								<?php
								

							}
							else if($rowstat[3] == 3){
								?>
								<td>
									Completed
								</td>
								<?php
							}
                            else if($rowstat[3] == 4){
								?>
								<td>
									Rejected
								</td>
								<?php
								

							}
						
						
					}
				?>
			</tr>
		
		<?php
		}
	}
	else{
		?>
		<tr>
			<td colspan = '7' class = 'text-center'> No Request </td>
		</tr>
		<?php
	}



	
	?>