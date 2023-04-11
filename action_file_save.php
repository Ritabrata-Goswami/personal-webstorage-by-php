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
       
       $file_in = str_replace("'", "_", basename($_FILES["yourFile"]["name"]));
       $img = rand(100, 999).$file_in;   
       $location = "dataStorage/".$img;
       $folder_move = $_FILES['yourFile']['tmp_name'];
       move_uploaded_file($folder_move, $location); 

       $cmt = $_POST["yourComment"];
       $user = $_POST["user_id"];

      //  $cmt = addslashes($cmt);

       $cmt = mysqli_real_escape_string($connection, $cmt);   
       $user = mysqli_real_escape_string($connection, $user);   

       date_default_timezone_set("Asia/Kolkata");
       $t = date("jS  F Y h:i A");       
                                     
       $sql = "INSERT INTO file_store (user_id, file, comment, time) VALUES ('$user', '$img', '$cmt', '$t')";
       mysqli_query($connection, $sql);
?>
