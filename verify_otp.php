<?php
error_reporting(0);
session_start();

    $host_name = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "demo";
             
    $connection = mysqli_connect($host_name, $db_user, $db_password, $db_name);
    if (mysqli_connect_errno()) 
    {
      echo "Failed to establish connection to database: " . mysqli_connect_error();
      exit();
    } 
    
    $_SESSION["email"] = mysqli_real_escape_string($connection, $_POST["email_val"]);  //user email.
    $session_email = $_SESSION["email"];
    $_SESSION["time"] = mysqli_real_escape_string($connection, $_POST["time_val"]);
    $session_time = $_SESSION["time"];
    $otp_number = mysqli_real_escape_string($connection, $_POST["otp_val"]);


    $sql = "SELECT * FROM `otp_save` WHERE email = '$session_email' AND date = '$session_time'";   
    $result = mysqli_query($connection, $sql);
    $fetched_result = mysqli_fetch_assoc($result);
    $fetched_otp = $fetched_result['otp'];


    $otp_compare = strcmp($fetched_otp, $otp_number);
    if($otp_compare == 0)
    {
      echo "<h5><center style = 'color: #000000;'>OTP Verification Successful!</center></h5>";
      $_SESSION['email'] = $session_email;
      echo '<meta http-equiv="refresh" content="6; url=password_edit.php">';
      exit();
    }
    else
    {
      echo "<h5><center style = 'color: #ff0000;'>OTP Verification Failed!</center></h5>";
      exit();
    }
    mysqli_close($connection);

    if($_SESSION["email"] == '')
    {
      header("Location: http://localhost/Ritabrata/mycloud.html");
      exit();
    }
?>