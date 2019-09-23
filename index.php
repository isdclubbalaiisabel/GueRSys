<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Request System</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="login-clean" style="background-color:rgb(255,255,255);">
        
            <div class="illustration"><img src="assets/img/balai.png" width="200" height="150">
                <h1 style="color:rgb(104,103,109);font-size:33px;">Guest Request System</h1>
            </div>
			
			<div class="form-group">
                <form action="back-end/modules/login.php" style="background-color:rgba(255,255,255,0.42);">
                    <p class="text-center">Select this if you are the Housekeeping/Engineering/Front Office Coordinator</p>
				    <button class="btn btn-primary btn-block" type="submit" style="background-color:rgb(71,119,244);">Coordinator Module</button>
                </form>
                </div>
                
            <div class="form-group">
                 <form action="client_module/attendant/set_phone_account.php" style="background-color:rgba(255,255,255,0.42);">
                     <p class="text-center">Select this if you are the Housekeeping/Engineering Attendant</p>
				    <button class="btn btn-primary btn-block" type="submit" style="background-color:rgb(75,163,84);">Attendant Module</button>
                </form>
            </div>
        
    </div>
    
</body>

</html>