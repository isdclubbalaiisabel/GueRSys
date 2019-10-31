<?php
	session_start();
    
	include "../../global_variables_for_mysql_connection.php";

	$dep = $_SESSION['dep'];
	$acc_type = $_SESSION['acc'];
	$date_now = date('Y-m-d');
	$result = array();

     if($acc_type == 'SCOO'){
       $query = mysqli_query($conn, "Select DISTINCT a.guest_c_no, a.room_code,c.concern_desc, a.details, a.date_requested, b.dept_code from tbl_guest_concern as a, tbl_concern_cate as b, tbl_concerns as c WHERE a.concern_no = c.concern_no AND c.cat_no = b.cat_no  AND a.status = 4 ORDER BY date_requested DESC") or die(mysqli_error($conn));
    }
    elseif($acc_type == 'COOR'){
        $query = mysqli_query($conn, "Select DISTINCT a.guest_c_no, a.room_code,c.concern_desc, a.details, a.date_requested, b.dept_code from tbl_guest_concern as a, tbl_concern_cate as b, tbl_concerns as c WHERE a.concern_no = c.concern_no AND c.cat_no = b.cat_no  AND a.status AND b.dept_code = '$dep' AND a.status = 4 ORDER BY date_requested DESC") or die(mysqli_error($conn));
    }
	
	if(mysqli_num_rows($query) > 0){
		
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