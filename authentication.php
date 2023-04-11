<?php
error_reporting(0);
session_start(); 
$host = "localhost";
$user = "root";
$password = ""; 
$db_name = "demo";
$connect = mysqli_connect($host, $user, $password, $db_name);
if($connect == false)
{
  die("ERROR:failed to connect to database!");
}

$user_id = $_POST["user_id"];
$password = $_POST["password"];
$user_id = htmlspecialchars($user_id);   
$password = htmlspecialchars($password);  
$user_id = mysqli_real_escape_string($connect, $user_id);  
$password = mysqli_real_escape_string($connect, $password);

$sql = "SELECT * FROM registration WHERE email = '$user_id' AND password = '$password'";
$result = mysqli_query($connect, $sql);    
$count = mysqli_num_rows($result);
$fetched_result = mysqli_fetch_assoc($result);

$id = $fetched_result["id"];

 if($count == 1)
 {  
    // echo "<h1><center> Login successful! </center></h1>";
    $_SESSION['id'] = $fetched_result["id"];
   //  $_SESSION['last_login_time'] = time();
    header("Location: main_page.php");   //?get_profile_id=".rand(1111, 9999).'_'.str_shuffle('abdEfGHc').'_'.bin2hex($id).'_'.str_shuffle($name).'_'.rand(11, 99)
 }
 else
 {
    echo "<h2><center style = 'color: #e60000;'>Invalid ID or Password. Login Failed!</center></h2><br/><center style = 'font-size: 17px;'><a href = 'http://localhost/Ritabrata/mycloud.html'>Back</a> to login page.</center>";
    exit();
 }  
  
mysqli_close($connect);
?>
