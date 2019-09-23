

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <?php
    include "../../global_variables_for_mysql_connection.php";
    
    //$concernId = $_POST['concerns'];
    $room_code = $_COOKIE["room_code"];
    //$details = $_POST['details'];
    $status = 0;

    $req_id = $room_code."-".date("ymd-his");
    if(mysqli_query($conn, "INSERT INTO tbl_guest_concern VALUES ('$req_id',NOW(),'25','Express Checkout','$room_code','$status')")){
        if(mysqli_query($conn, "INSERT INTO tbl_concern_movement (guest_c_no,assigned_to,action_taken,datetime) VALUES ('$req_id','','0',NOW())")){
            echo    "<div class='login-clean' style='background-color:rgb(255,255,255);''>
                        <form method='post' style='background-color:rgba(255,255,255,0.42);'>
                            <div class='illustration'><img src='assets/img/balai.png' width='200' height='150'>
                                <h1 style='color:rgb(104,103,109);font-size:33px;'>Thank you for staying at&nbsp;Club Balai Isabel!</h1>
                            </div>
                            <p class='text-center'>Please wait as our team is processing your express checkout request.</p><em style='font-size:12px;float:center;''><br>*To know the status of your request, kindly scan the QR Code again.<br><br></em></form>
                    </div>";
        }
        else{
        echo "FAILED".mysqli_error($conn);
        
        }   
    }
    else{
        echo "FAILED".mysqli_error($conn);
        
    }
        

?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
</body>

<script type="text/javascript">
    window.setTimeout(function() {
    window.location.href = 'http://www.balaiisabel.com';
}, 5000);

</script>

</html>

