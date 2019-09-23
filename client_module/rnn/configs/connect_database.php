<?php
	include "global_variables_for_mysql_connection.php";


	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>