
<?php

	include "../../global_variables_for_mysql_connection.php";

	if(!isset($_COOKIE["room_code"])) {
	
		header("location:set_room_code.php");
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" />
    <meta name="author" content="Shahrukh Khan">
    <meta name="description" content="Login System with Github using OAuth PHP and MySQL">
    <meta name="keywords" content="php,mysql,Github,oauth,social logins,thesoftwareguy">
    <meta name="title" content="Login System with Github using OAuth PHP and MySQL">

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
        
        <div id="sf1" class="frm">
          <fieldset>
            <legend>What seems to be the problem?</legend>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="concern_cats">Select One:</label>
              <div class="col-lg-6">
                <select id="concern_cats" name = "concern_cats" class="form-control">
					
					
				</select>
              </div>
            </div>
            <div class="clearfix" style="height: 10px;clear: both;"></div>


            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
              </div>
            </div>

          </fieldset>
        </div>

        <div id="sf2" class="frm" style="display: none;">
          <fieldset>
            <legend>Can you elaborate your request?</legend>


            <div class="form-group">
              <label class="col-lg-2 control-label" for="concerns">Select One: </label>
              <div class="col-lg-6">
                <select id = "concerns" name = "concerns" class="form-control">
					
				</select>
              </div>
            </div>
			  <div class="clearfix" style="height: 10px;clear: both;"></div>
			<div class="form-group">
              <label class="col-lg-2 control-label" for="details">More details (Optional):</label>
              <div class="col-lg-6">
                <textarea id = "details" name = "details" class="form-control"></textarea>
              </div>
            </div>


            <div class="clearfix" style="height: 10px;clear: both;"></div>



            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                <button class="btn btn-primary open2" id = "to_summ"  type="button">Next <span class="fa fa-arrow-right"></span></button> 
              </div>
            </div>

          </fieldset>
        </div>

        <div id="sf3" class="frm" style="display: none;">
          <fieldset>
            <legend>Please confirm your request.</legend>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="upass1">Room: </label>
              <div class="col-lg-6">
                <h2 ><?php echo $_COOKIE['room_code'];?></h2>
              </div>
            </div>
            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="upass1">Concern: </label>
              <div class="col-lg-6">
				<h2 id = "concern_summ"></h2>
              </div>
            </div>

            <div class="clearfix" style="height: 10px;clear: both;"></div>
			<div class="form-group">
              <label class="col-lg-2 control-label" for="upass1">Details: </label>
              <div class="col-lg-6">
				<h2 id = "details_summ"></h2>
              </div>
            </div>

            <div class="clearfix" style="height: 10px;clear: both;"></div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                <button class="btn btn-primary open3" type="submit">Confirm </button> 
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
<script type="text/javascript">
  
  jQuery().ready(function() {

    // validate form on keyup and submit
    var v = jQuery("#basicform").validate({
      rules: {
        uname: {
          required: true,
          minlength: 2,
          maxlength: 16
        },
        uemail: {
          required: true,
          minlength: 2,
          email: true,
          maxlength: 100,
        },
        upass1: {
          required: true,
          minlength: 6,
          maxlength: 15,
        },
        upass2: {
          required: true,
          minlength: 6,
          equalTo: "#upass1",
        }

      },
      errorElement: "span",
      errorClass: "help-inline-error",
    });

    $(".open1").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf2").show("slow");
      }
    });

    $(".open2").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf3").show("slow");
      }
    });
    

    
    $(".back2").click(function() {
      $(".frm").hide("fast");
      $("#sf1").show("slow");
    });

    $(".back3").click(function() {
      $(".frm").hide("fast");
      $("#sf2").show("slow");
    });

  });
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function (e) {
		
		$('#basicform').on('submit',(function(e) {
			e.preventDefault();
			

			$.ajax({
			url: "save_new_request.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				
				 $("#loader").show();
				 setTimeout(function(){
				   $("#basicform").html(data);
				   setTimeout(function(){
					   $(location).attr('href', 'index.php')
					 }, 5000);
				 }, 1000);
			}
			});
		}));
		
		$('#to_summ').on('click',(function(e) {
			e.preventDefault();

			//alert($('#concerns').text());

			$('#concern_summ').html($('#concerns option:selected').text());
			if($('#details').val() == ""){
				$('#details_summ').html("-");
			}
			else{
				$('#details_summ').html($('#details').val());
			}
		}));
		
		$('#concern_cats').on('change',(function(e) {
			refresh_cats();
		}));
		$.ajax( {
			url: "ajax/set_concern_cate.php", 
			dataType: "text",
			success: function(strMessage) {
				$("#concern_cats").html(strMessage);
				refresh_cats()
			}
		});
			
		function refresh_cats(){
			$.ajax( {
			url: "ajax/set_concern.php?id=" + $('#concern_cats').val(), 
			dataType: "text",
			success: function(strMessage) {

				$("#concerns").html(strMessage);
					
				
				}
			});
		}
	});
	
</script>
</body>
</html>