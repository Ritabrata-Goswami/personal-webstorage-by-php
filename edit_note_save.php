<?php
session_start();
error_reporting(0);

$edit_id = $_POST['content-id'];
$_SESSION['note_edit_id'] = $edit_id;
if(isset($_SESSION['note_edit_id']))
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
    
    $value = $_POST['edit-comment'];
    // $value = addslashes($value);
    $value = mysqli_real_escape_string($connection, $value);
    date_default_timezone_set("Asia/Kolkata");
    $t = date("jS  F Y h:i A")."(edited)";

    $sql_update = "UPDATE file_store SET comment = '$value', time = '$t' WHERE id = '$edit_id'";
    if(mysqli_query($connection, $sql_update))
    {
        echo "<h4>Note Successfully Updated!</h4>";
    }
    else
    {
        echo "<h4>ERROR In Note Update!</h4>";
    }

}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>