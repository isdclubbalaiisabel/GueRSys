<?php 
	session_start();
	include "../../global_variables_for_mysql_connection.php";

    if(!isset($_SESSION['uid'])){
		header("location: index.php");
	}
    if(!isset($_GET['r'])){
        header("location: all_request.php");
    }

	$r = $_GET['r'];
	$dep = $_SESSION['dep'];
    

?>
<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GRS - USERS </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	
	<link href="../datatables/jquery.dataTables.min.css" rel="stylesheet">
	<link href="../datatables/buttons.dataTables.min.css" rel="stylesheet">
	<style>
	.red {
		background-color: #ffb2b2 !important;
	}

	</style>

	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
			<script>
			  var OneSignal = window.OneSignal || [];
			  OneSignal.push(function() {
			    OneSignal.init({
			      appId: "695fab03-f980-47e8-9d16-ce5be4774c1d",
			      notifyButton: {
			        enable: true,
			      },
			    });
			  });
		</script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
         <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
         <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="all_request.php">GRS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.png" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION['uname']; ?></h5>
                                    <span class="status"></span><span class="ml-2"><?php echo $_SESSION['dep']." - " .$_SESSION['acc']; ?></span>
                                </div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="container">
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> </h2>
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">GRS</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Coordinator Module</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Request</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
             
                    
				<div class="row">
					
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<h5 class="card-header">Guest Concern Timeline</h5>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered " id="all_items" width="100%" cellspacing="0" >
										<thead>
											<tr>
												<th>Request No</th>
												<th>Logs</th>
												<th>Date/Time</th>
												<th>In-Charge</th>
											</tr>
										</thead>
										
										<tbody id = "tb_contents">
										
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-footer d-flex text-muted">
								<div class="col-12 col-lg-12" id = "buttons">
								
								</div>
							</div>
					
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="card">
							<form id="frm_new_record" name = "frm_new_record"  data-parsley-validate="" novalidate="">
								<h5 class="card-header">Assignment</h5>
								<div class="card-body">
										
									<div class="form-group row" id = "assign_div">			
									</div>
									<div class="form-group row" id = "content_assign">
											<label for="dept_code" class="col-3 col-lg-3 col-form-label text-right" id = "lbl1">Assign To</label>
											<input type = 'hidden' value = '<?php echo $r;?>' name = 'r'/>
											<div class="col-9 col-lg-9">
												<select class="form-control" required=""  id="assign_to" name="assign_to">
													
												</select>
											</div>
										</div>
									</div>
								<div class="card-footer d-flex text-muted">
									<div class="col-2 col-lg-2">
										<button type="submit" id ="save_new" name = "save" class="btn btn-space btn-primary">Save</button>
									</div>
									<div class="col-10 col-lg-10" id = "message">
										
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="card">
							<form id="chg_att_form" name = "frm_new_record_oos"  data-parsley-validate="" novalidate="">
								<h5 class="card-header">Change Assignment</h5>
								<div class="card-body">
									<div class="form-group row" id = "chg_att">
										
									</div>
										
									<div class="form-group row" id = "content_done">
										<label for="dept_code" class="col-3 col-lg-3 col-form-label text-right" id = "lbl1">Assign To</label>
											<input type = 'hidden' value = '<?php echo $r;?>' name = 'r'/>
											<div class="col-9 col-lg-9">
												<select class="form-control" required=""  id="sel_chg_att" name="sel_chg_att"></select>
											</div>
									</div>
								</div>
								<div class="card-footer d-flex text-muted">
									<div class="col-2 col-lg-2">
										<button type="submit" id ="chg_att_done" name = "save" class="btn btn-space btn-primary">Save</button>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- footer -->
				<!-- ============================================================== -->
				<div class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
								Information Systems Department, Club Balai Isabel Inc. <a href="https://colorlib.com/wp/"></a>
							</div>
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
				<!-- end footer -->
				<!-- ============================================================== -->
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end main wrapper -->
		<!-- ============================================================== -->
		<!-- Optional JavaScript -->
		<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
		<script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
		<script src="../assets/vendor/parsley/parsley.js"></script>
		<script src="../assets/libs/js/main-js.js"></script>
		
		
		<script type="text/javascript" language="javascript" src="../datatables/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/dataTables.buttons.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/buttons.flash.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/jszip.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/pdfmake.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/vfs_fonts.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/buttons.html5.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/buttons.print.min.js"></script>
		<script type="text/javascript" language="javascript" src="../datatables/buttons.colVis.min.js"></script>
		
		
		<script>
		$('#form').parsley();
		</script>
		<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
		</script>
		<script>
		$(document).ready(function (e) {
			$('#frm_new_record').on('submit',(function(e) {
				
				e.preventDefault();
				$.ajax({
				url: "../ajax/save_new_movement.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					$("#message").html(data);
					$("#message").fadeTo(3000, 800).slideUp(800, function(){
						$("#message").slideUp(800);
					});
					refresh_table();
					refrest_select();
					$('#frm_new_record')[0].reset();
					
				}
				});
			}));

			$('#chg_att_form').on('submit',(function(e) {
				
				e.preventDefault();
				$.ajax({
				url: "../ajax/save_new_attendant.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					$("#message").html(data);
					$("#message").fadeTo(3000, 800).slideUp(800, function(){
						$("#message").slideUp(800);
					});
					refresh_table();
					refrest_select();
					$('#frm_new_record')[0].reset();
					
				}
				});
			}));
			
			function refresh_table(){
				$.ajax({
					url: "../ajax/get_request_logs.php?r=<?php echo $r;?>" , // Url to which the request is send
					dataType: "text",
					success: function(strMessage) {
						$("#tb_contents").html(strMessage);
					}
				});
			}
			refresh_table();
			refrest_select();
			get_attendant();
			function get_attendant(){
				$.ajax({
					url: "../ajax/change_attendant.php?dept=<?php echo $dep;?>&r=<?php echo $r;?>" , // Url to which the request is send
					dataType: "text",
					success: function(strMessage) {
						//console.log(strMessage);
						$("#sel_chg_att").html(strMessage);
					}
				});
			}
			
			function refrest_select(){
			$.ajax({
				url: "../ajax/get_all_attend.php?dept=<?php echo $dep;?>&r=<?php echo $r;?>", // Url to which the request is send
				dataType: "text",
				success: function(strMessage) {
					console.log(strMessage);
					$("#assign_div").hide();
					$("#chg_att").hide();
					$("#content_assign").hide();
					$("#content_done").hide();
					$("#save_new").hide();
					$("#save_oos").hide();
					
					if(strMessage == 1){

						$("#assign_div").html("<h1 class='display-4 text-center'>ALREADY ASSIGNED</h1>");
						$("#assign_div").show();
						$("#chg_att").hide();
						$("#content_assign").hide();
						$("#content_done").show();
						$("#save_new").hide();
						$("#save_oos").show();
						//window.location.replace("all_request.php");
					}
					else if(strMessage == 3){
						$("#assign_div").html("<h2 class='display-4 text-center'>REQUEST COMPLETED</h2>");
						$("#chg_att").show();
						$("#assign_div").show();
						$("#chg_att").html("<h2 class='display-4 text-center'>REQUEST COMPLETED</h2>");
						$("#content_assign").hide();
						$("#content_done").hide();
						$("#save_new").hide();
						$("#chg_att_done").hide();
					}

					else if(strMessage == 4){
						$("#assign_div").html("<h2 class='display-4 text-center'>REQUEST FAILED</h2>");
						$("#chg_att").show();
						$("#assign_div").show();
						$("#chg_att").html("<h2 class='display-4 text-center'>REQUEST FAILED</h2>");
						$("#content_assign").hide();
						$("#content_done").hide();
						$("#save_new").hide();
						$("#chg_att_done").hide();
					}
					else if(strMessage == 5){
						$("#assign_div").html("<h2 class='display-4 text-center'>NO AVAILABLE ATTENDANTS</h2>");
						$("#chg_att").show();
						$("#assign_div").show();
						$("#chg_att").html("<h2 class='display-4 text-center'>NO AVAILABLE ATTENDANTS</h2>");
						$("#content_assign").hide();
						$("#content_done").hide();
						$("#save_new").hide();
						$("#chg_att_done").hide();
					}

					else{
						
						$("#assign_to").html(strMessage);
						$("#chg_att").hide();
						$("#assign_div").hide();
						$("#chg_att").show();
						$("#content_assign").show();
						$("#content_done").hide();
						$("#save_new").show();
						$("#save_oos").hide();
					}
				}
			});
			}


			

		});
		</script>
	</body>
 
</html>