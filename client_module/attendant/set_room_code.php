<?php
	include "../../global_variables_for_mysql_connection.php";
?>

<html>
	<head>
	
	</head>
	
	<body>
		<form method = "POST" action = "set_room_code.php">
			<input type = "text" name = "room_code" />
			<input type = "submit" name = "set" value = "set" />
			
		</form>
	</body>

</html>

<?php
	if(isset($_POST['set'])){
		$cookie_name = "room_code";
		$cookie_value = $_POST['room_code'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		echo "Cookie '" . $cookie_name . "' is set!<br>";
		echo "Value is: " . $_COOKIE[$cookie_name];
		echo "SUCESS";
	}
?>