
<?php
	session_start();
	include "../../global_variables_for_mysql_connection.php";
	$r = $_GET['r'];

	if(!isset($_SESSION['attuid'])) {
	
		header("location:set_phone_account.php");
	}
	$query = mysqli_query($conn, "SELECT a.room_code, a.date_requested, b.concern_desc ,a.details FROM tbl_guest_concern as a, tbl_concerns as b,tbl_guest_concern as c where a.guest_c_no = '$r' AND b.concern_no = c.concern_no AND a.guest_c_no = c.guest_c_no") or die(mysqli_error($conn));
	$rows = mysqli_fetch_array($query);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  

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
        
       <div id="sf3" class="frm">
          <fieldset>
           

            <div class="form-group">
              <h3 class="col-lg-2 control-label" for="upass1">Room: </h3>
              <div class="col-lg-6">
                <h2 ><?php echo $rows[0];?></h2>
              </div>
            </div>
            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
              <h3 class="col-lg-2 control-label" for="upass1">Date Requested: </h3>
              <div class="col-lg-6">
				<h2 ><?php echo $rows[1];?></h2>
              </div>
            </div>

            <div class="clearfix" style="height: 10px;clear: both;"></div>
			<div class="form-group">
              <h3 class="col-lg-2 control-label" for="upass1">Concerns: </h3>
              <div class="col-lg-6">
				<h2 ><?php echo $rows[2]." - ".$rows[3];?></h2>
              </div>
            </div>

            <div class="clearfix" style="height: 10px;clear: both;"></div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
				<input type = "hidden" name = "r" value = "<?php echo $r;?>" />
                <!--<button class="btn btn-warning back3" name = "reject" type="submit">Reject</button> -->
                <button class="btn btn-primary open3" name = "accept" type="submit">Accept </button> 
                <img src="spinner.gif" alt="" id="loader" style="display: none">
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
		
		var buttonpressed;
		$('.btn').click(function() {
			  buttonpressed = $(this).attr('name')
		});
		
		
		$('#basicform').on('submit',(function(e) {
			e.preventDefault();
				

				$.ajax({
				url: "save_attendant_response.php?response=" + buttonpressed, // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					window.location = "index.php";
					
				}
			});
		}));	
	});

</script>
</body>
</html>