<?php
	include "../../global_variables_for_mysql_connection.php";
	
	$method = $_GET['method'];
	
	if($method == 0){
		
		
	}
	else if($method == 1){
		$id = $_GET['id'];
		$tbl = $_GET['tbl'];
		if($tbl == 'concern_cat'){
			$queryString = "SELECT * FROM tbl_concern_cate where cat_no = '$id'";
		}
		else{
			$queryString = "SELECT concern_desc FROM tbl_concerns where concern_no = '$id'";
		}
		
	
		$q = mysqli_query($conn, $queryString) or die (mysqli_error($conn));
		
		if(mysqli_num_rows($q) > 0){
			if($tbl == 'concern_cat'){
				while($rows = mysqli_fetch_array($q)){
					echo "<option value = '".$rows[0]."'>".$rows[1]."</option>";
				}
			}
			else{
				$rows = mysqli_fetch_array($q);
				echo $rows[0];
			}
			
		}
		else{
			echo "NO RESULTS FOUND!";
		}
		
	}
	
?>