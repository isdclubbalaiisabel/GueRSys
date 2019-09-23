<?php
	include "../../global_variables_for_mysql_connection.php";
	
	if(isset($_POST['set'])){
		$cookie_name = "room_code";
		$room_type = $_POST['room_type'];
		$room_code = $_POST['room_code'];
		$cookie_value = $room_type."".$room_code;
		
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		//echo "Cookie '" . $cookie_value . "' is set!<br>";
		//echo "Value is: " . $_COOKIE[$cookie_name];
		//echo "SUCCESS";
		
		header('Location: /GueRSys/client_module/rooms/index.php');
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>set_room_code</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><img class="img-fluid" src="assets/img/balai.png" style="background-image:url(&quot;assets/img/balai.png&quot;);">
                <h1 style="font-size:21px;color:rgb(103,102,108);">Guest Request System</h1>
            </div>
            <div class="form-group"><select class="form-control" name="room_type"><option value="MB" selected="">Mabini</option><option value="MV">Malvar</option><option value="RT">Recto</option></select></div>
            <div class="form-group"><input class="form-control" type="number" required="" name = "room_code" placeholder="eg: 101,207"></div>
            <div class="form-group"><input class="btn btn-primary btn-block" type="submit" name = "set" value = "Proceed" style="background-color:rgb(59,124,202);"></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>