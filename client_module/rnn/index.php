<?php 
	session_start();
	
	include "configs/connect_database.php";
?>

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

    <title>Guest Request System</title>

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
      <h3 class="panel-title">Complete this form in quick 3 steps!</h3>
    </div>
    <div class="panel-body">
      <form name="basicform" id="basicform" method="post" action="yourpage.html">
        
        <div id="sf1" class="frm">
          <fieldset>
            <legend>Step 1 of 3</legend>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="uname">Your Name: </label>
              <div class="col-lg-6">
                <select id="concern_cats">
					<?php
						$q = mysqli_query($conn,"SELECT * FROM tbl_concern_cate where status = 1") or die(mysqli_error($con));
						while ($row = mysqli_fetch_array($q)){
							?> 
						<option value = "<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
							<?php
						}
					?>
					
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
            <legend>Step 2 of 3</legend>


            <div class="form-group">
              <label class="col-lg-2 control-label" for="uemail">Your Email: </label>
              <div class="col-lg-6">
                <select class="form-control">
					<option>
						Test
					</option>
					<option>
						Test
					</option>
				</select>
              </div>
            </div>

            <div class="clearfix" style="height: 10px;clear: both;"></div>



            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                <button class="btn btn-primary open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
              </div>
            </div>

          </fieldset>
        </div>

        <div id="sf3" class="frm" style="display: none;">
          <fieldset>
            <legend>Step 3 of 3</legend>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="upass1">Password: </label>
              <div class="col-lg-6">
                <input type="password" placeholder="Your Password" id="upass1" name="upass1" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="upass1">Confirm Password: </label>
              <div class="col-lg-6">
                <input type="password" placeholder="Confirm Password" id="upass2" name="upass2" class="form-control" autocomplete="off">
              </div>
            </div>

            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                <button class="btn btn-primary open3" type="button">Submit </button> 
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
    
    $(".open3").click(function() {
      if (v.form()) {
        $("#loader").show();
         setTimeout(function(){
           $("#basicform").html('<h2>Thanks for your time.</h2>');
         }, 1000);
        return false;
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
</body>
</html>