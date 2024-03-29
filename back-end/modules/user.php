<?php 
	session_start();
	include "../../global_variables_for_mysql_connection.php";
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
                <a class="navbar-brand" href="index.html">GRS</a>
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
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Maintenance Module <span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="user.php">Users</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="room.php">Rooms</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="department.php">Departments</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="access.php">User Access</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="concat.php">Concern Categories</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link" href="concerns.php">Concerns</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Users </h2>
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">GRS</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Maintenance Module</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
					<!-- ============================================================== -->
					<!-- horizontal form -->
					<!-- ============================================================== -->
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="card">
							<form id="frm_new_record" name = "frm_new_record"  data-parsley-validate="" novalidate="">
								<h5 class="card-header">User Information</h5>
								<div class="card-body">
								
									<div class="form-group row">
										<label for="user_id" class="col-3 col-lg-3 col-form-label text-right">User Id</label>
										<div class="col-9 col-lg-9">
											<input name = "user_id" id="user_id" type="text" required="" placeholder="User Id" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="user_name" class="col-3 col-lg-3 col-form-label text-right">User Name</label>
										<div class="col-9 col-lg-9">
											<input name = "user_name" id="user_name" type="text" required="" placeholder="Name" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="pcode" class="col-3 col-lg-3 col-form-label text-right">Passcode</label>
										<div class="col-9 col-lg-9">
											<input name="pcode" id="pcode" type="password" data-parsley-min="1000" data-parsley-max="99999" required="" placeholder="Password" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="dept_code" class="col-3 col-lg-3 col-form-label text-right">Department</label>
										<div class="col-9 col-lg-9">
											<select class="form-control" required=""  id="dept_code" name="dept_code">
												
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="access_code" class="col-3 col-lg-3 col-form-label text-right">Access Code</label>
										<div class="col-9 col-lg-9">
											<select class="form-control" required=""  id="access_code" name="access_code">
												
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="status" class="col-3 col-lg-3 col-form-label text-right">Status</label>
										<div class="col-9 col-lg-9">
											<label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="status"  id="status_active" class="custom-control-input"  value = '1'><span class="custom-control-label">Active</span>
                                                
                                            </label>
										<label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="status" id="status_inactive" class="custom-control-input" value = '0'><span class="custom-control-label">Inactive</span>
                                                
                                            </label>
										</div>
									</div>
									<div class="form-group row">
										
									</div>
									
									<div class="card-footer d-flex text-muted">
										<div class="col-2 col-lg-2">
											<button type="submit" id ="save" name = "save" class="btn btn-space btn-primary">Save</button>
										</div>
										<div class="col-10 col-lg-10" id = "message">
											
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- ============================================================== -->
					<!-- end horizontal form -->
					<!-- ============================================================== -->
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="card">
							<h5 class="card-header">All Users</h5>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="all_items" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>User Id</th>
												<th>Name</th>
												<th>Department</th>
												<th>Access Code</th>
												<th>Status</th>
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
				<!-- ============================================================== -->
				<!-- footer -->
				<!-- ============================================================== -->
				<div class="footer">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
								Information Systems Department, Club Balai Isabel Inc.
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
			
			$.ajax({
				url: "../ajax/get_dept_code.php", // Url to which the request is send
				dataType: "text",
				success: function(strMessage) {
					$("#dept_code").html(strMessage);
				}
			});
			$.ajax({
				url: "../ajax/get_access_code.php", // Url to which the request is send
				dataType: "text",
				success: function(strMessage) {
					$("#access_code").html(strMessage);
				}
			});

			
			$('#frm_new_record').on('submit',(function(e) {
				
				e.preventDefault();
				$.ajax({
				url: "../ajax/save_new_user.php", // Url to which the request is send
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
					table.ajax.reload();
					$("#user_id").prop("readOnly",false);
					$('#frm_new_record')[0].reset();
					
				}
				});
			}));
			var table = $('#all_items').DataTable({ 
				"ajax": '../ajax/get_all_users.php',
				"order": [[ 1, "asc" ]],
				"createdRow": function( row, data, dataIndex ) {
					if ( data[4] == "Inactive" ) {        
						$(row).addClass('red');
					}
				}
			});
	 
			var buttons = new $.fn.dataTable.Buttons(table, {
				buttons: [
				   'copyHtml5',
				   'excelHtml5',
				   'csvHtml5',
				   'pdfHtml5'
				]
			}).container().appendTo($('#buttons'));
			
			$('#buttons button').removeClass();
			$('#buttons button').addClass('btn btn-outline-primary');
			$("#all_items").on("click", "tr", function() {          
				var name = $(this).children(":first").text();
				$.ajax({
					url: "../ajax/get_user_data.php?u=" + name, // Url to which the request is send
					dataType: "JSON",
					success: function(result) {
						//$("#access_code").html(strMessage);
					
							//alert(result.data[0][0]);
							$("#user_id").val(result.data[0][0]);
							$("#user_id").prop("readOnly",true);
							$("#pcode").val(result.data[0][1]);
							$("#user_name").val(result.data[0][2]);
							$("#access_code").val(result.data[0][3]);
							$("#dept_code").val(result.data[0][5]);
							if(result.data[0][4] == 1){
								$("#status_active").prop("checked",true);
							}else{
								$("#status_inactive").prop("checked",true);
							}
							
							
						
						//alert(strMessage);
					}
				});
			});

		});
		</script>
	</body>
 
</html>