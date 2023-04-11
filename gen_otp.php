<!DOCTYPE html>
<html>
<body>
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
    
    $email = mysqli_real_escape_string($connection, $_POST["yourEmail"]);
    
    $sql_one = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($connection, $sql_one);
    
    $fetched_result = mysqli_fetch_assoc($result);
    $user_id = $fetched_result['id'];
    $str = $fetched_result['name'];
    $array_val = explode(" ", $str);
    $random_no = str_shuffle($array_val[0]). "-" .rand(1000, 9999);
    
    date_default_timezone_set("Asia/Kolkata");
    $t = date("jS  F Y h:i:s A"); 
              
    if(mysqli_num_rows($result) == 1)
    {
      $sql_two = "INSERT INTO otp_save (user_id, email, name, otp, date) VALUES ('$user_id', '$email', '$str', '$random_no', '$t')";
      if(mysqli_query($connection, $sql_two))
      {
        echo "<h5><center style = 'color: #000000;'>OTP Has Been Given To This Email!</center></h5>";
        $_SESSION['email'] = $email;
        $_SESSION['time'] = $t;

        $to = $email;
        $subject = 'Mycloud Password Update.';
        $message = $fetched_result['name'].' your generated OTP (One Time Password) for password changing in Mycloud is: '.$random_no.' generated at '.$t;
        $headers = 'From: ritabratagoswami95@gmail.com';
        mail($to, $subject, $message, $headers);

        echo '<meta http-equiv="refresh" content="5; url=otp_verification_script.php">';
        // header('Location: otp_cutted_script.php');
      }     
    }       
    else
    {
      echo "<h5><center style = 'color: #ff0000;'>This Email is not registered. Please use your registered email.</center></h5>";
      exit();
    }
    mysqli_close($connection);
    
$_SESSION['id'] = $user_id;    
if($_SESSION['id'] == '')
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>

</body>
</html>
