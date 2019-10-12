<?php
	session_start();
	include "../../global_variables_for_mysql_connection.php";

	if($_SESSION['attuid'] === null) {
		header("location:set_phone_account.php");
	}
	
	
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <title>Attendant</title>

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
      <form name="basicform" id="basicform" method="post" action="att_logout.php">
        
       <div id="sf3" class="frm" >

          <fieldset>
            
              <button type="submit" name="logout" style="float:right;" class="btn btn-primary">Log out</button>
            
            <div class="clearfix" style="height: 10px;clear: both;"></div>
            <div class="form-group">
                <h2 style="text-align: center;"> <?php echo $_SESSION['uname'];?></h2>
                <h4 style="text-align: center;"> <?php echo $_SESSION['dep']; ?></h4>
            </div>
			<div class="clearfix" style="height: 10px;clear: both;"></div>
            <div class="form-group">

              <div class="col-lg-12" id = "all_my_requests">
               
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
			url: "ajax/refresh_my_rqs.php?", 
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