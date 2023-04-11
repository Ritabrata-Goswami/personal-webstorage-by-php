<?php
session_start();

$display_id = $_POST["showing_id"];    //$_POST['file_id_show'] Display the details of respective id. $_POST["showing_id"]
$_SESSION['id_show'] = $display_id;
if(isset($_SESSION['id_show']))
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

 $sql_display = "SELECT * FROM file_store WHERE id = '$display_id'";
//  $result_display = mysqli_query($connection, $sql_display);
 if(mysqli_query($connection, $sql_display) == true)
 {
 $fetched_result_display = mysqli_fetch_assoc(mysqli_query($connection, $sql_display));
?>

<!-- <img id = "display-image" src = "dataStorage/<?=$fetched_result_display['file'];?>" onerror = "this.style.display = 'none'"/> -->
        <!-- <div id = "display-comment"> -->  

          <img id = "display-image" src = "dataStorage/<?=$fetched_result_display['file'];?>" onerror = "this.style.display = 'none'"/>
          <div id = "display-comment"><?=$fetched_result_display['comment']?></div>
          
        <!-- </div> -->
<!-- <p id = "date" style = 'font-size: 10px; margin: 20px; position: sticky; top: 5px;'><?=$fetched_result_display['time']?></p> -->

<?php
 }
}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>