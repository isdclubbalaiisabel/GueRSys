<?php

    //LOCALHOST

	/*$servername = "localhost";
	$username = "root";
	$password = "root";
	$database = "db_grs";*/
	
    //WEBHOST
    $servername = "grs.balaiisabel.com";
    $username = "balaiisa_grs";
    $password = "[isd2019*W0w]";
    $database = "balaiisa_db_grs";
	
	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

    
?>