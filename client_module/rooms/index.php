<?php

	include "../../global_variables_for_mysql_connection.php";

	//if(!isset($_COOKIE["room_code"])) {
	
		//header("location:set_room_code.php");
	//}
    
    if(!isset($_GET['room_code'])){
        $message = "Please scan the QR code located in your room.";
        echo "<script type='text/javascript'>alert('$message'); open(location, '_self').close();</script>";  
    }
    else{
        $cookie_name = "room_code";
        $room_code = $_GET['room_code'];
        $cookie_value = $room_code;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        
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
    <div class="panel-heading">
     
    </div>
    <div class="panel-body">
      <form name="basicform" id="basicform" method="post" action="yourpage.html">
        
       <div id="sf3" class="frm" >
          <fieldset>

            <div class="col-xs-12">
                <h1 style="text-align: center;">Guest Request System</h1>
              </div>
              <div class="col-xs-12">
                <h4 style="text-align: center; margin-right: 17px;"><?php echo $room_code;?></h4>
              </div>

           

            <div class="form-group">
              <div class="col-xs-6">
                <a class="btn btn-primary" href = "index2.php">New Request </a> 
                <img src="spinner.gif" alt="" id="loader" style="display: none">
              </div>

             

              <div class="col-xs-6">
                <a class="btn btn-primary" href = "express_checkout.php" style="float:right;">Express Checkout </a> 
                <img src="spinner.gif" alt="" id="loader" style="display: none">
              </div>
            </div>
			<div class="clearfix" style="height: 10px;clear: both;"></div>
            <div class="form-group">

              <div class="col-lg-12" id = "all_my_requests">
               
              </div>
              <div class="clearfix" style="height: 10px;clear: both;"></div>
                <div class="col-xs-12">
                  <h6 style="text-align: center;">Information Systems Department, Club Balai Isabel</h6>
                </div>


            </div>
            
          </fieldset>
        </div>
      </form>
    </div>
  </div>


</div>
<script type="text/javascript" src="jquery.validate.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function (e) {


    
		setInterval(function()
		{ 
			$.ajax( {
			url: "ajax/refresh_rqs.php?id=" + $('#concern_cats').val(), 
			dataType: "text",
			success: function(strMessage) {

				$("#all_my_requests").html(strMessage);
					
				
				}
			});
		}, 1000);
	});
	
</script>
</body>
</html>