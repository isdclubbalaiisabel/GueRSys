<?php
	session_start();
	include "../../global_variables_for_mysql_connection.php";

	if($_SESSION['attuid'] != null) {
		header("location:index.php");
	}
	
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" />
   

    <title> a</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="bootstrap/html5shiv.js"></script>
      <script src="bootstrap/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery-1.11.1.min.js"></script>
	
<style>
  ul#stepForm, ul#stepForm li {
    margin: 0;
    padding: 0;
  }
  ul#stepForm li {
    list-style: none outside none;
  } 
  label{margin-top: 10px;}
  .help-inline-error{color:red;}
</style>
  </head>
  <body>

<div class="container" >
	<div class="panel panel-primary">
		<div class="panel-body">
			<form name="basicform" id="basicform" method="post">

				<div id="sf3" class="frm" >

					<div class="form-group">
						<label class="col-lg-2 control-label" for="concerns">Username: </label>
						<div class="col-lg-10">
							<input type = "text" name = "user_id" class = "form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label" for="concerns">Passcode: </label>
						<div class="col-lg-10">
							<input type = "password" name = "passcode" class = "form-control" />
						</div>
					</div>
					<div class="clearfix" style="height: 10px;clear: both;">
					</div>
					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							<button class="btn btn-primary open3" type="submit">Confirm </button> 
							<img src="spinner.gif" alt="" id="loader" style="display: none">
						</div>
					</div>
				</div>
			</form>
		</div>
	
	</div>


</div>
<script type="text/javascript" src="jquery.validate.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function (e) {
		$('#basicform').on('submit',(function(e) {
			e.preventDefault();
			

			$.ajax({
			url: "check_creds.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				if(data == 1){
				    $("#loader").show();
    				 setTimeout(function(){
    				  
    					   $(location).attr('href', 'index.php')
    					 
    				 }, 1000);
				}
				else{
				    alert("Invalid username / password");
				}
			}
			});
		}));
		
		
		
	});

</script>
</body>
</html>