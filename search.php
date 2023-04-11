<?php
$usr_id = $_POST["id_user"]; //$_POST["id_user"] 
$_SESSION['u_file_search_id'] = $usr_id;
if(isset($_SESSION['u_file_search_id']))
{
?>
<!DOCTYPE html>
<html>
</html>
  <style type = 'text/css'>
    #list {
      color: #000000;
      font-size: 20px; 
      text-decoration: none;
    }
    #list:hover {
      cursor: pointer;
      color: #ffffff;
    }
    #result-list {
      margin-bottom: 15px;
      text-align: center;
    }
  </style>
<body>

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

$name_val = $_POST["search_val"];  
// $name_val = addslashes($name_val);
$name_val = mysqli_real_escape_string($connection, $name_val);

$sql = "SELECT * FROM file_store WHERE comment LIKE '%$name_val%' AND user_id = '$usr_id'"; 
$result = mysqli_query($connection, $sql);

  while($fetch_result = mysqli_fetch_assoc($result))
  {
?>    

  <div id = 'result-list'>
    <a href = "search_display_result.php?id=<?=base64_encode($fetch_result['id']);?>" target = '_blank' id = "list" style = ''><?=stripslashes($fetch_result['comment']);?></a>
  </div>

<?php  
  }
  mysqli_close($connection);
}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>

</body>
</html>