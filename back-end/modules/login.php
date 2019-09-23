<?php 
	include "../../global_variables_for_mysql_connection.php";
	if(isset($_SESSION['uid'])){
		header("location: ../index.php");
	}
?>


<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form id = "loginform">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" name="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
	<script>
		$(document).ready(function (e) {
			$(loginform).on('submit',(function(e) {
				e.preventDefault();
				$.ajax({
				url: "../ajax/get_creds.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(result)   // A function to be called if request succeeds
				{
					
					if(result == 1){
						window.location = "../index.php";
					}
					else if (result == 2){
						window.location = "all_request.php";
					}
					else{	
                        console.log("Login fail");
						$('#loginform')[0].reset();
					}
                    
                    console.log(result);
					
				}
				});
			}));
		});
		</script>
</body>
 
</html>