<?php
session_start();

$file_id = $_POST['file_id'];    //$_POST['user_file_id']
$_SESSION['f_id'] = $file_id;
if(isset($_SESSION['f_id']))
{
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

 $sql = "DELETE FROM file_store WHERE id = '$file_id'";
 if(mysqli_query($connection, $sql))
 {
   echo "<h4><center style = 'color: #ffffff;'>Deleted Successfully!</center></h4>";
   exit();
 }
 else
 {
   echo "<h4><center style = 'color: #ffffff;'>Error in Delete!</center></h4>";
   exit();
 }
}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>