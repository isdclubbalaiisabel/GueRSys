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

            function sendMessage() {
                $content      = array(
                    "en" => 'Express Checkout!'
                );
                
                $fields = array(
                    //LOCALHOST
                    // 'app_id' => "46aa99c6-3eae-46b1-8b71-8066805984f9",
                    //LIVE
                    'app_id' => "695fab03-f980-47e8-9d16-ce5be4774c1d",
                    'included_segments' => array(
                        'All'
                    ),
                    //LOCALHOST 
                    // 'url' => "http://localhost/GueRSys/back-end/modules/all_request.php",
                    //LIVE
                    'url' => "http://grs.balaiisabel.com/back-end/modules/all_request.php",
                    'data' => array(
                        "foo" => "bar"
                    ),
                    'contents' => $content,
                );
                
                $fields = json_encode($fields);
                print("\nJSON sent:\n");
                print($fields);
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    //LOCALHOST
                    // 'Authorization: Basic Y2Q0ZGM0YTctMGY1OC00MzlmLWI3OGEtNzUyYzgxZGRmOTA2'
                    //LIVE
                    'Authorization: Basic OWVmNTEzY2MtNjFmOC00YzE3LTk5MWMtN2EzODFhYzcxY2Yw'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                
                $response = curl_exec($ch);
                curl_close($ch);
                
                return $response;
            }

            $response = sendMessage();
            $return["allresponses"] = $response;
            $return = json_encode($return);

            $data = json_decode($response, true);
            //print_r($data);
            $id = $data['id'];
            //print_r($id);

            //print("\n\nJSON received:\n");
            //print($return);
            //print("\n");




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

