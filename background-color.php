<?php

 $host_name = "localhost";
 $user_name = "root";
 $password = "";
 $db_name = "demo";
 $connect = mysqli_connect($host_name, $user_name, $password, $db_name);
 if($connect == false)
 {
  echo "Server Connection Failed!";
  exit();
 }

 $x = $_POST['adjustment'];
 $sql_one = "INSERT INTO background_color (color) VALUES ('$x')";
 $result_one = mysqli_query($connect, $sql_one);
 $last_id = mysqli_insert_id($connect);

 $sql_two = "SELECT color FROM background_color WHERE id = (SELECT MAX(id) FROM background_color)";
 $result_two = mysqli_query($connect, $sql_two);
 $fetch_result = mysqli_fetch_assoc($result_two);
 $exploded_checked = explode(",", $fetch_result["color"]);

 //$sql_two = "SELECT color FROM background_color WHERE id = '$last_id'";
 //$result_two = mysqli_query($connect, $sql_two);
 //$fetch_result = mysqli_fetch_assoc($result_two);
 //$exploded_checked = explode(",", $fetch_result["color"]);

 if($result_one == true)
 {
?>

<style>
    body {background:  <?php if (in_array("two", $exploded_checked)){echo "#1f1f1f";} else if(in_array("four", $exploded_checked)){echo "white";}?>;}
     h3 {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #res {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #block {background: <?php if (in_array("two", $exploded_checked)){echo "#1f1f1f";} else if(in_array("four", $exploded_checked)){echo "white";}?>;}
    #pass-show {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #photo {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #copyright {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #demo {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
</style>

<?php 
 }
 else
 {
  echo "<div style = 'text-align: center; font-size: 20px; color: #ff0000;'>SORRY! Page Can't Set Background Color.</div>";
  exit();
 } 
?>