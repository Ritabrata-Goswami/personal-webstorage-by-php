<?php
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
 
 $img = rand(100, 999).$_FILES["yourFile"]["name"];
 $location = "fileStorage/".$img;
 $folder_move = $_FILES['yourFile']['tmp_name'];
 move_uploaded_file($folder_move, $location); 

 $name = mysqli_real_escape_string($connection, $_POST["yourName"]);
 $password = mysqli_real_escape_string($connection, $_POST["yourPassword"]);
 $email = mysqli_real_escape_string($connection, $_POST["yourEmail"]);

$match_email = "SELECT * FROM registration WHERE email = '$email'";
$match_email_result = mysqli_query($connection, $match_email);

$match_pass = "SELECT * FROM registration WHERE password = '$password'";
$match_pass_result = mysqli_query($connection, $match_pass);

 if(strlen($password) < 6)
 {
   echo "<h5><center style = 'color: #ff0000;'>Password Must Be Minimum of 6 Characters!</center></h5>";
   exit();
 }
 else if(mysqli_num_rows($match_email_result) == 0 && mysqli_num_rows($match_pass_result) == 0)
 {
   $sql = "INSERT INTO registration (name, email, password, photo) VALUES ('$name', '$email', '$password', '$img')";
   if(mysqli_query($connection, $sql))
   {

    date_default_timezone_set("Asia/Kolkata");
    $t = date("jS  F Y h:i A"); 

    echo "<h4><center style = 'color: #000000;'>Account Created Successfully!</center></h4>";

    $to = $email;
    $subject = 'Successful Account Creation in Mycloud';
    $message = $name.' congratulation for creating a successful account in Mycloud at '.$t.'. Your User-ID:- '.$email.' and password:- '.$password.' Dont share it with anyone as Mycloud will not be responsible for your personal information loss.';
    $headers = 'From: ritabratagoswami95@gmail.com';
    mail($to, $subject, $message, $headers);

    exit();
   }
 }
 else
 {
   echo "<h5><center style = 'color: #ff0000;'>ERROR! That same Email and/or Password already existed. Please Try For New.</center></h5>";
   exit();
 } 
 mysqli_close($connection);
 ?>