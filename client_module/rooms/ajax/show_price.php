<?php
	include "../../global_variables_for_mysql_connection.php";
    session_start();
	$c = $_GET['c'];
    
       $queryString = "SELECT price FROM tbl_concerns  where concern_desc = '$c'";
            $q = mysqli_query($conn, $queryString) or die (mysqli_error($conn));

            while($rows = mysqli_fetch_array($q)){
                    echo "<h2>".$rows[0]."</h2>";
                }

  
?>