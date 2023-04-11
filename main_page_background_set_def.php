<?php
error_reporting(0);
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

 $user_id = $_POST['u_id'];
 $referrence_value = $_POST['ref_val_def'];
//  $referrence_value_extra = $_POST['ref_val_extra'];

 $sql_color_in = "INSERT INTO main_page_color_set (userid, refvalue) VALUES ('$user_id', '$referrence_value')";
 $result_insert = mysqli_query($connect, $sql_color_in);
 
 $sql_color_out = "SELECT * FROM main_page_color_set WHERE id = (SELECT MAX(id) FROM main_page_color_set WHERE userid = '$result_id')";
 $result = mysqli_query($connect, $sql_color_out);
 $fetched_result = mysqli_fetch_assoc($result);

 if($result_insert == true)
 {
?>

    <style type = "text/css">
      #left-main-container {background: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#1f1f1f';}?>;}
      .display-comment {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #comment {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #comment-time {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #file-img {background: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #heading {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #display-comment {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      /* #date {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>} */
      .fa-upload {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #upload {color: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo '#ffffff';}?>}
      #upload-information {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffff4d';}?>}
    </style>

<style type = "text/css">
     #left-main-container {background: #1f1f1f;}
     .display-comment {color: #ffffff;}
     #comment {color: #ffffff;}
     #comment-time {color: #ffffff;}
     #file-img {background: #ffffff;}
     #heading {color: #ffffff;}
     #display-comment {color: #ffffff;}
     /* #date {color: #ffffff;} */
     .fa-upload {color: #ffffff;}
     #upload {color: #ffffff;}
     #upload-information {color: #ffff4d;}
  </style>

<?php
 }
 else
 {
   echo "<div style = 'text-align: center; font-size: 20px; color: #ff0000;'>ERROR! Color can't be set.</div>";
   exit();
 }
?>