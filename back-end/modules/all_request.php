<?php 
	session_start();
	
	include "../../global_variables_for_mysql_connection.php";

    if(!isset($_SESSION['uid'])){
		header("location: ../index.php");
	}

    //echo("<script>console.log('Debug: " . $_SESSION['uid'] . "');</script>");
    
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
                <a class="navbar-brand" href="all_request.php">Guest Request System - Coordinator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">    
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/signout.png" alt="" class="user-avatar-md"></a>
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
                                        <li class="breadcrumb-item active" aria-current="page">All Request</li>
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

					<div class="col-xl-12">
                            <div class="section-block">
                               
                            </div>
                            <div class="tab-regular">
                                <ul class="nav nav-tabs " id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="home" aria-selected="true">Pending</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="profile" aria-selected="false">Completed</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#failed" role="tab" aria-controls="profile" aria-selected="false">Failed Requests</a>
                                    </li>

                                    
                                </ul>
                                <div class="tab-content" id="myTabContent">

		                            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="home-tab">
		                            	<div class="table-responsive">
											<table class="table table-bordered " id="all_items" width="100%" cellspacing="0" >
												<thead>
													<tr>
														<th>Request No</th>
														<th>Room</th>
														<th>Request</th>
														<th>Details</th>
														<th>Date/Time Requested</th>
														<th>Dept-in-Charge</th>
														<th>Status</th>
													</tr>
												</thead>
													
												<tbody id = "tb_pending_contents">
													
												</tbody>
											</table>
										</div>
                                    </div>

                                    <div class="tab-pane fade " id="completed" role="tabpanel" aria-labelledby="home-tab">
                                    	<div class="table-responsive">
											<table class="table table-bordered " id="all_items" width="100%" cellspacing="0" >
												<thead>
													<tr>
														<th>Request No</th>
														<th>Room</th>
														<th>Request</th>
														<th>Details</th>
														<th>Date/Time Requested</th>
														<th>Dept-in-Charge</th>
													</tr>
												</thead>
													
												<tbody id = "tb_completed_contents">
													
												</tbody>
											</table>
										</div>
                                    </div>

                                    <div class="tab-pane fade " id="failed" role="tabpanel" aria-labelledby="home-tab">
                                    	<div class="table-responsive">
											<table class="table table-bordered " id="all_items" width="100%" cellspacing="0" >
												<thead>
													<tr>
														<th>Request No</th>
														<th>Room</th>
														<th>Request</th>
														<th>Details</th>
														<th>Date/Time Requested</th>
														<th>Dept-in-Charge</th>
														<th>Status</th>
														<th>Remarks</th>
													</tr>
												</thead>
													
												<tbody id = "tb_failed_contents">
													
												</tbody>
											</table>
										</div>
                                    </div>

                                </div>
                            </div>
                        </div>
					
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
								<div class="card-footer d-flex text-muted">
								<div class="col-12 col-lg-12" id = "buttons">
								
								</div>
							</div>
					
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
    </div>
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
        
        </script>
		<script>
		$('#form').parsley();
		</script>
		<script src='https://cdn.onesignal.com/sdks/OneSignalSDK.js' async=''></script>
			<script>
			  var OneSignal = window.OneSignal || [];
			  OneSignal.push(function() {
			    OneSignal.init({
			      appId: '695fab03-f980-47e8-9d16-ce5be4774c1d',
			      notifyButton: {
			        enable: true,
			      },
			    });
			  });

			  OneSignal.push(function() {
				  /* These examples are all valid */
				  OneSignal.getUserId(function(userId) {
				    console.log("OneSignal User ID:", userId);
				    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
				  });
				               
				  OneSignal.getUserId().then(function(userId) {
				    console.log("OneSignal User ID:", userId);
				    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
				  });
				});
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
			setInterval(function()
			{ 
				$.ajax({
					url: "../ajax/get_pending_requests.php", // Url to which the request is send
					dataType: "text",
					success: function(pendingTable) {
						
						$("#tb_pending_contents").html(pendingTable);
					}
				});

				

			}, 1000);
		});

		$(document).ready(function (e) {
			setInterval(function()
			{ 
				$.ajax({
					url: "../ajax/get_completed_request.php", // Url to which the request is send
					dataType: "text",
					success: function(completedTable) {
						$("#tb_completed_contents").html(completedTable);
					}
				});

			}, 1000);
		});

		$(document).ready(function (e) {
			setInterval(function()
			{ 
				$.ajax({
					url: "../ajax/get_failed_request.php", // Url to which the request is send
					dataType: "text",
					success: function(failedTable) {
						$("#tb_failed_contents").html(failedTable);
					}
				});

			}, 1000);
		});

		</script>
    
	</body>
 
</html>