<?php
error_reporting(0);
 session_start();
 if(isset($_SESSION['id']))
 {
// header("Location: http://localhost/Ritabrata/mycloud.html");
// exit();
// }
/*connection*/
$host = "localhost";
$user = "root";
$password = ""; 
$db_name = "demo";
$connect = mysqli_connect($host, $user, $password, $db_name);
if($connect == false)
{
  die("ERROR:failed to connect to database!");
}


// $str = $_GET["get_profile_id"];
// $array_val = explode("_", $str);
$result_id = $_SESSION['id'];
// $result_id =  hex2bin($array_val[2]);
// echo $result_id;

if($result_id == '')
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
}
else
{
?>
<!DOCTYPE html>
<html id = "display-result">
<head>
<title>MyCloud</title>
<meta charset = "UTF-8"/>
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0"/>
<meta name = "description" content = "Storing personal information"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"/>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
<link rel = "icon" href = "iconStorage/logo_f.jpg">
<style type = "text/css">
* {box-sizing: border-box;}
#navbar {
width: 100%;
position: sticky;
top: 0;
background: #333333;
padding: 7px;
z-index: 4;
}
#element-container {
display: flex;
}
#search-container {
margin-top: 3px;
flex: 90%;
}
#timer-show-container {
flex: 20%;
}
#time-show {color: #ff0000;}
input[type = text] {
width: 50%;
padding: 5px;
border-style: inset;
}
#serach-btn {
color: #ffffff;
padding: 5px 10px;
background: #00802b;
cursor: pointer;
}
#background-container {
margin-top: 3px;
flex: 10%;
}
#default-color-btn {
color: #1a1aff;
padding: 5px 10px;
background: #4d4d4d;
cursor: pointer;  
}
#color-btn-dark {
color: #1a1aff;
padding: 5px 10px;
background: #4d4d4d;
cursor: pointer;
}
#color-btn-bright {
/* display: none; */
color: #1a1aff;
padding: 5px 10px;
background: #4d4d4d;
cursor: pointer;
}
#logout-container {
margin-top: 3px;
flex: 10%;
}
#logout-btn {
padding: 5px 10px;
cursor: pointer;
}
#alternate-switch-lwr-px {display: none;}
#profile-image-container {
height: 500px;
background: #000000;
}
#outer-image-container {background: #000000;}
#background-image-container {
position: relative;
z-index: 1;
text-align: center;
}
#background-image {
width: 50%;
opacity: 0.7;
}
#background-image:hover {
cursor: pointer;
opacity: 1;
transition: 1s;
}
#profile-image {
width: 100px;
height: 100px;
border-radius: 5px;
position: absolute;
z-index: 2;
box-shadow: 0px 5px 8px #777777;
top: 25%;
left: 5%;
}
#your-name {
color: #ffffff;
position: absolute;
z-index: 2;
top: 40%;
left: 5%;
font-weight: bold;
font-size: 20px;
}
#index-container {
position: absolute;
z-index: 3;
top: 50%;
width: 100%;
}
#navbar-main-container {
display: flex;
background: #3366cc;
padding: 2px;
}
#photo-btn {
padding: 5px 5px;
background: #3366cc;
color: #ffffff;
border: none;
}
#photo-btn:hover {
background: #f2f2f2;
color: #000000;
}
#photo-btn a {text-decoration: none;}
#video-btn {
padding: 5px 5px;
margin-left: 5px;
background: #3366cc;
color: #ffffff;
border: none;
}
#video-btn:hover {
background: #f2f2f2;
color: #000000;
}
#video-btn a {text-decoration: none;}
#file-btn {
padding: 5px 10px;
margin-left: 5px;
background: #3366cc;
color: #ffffff;
border: none;
}
#file-btn:hover {
background: #f2f2f2;
color: #000000;
}
#file-btn a {text-decoration: none;}
#note-btn {
padding: 5px 10px;
margin-left: 5px;
background: #3366cc;
color: #ffffff;
border: none;
}
#note-btn:hover {
background: #f2f2f2;
color: #000000;
}
#note-btn a {text-decoration: none;}
#main-container {
display: flex;
margin-top: 0px;
}
#written-text {
width: 50%;
padding: 10px;
border-style: inset;
}
#left-main-container {
flex: 80%;
background: #cccccc; /*Must be removed*/
}

#output {
margin-top: 30px;
}

.file-block {
float: left;
margin-left: 20px;
margin-bottom: 50px; 
}
.display-comment {
white-space: nowrap;   
width: 150px;    
overflow: hidden; 
text-overflow: ellipsis;    
font-size: 12px;   
}
.display-file {
 width: 150px;
cursor: pointer;
}
.image {transition: 0.7s;}
#footer-container {
background: #6699ff;
color: #ffffff;
height: 70px;
padding: 1px;
}
#copyright {
font-size: 10px; 
text-align: center;
}
#scroll-switch {display: none;}
.colorlink.active {
background: #f2f2f2;
color: #000000;
}
#pop-up-box {
display: none; 
position: absolute; 
z-index: 5; 
padding-top: 35px; 
left: 0;
top: 0;
width: 100%;
height: 100%; 
background-color: rgba(0,0,0,0.4); 
}
#pop-up {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
#pop-up-search-container-box {
display: none; 
position: fixed; 
z-index: 5; 
padding-top: 50px; 
left: 0;
top: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.4);   
}
#pop-up-search-result-box {
display: none; 
position: fixed; 
z-index: 5; 
padding-top: 50px; 
left: 0;
top: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.4);   
}
.pop-up-serach-box {
  margin: auto;
  width: 90%;
  background: #ff0000;
  color: #ffffff;
  padding: 10px;
}
.pop-up-serach-result-box {
  margin: auto;
  width: 90%;
  background: #2eb8b8;
  color: #ffffff;
  padding: 10px;
}
#pop-up-warning-box {
display: none; 
position: fixed; 
z-index: 5; 
padding-top: 50px; 
left: 0;
top: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.4);  
}
#pop-up-warning {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
#pop-up-warning-box-delete {
display: none; 
position: fixed; 
z-index: 5; 
padding-top: 50px; 
left: 0;
top: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.4); 
}
#pop-up-warning-delete {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;  
}
#warning-box {
  text-align: center;
  padding: 10px;
}
#Yes {
 background: #ff0000; 
 color: #ffffff;
 padding: 12px;
 border: none;
 font-size: 16px;
}
#Yes:hover {
 border-radius: 5px;
 cursor: pointer;
 background: #f2f2f2;
 color: #000000;
}
#No {
 margin-left: 10px; 
 background: #ff0000; 
 color: #ffffff;
 padding: 12px;
 border: none;
 font-size: 16px;
}
#No:hover {
 border-radius: 5px;
 cursor: pointer;
 background: #f2f2f2;
 color: #000000;
}
#pop-up-delete-success-box {
display: none; 
position: fixed; 
z-index: 5; 
padding-top: 50px; 
left: 0;
top: 0;
width: 100%;
height: 100%;
background-color: rgba(0,0,0,0.4);  
}
#pop-up-delete-success{
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
#pop-up-box-zoom {
display: none; 
position: absolute; 
z-index: 5; 
padding-top: 20px; 
left: 0;
top: 0;
width: 100%;
height: 100%; 
background-color: rgba(0,0,0,0.4); 
}
#pop-up-zoom {
margin: auto;
width: 90%;
padding: 5px;
}
#img-zoom {
margin: auto;
width: 100%;
padding: 5px;
}
.close {
float: right; 
cursor: pointer; 
font-weight: bold; 
font-size: 30px;
}
.close:hover {
color: #000000;
}
.close-del {
float: right; 
cursor: pointer; 
font-weight: bold; 
font-size: 45px;
}
.close-del:hover {
color: #000000;
}
.close-img {
float: right; 
cursor: pointer; 
font-weight: bold; 
font-size: 35px;
color: white;
}
.close-img:hover {
color: #b3b3b3;
}
#upload-information {
  color: #e60000; 
  font-size: 11px;
}
#res {display: none;}
@media only screen and (max-width: 700px) {
  #index-container {
  position: absolute;
  z-index: 3;
  top: 60%;
  width: 100%;
  } 
  #background-image {
    width: 70%;
  }
  #search-container {
  margin-top: 3px;
  flex: 50%;
  }
  input[type = text] {
  width: 80%;
  padding: 5px;
  border-style: inset;
  }
  #timer-show-container {
  margin-left: 10px;
  }
  /* #background-container {display: none;}
  #logout-container {display: none;} */
  #footer-container {
  background: #000000; 
  height: 120px;
  }
  #copyright {color: #b3ffb3;}
  #scroll-switch {
  display: block;
  text-align: center;
  color: #b3ffb3;
  } 
  html {scroll-behavior: smooth;}
  #scroll-switch:hover {
  background-color: #f1f1f1; 
  color: #000000;
  }
}
@media only screen and (max-width: 600px) {#written-text {width: 60%;}}
@media only screen and (max-width: 550px) {
  #written-text {width: 95%;} 
  #background-image {display: none;}
  #profile-image {
  position: absolute; 
  left: 40%;
  top: 20%;
  } 
   #your-name {
    top: 37%; 
    text-align: center;
    color: #ffffff;
    font-weight: bold;
    font-size: 20px;
    width: 100%;
  }
  #alternate-switch-lwr-px {display: block;}
  #option-switch-lwr-px {
  float: right;
  background: #333333;
  border: none;
  padding: 7px 10px;
  }
  #option-switch-lwr-px:hover {background: #f1f1f1;}
  .fa-bars {
  color: #ffffff; 
  font-size: 20px;
  }
  .fa-bars:hover {color: #000000;}
  #list-background-lwr-px {
  display: none;
  width: 50px;
  height: 150px;
  margin-top: 35px;
  background: #00ffff;
  position: absolute;
  right: 2%;
  padding: 3px;
  border-radius: 5px;
  /* z-index: 3; */
  }
  #background-container {display: none;}
  #logout-container {display: none;}
  #default-color-btn-lwr-px {
  margin-top: 15px; 
  margin-left: 3px;
  color: #1a1aff;
  padding: 5px 10px;
  background: #4d4d4d;
  cursor: pointer;
  }
  #color-btn-dark-lwr-px {
  margin-top: 15px; 
  margin-left: 3px;
  color: #1a1aff;
  padding: 5px 10px;
  background: #4d4d4d;
  cursor: pointer;
  }
  #color-btn-bright-lwr-px {
  margin-top: 15px; 
  margin-left: 3px;
  color: #1a1aff;
  padding: 5px 10px;
  background: #4d4d4d;
  cursor: pointer;
  }
  #logout-lwr-px {
  margin-top: 15px; 
  text-align: center;
  }
  #cut-list-background {
    float: right;
    padding: 2px 5px;
    background: #ff1a1a;
    color: #ffffff;
    font-weight: bold;
    font-size: 17px;
    margin-bottom: 10px;
  }
}
@media only screen and (max-width: 387px) {
 #res {
 display: block;
 text-align: center;
 background: #1f1f1f;
 color: #ff0000;
 }
 #data-container {display: none;}
}
</style>
</head>
<body onload = "stopWatch()">

      <?php
         $sql_color_btn_sel = "SELECT * FROM main_page_color_set WHERE id = (SELECT MAX(id) FROM main_page_color_set WHERE userid = '$result_id')";
         $result = mysqli_query($connect, $sql_color_btn_sel);
         $fetched_result_css = mysqli_fetch_assoc($result);
      ?>

<div id = "styling-sheet">
  <style type = "text/css">
     #left-main-container {background: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#1f1f1f';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#cccccc';}?>;}
     .display-comment {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     #comment {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     #comment-time {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     #file-img {background: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';}?>}
     #heading {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     #display-comment {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     /* #date {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>} */
     .fa-upload {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     #upload {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffffff';} if(strcmp("bright", $fetched_result_css['refvalue']) == 0) {echo '#000000';}?>}
     #upload-information {color: <?php if(strcmp("dark", $fetched_result_css['refvalue']) == 0) {echo '#ffff4d';}?>}
  </style>
</div>

<div id = "res">Sorry, This device is not suitable! Please use a device with higher pixel such as desktop or laptop or similar kind of devices.</div>

<div id = "data-container">
  <div id = "navbar">
    <div id = "element-container">
      <div id = "search-container"> 
        <input type = "text" name = "search" placeholder = "Search..." id = "entered-query"/>
        <button id = "serach-btn" onclick = "showResult()"><i class = "fa fa-search"></i></button>
      </div>
      <div id = "timer-show-container">
        <span style = "color: white;">Timer: </span>
        <span id = "time-show"></span>
        <form method = "POST" action = "main_page.php">
          <input type = "text" id = "timer-run" name = "timer-field" style = "display: none;"/>
        </form>
        <input type = "text" id = "user-id" value = "<?=$result_id?>" style = "display: none;"/>
        <input type = 'text' id = 'file_id_val' value = "<?=$file_id?>" style = "display: none;"/>
      </div>
      <div id = "background-container">

      <?php
         $sql_color_btn_sel = "SELECT * FROM main_page_color_set WHERE id = (SELECT MAX(id) FROM main_page_color_set WHERE userid = '$result_id')";
         $result = mysqli_query($connect, $sql_color_btn_sel);
         $fetched_result = mysqli_fetch_assoc($result);
      ?>

        <button id = "default-color-btn" style = "display: <?php if(strcmp("bright", $fetched_result['refvalue']) == 0 || strcmp("dark", $fetched_result['refvalue']) == 0) {echo 'none';}?>"><i class="fa fa-moon-o" style = "color: white"></i></button>
        <button id = "color-btn-dark" style = "display: <?php if(strcmp("bright", $fetched_result['refvalue']) == 0) {echo 'block';}else{echo 'none';}?>"><i class="fa fa-moon-o" style = "color: white"></i></button>
        <button id = 'color-btn-bright' style = "display: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo 'block';}else{echo 'none';}?>"><i class="fa fa-sun-o" style = "color: white"></i></button>

      </div>
      <div id = "logout-container">
        <a href = "signout.php"><button id = "logout-btn"><i class = "fa fa-power-off" style = "color: red"></i></button></a>
      </div>

      <div id = "alternate-switch-lwr-px"> <!-- Alternate switch -->
        <button id = "option-switch-lwr-px" onclick = "document.getElementById('list-background-lwr-px').style.display = 'block';"><i class="fa fa-bars"></i></button> 
        <div id = "list-background-lwr-px">
          <button id = "cut-list-background" onclick = "document.getElementById('list-background-lwr-px').style.display = 'none';">&times;</button>
  
  
          <div class = "background-color-lwr-px">
            <button id = "default-color-btn-lwr-px" style = "display: <?php if(strcmp("bright", $fetched_result['refvalue']) == 0 || strcmp("dark", $fetched_result['refvalue']) == 0) {echo 'none';}?>"><i class="fa fa-moon-o" style = "color: white"></i></button>
            <button id = "color-btn-dark-lwr-px" style = "display: <?php if(strcmp("bright", $fetched_result['refvalue']) == 0) {echo 'block';}else{echo 'none';}?>"><i class="fa fa-moon-o" style = "color: white"></i></button>
            <button id = 'color-btn-bright-lwr-px' style = "display: <?php if(strcmp("dark", $fetched_result['refvalue']) == 0) {echo 'block';}else{echo 'none';}?>"><i class="fa fa-sun-o" style = "color: white"></i></button>
          </div>
  
  
  
          <div id = "logout-lwr-px">
            <a href = "signout.php"><button id = "logout-btn"><i class = "fa fa-power-off" style = "color: red"></i></button></a>
          </div>
        </div>  <!-- list-background-lwr-px -->
      </div> <!-- Alternate switch end -->

    </div>  
  </div>
  <!---img section--->
  <div id = "outer-image-container">
    <div id = "profile-image-container">
      <div id = "background-image-container">
        <img id = "background-image" src = "fileStorage/scenery.jpg" alt = "image" name = "back-img" onclick = "enLarge()"/>
      </div>
      <div id = "pop-up-box-zoom" class = "box-css">
        <div id = "pop-up-zoom">
          <span class = "close-img" onclick = "cutImg()">&times;</span>
          <img id = "zoom-image" src = "fileStorage/scenery.jpg" alt = "image"/>
        </div>
      </div>

      <?php
        $sql = "SELECT * FROM `registration` WHERE id = '$result_id'";
        $result = mysqli_query($connect, $sql);
        $fetched_result = mysqli_fetch_assoc($result);
      ?>

      <img id = "profile-image" src = "fileStorage/<?=$fetched_result['photo'];?>" name = "prof-img"/>
      <p id = "your-name"><?=$fetched_result['name'];?></p>

    </div>
  </div>
  <!---container start--->
  <div id = "index-container">
  <div id = "navbar-main-container">
    <button id = "photo-btn" onclick = "photoFunc(); clickingColor(event)" class = "colorlink"><a href = "#">Photo</a></button>
    <button id = "video-btn" onclick = "videoFunc(); clickingColor(event)" class = "colorlink"><a href = "#">Video</a></button>
    <button id = "file-btn" onclick = "fileFunc(); clickingColor(event)" class = "colorlink"><a href = "#">File</a></button>
    <button id = "note-btn" onclick = "noteFunc(); clickingColor(event)" class = "colorlink"><a href = "#">Notes</a></button>
  </div>
  <div id = "main-container">
    <div id = "left-main-container">

      <div id = "upload_file" style = "margin-left: 10px; margin-top: 20px;">
          <p id = "upload-information">*jpg/jpeg, png, gif, mp4, txt, pdf are allowed!</p>
          <i class="fa fa-upload" style = "margin-right: 5px;"></i><input type = "file" id = "upload" name = "uploading" required/><br/><br/>
          <textarea id = "written-text" placeholder = "Write about this file..."></textarea><br/>
          <input type = "submit" name = "submit" value = "submit" style = "background: #00802b; color: #ffffff; cursor: pointer;" onclick = "sendFile()"/>
      </div>

      <hr style = "width: 100%; padding: 1px; background: #000000;"/>
      
      <div id = "output">
      
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
           
           $sql = "SELECT * FROM file_store WHERE user_id = '$result_id'";
           $result = mysqli_query($connection, $sql);
           $i = 1;
           while($fetched_result = mysqli_fetch_assoc($result))
           {      
             $x = $fetched_result['file'];
             $array_file = explode(".", $x);   
             $sanatized_cmt = stripslashes($fetched_result['comment']);
      ?>
   
      <?php
        if(in_array("jpg", $array_file) || in_array("png", $array_file) || in_array("jpeg", $array_file) || in_array("gif", $array_file))
        {
      ?>
         
          <div onerror = "this.style.display = 'none'" class = "file-block">
             <img src = "dataStorage/<?=$fetched_result['file'];?>" alt = "image" class = "display-file image" onclick = "document.getElementById('zoom-container-<?=$i;?>').style.display = 'block';"/><br/>                                    
             <p class = "display-comment"><?=$sanatized_cmt;?></p>
             <p style = "font-size: 8px;" class = "display-comment"><?=$fetched_result['time'];?></p>
          </div>

              <div id = "zoom-container-<?=$i;?>" class = "box-css" style = "display: none; position: absolute; z-index: 5; padding-top: 20px; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4);">
                 <div id = "img-zoom">
                   <span class = "close-img" onclick = "document.getElementById('zoom-container-<?=$i;?>').style.display = 'none';">&times;</span>
                   <img id = "file-image" src = "dataStorage/<?=$fetched_result['file'];?>" alt = "image"/>
                 </div>
              </div>
         
      <?php
         }
      ?>         
      <?php
        if(in_array("mp4", $array_file))
        {
      ?>
  
          <div onerror = "this.style.display = 'none'" class = "file-block">
             <video class = "display-file" controls>
               <source src = "dataStorage/<?=$fetched_result['file'];?>" type="video/mp4"/>
             </video><br/>                                    
             <p class = "display-comment"><?=$sanatized_cmt;?></p>
             <p style = "font-size: 8px;" class = "display-comment"><?=$fetched_result['time'];?></p>
          </div>
                   
       <?php
         }
       ?>
       <?php
        if(in_array("txt", $array_file) || in_array("pdf", $array_file))
        {
       ?>
          
          <div onerror = "this.style.display = 'none'" class = "file-block">
             <a href = "dataStorage/<?=$fetched_result['file'];?>" target = "_blank"><img id = "file-img" src = "fileStorage/512px-File_alt_font_awesome.svg.png" alt = "image" class = "display-file"/></a><br/>                                    
             <p class = "display-comment"><?=$sanatized_cmt;?></p>
             <p style = "font-size: 8px;" class = "display-comment"><?=$fetched_result['time'];?></p>
          </div>
        
        <?php
          }
          if(is_numeric($x) == true)  
          {
            $sentence = stripslashes($fetched_result['comment']);
            $result_array = explode(" ", $sentence);
        ?>
        
          <div onerror = "this.style.display = 'none'" class = "file-block">                                   
             <!-- <div class = "display-comment"></div> -->
             <p id = 'comment' class = "display-file"><?=$result_array[0]." ".$result_array[1]." ".$result_array[2]." ".$result_array[3]." ".$result_array[4]." ".$result_array[5]." ".$result_array[6]." ".$result_array[7]." ".$result_array[8]." ".$result_array[9]." ".$result_array[10]." ".$result_array[11]." ".$result_array[12]." ".$result_array[13]." ".$result_array[14]." ".$result_array[15]."...."?></p>
             <p style = 'font-size: 8px;' id = "comment-time"><?=$fetched_result['time']?></p>
          </div>

      <?php
              }
               $i++;
           }            // while loop
           mysqli_close($connection);
      ?>        
      </div>  <!---output--->
      
    </div>
  </div>
  <div id = "footer-container">
    <p id = "copyright">&copy: <span id = "year"></span> MyCloud. Developed By Ritabrata Goswami.</p>
    <p id = "scroll-switch"><a href = "#your-name" style = "text-decoration: none;">Back to Top</a></p>
    <p id = "date" style = "font-size: 11px; float: right; padding: 1px;"></p>
  </div>
  </div> <!---index container--->
</div> <!---data-container--->

<div id = "pop-up-search-container-box" class = "box-css">
  <div class = "pop-up-serach-box">
  <span class = "close" onclick = "closeSearch()">&times;</span>
    <div style = "text-align: center; font-size: 20px;">Please Provide Proper Search Qurey</div>
  </div>
</div>

<div id = "pop-up-search-result-box" class = "box-css">
  <div class = "pop-up-serach-result-box">
  <span class = "close" onclick = "closeSearchResult()">&times;</span>
    <div id = 'display-search-result'></div>
  </div>
</div>

<div id = "pop-up-warning-box" class = "box-css">
  <div id = "pop-up-warning">
  <span class = "close" onclick = "closeWarning()">&times;</span>
    <div style = "text-align: center; font-size: 20px;">HURRY UP! Your Session Will Out Soon!</div>
  </div>
</div>

<div id = "pop-up-warning-box-delete" class = "box-css">
    <div id = "pop-up-warning-delete">
      <span class = "close-del" onclick = "closeDel()">&times;</span>
        <div id = 'warning-box'>
          <div style = 'font-size: 25px;'>Confirm delete?</div>
          <br/>
          <input type = "checkbox" id = "checking" style = "display: none;"/>
          <button id = 'Yes'>Yes</button>
          <button id = 'No'>No</button> 
        </div>
    </div>
</div>

<div id = "pop-up-delete-success-box" class = "box-css">
  <div id = "pop-up-delete-success">
  <span class = "close" onclick = "closeDeleteMessage()">&times;</span>
    <div style = "text-align: center;" id = 'delete-success-message'></div>
  </div>
</div>

<script>
let enLarge = () => {
 document.getElementById("pop-up-box-zoom").style.display = "block";
 document.getElementById("zoom-image").style.width = "100%";
 document.getElementById("zoom-image").style.height = "auto";
}
let cutImg = () => {document.getElementById("pop-up-box-zoom").style.display = "none";}
window.onclick = (event) => {
 if(event.target == document.getElementById("pop-up-box-zoom"))
 {
   document.getElementById("pop-up-box-zoom").style.display = "none";
 }
}
</script>
<script>
function sendFile() 
{
    let formData = new FormData(); 
    //let uploadedFile = document.getElementById("upload").files[0];
    let cmmt = document.getElementById("written-text").value;
    // let cmtVal = encodeURIComponent(cmmt);   
    let id = document.getElementById("user-id").value;         
    formData.append("yourFile", upload.files[0]);
    formData.append("yourComment", cmmt);    
    formData.append("user_id", id);
    fetch('action_file_save.php', {method: "POST", body: formData});
    
    alert('Your file has been uploaded successfully!');
}
</script>
<script>
  let photoFunc = () => {
  let u_id_img = document.getElementById("user-id").value;
  let formData_img = new FormData();
  formData_img.append("user_file_id_img", u_id_img);

  var xmlObj_img = new XMLHttpRequest();
  xmlObj_img.onreadystatechange = function() 
  {
   if(xmlObj_img.status == 200)
   {
    document.getElementById("output").innerHTML = this.responseText;
   }
  };
  xmlObj_img.open("POST", "get_image.php");
  xmlObj_img.send(formData_img);
  }

                     /*video function */
  let videoFunc = () => {
  let u_id_vid = document.getElementById("user-id").value;
  let formData_vid = new FormData();
  formData_vid.append("user_file_id_vid", u_id_vid);

  var xmlObj_vid = new XMLHttpRequest();
  xmlObj_vid.onreadystatechange = function() 
  {
   if(xmlObj_vid.status == 200)
   {
    document.getElementById("output").innerHTML = this.responseText;
   }
  };
  xmlObj_vid.open("POST", "get_video.php");
  xmlObj_vid.send(formData_vid);
  }

                      /*file function */
  let fileFunc = () => {
  let u_id_file = document.getElementById("user-id").value;
  let formData_file = new FormData();
  formData_file.append("user_file_id_file", u_id_file);

  var xmlObj_file = new XMLHttpRequest();
  xmlObj_file.onreadystatechange = function() 
  {
   if(xmlObj_file.status == 200)
   {
    document.getElementById("output").innerHTML = this.responseText;
   }
  };
  xmlObj_file.open("POST", "get_file.php");
  xmlObj_file.send(formData_file);
  }

                    /*note function */
  let noteFunc = () => {
  let u_id_note = document.getElementById("user-id").value;
  let formData_note = new FormData();
  formData_note.append("user_file_id_note", u_id_note);

  var xmlObj_note = new XMLHttpRequest();
  xmlObj_note.onreadystatechange = function() 
  {
   if(xmlObj_note.status == 200)
   {
    document.getElementById("output").innerHTML = this.responseText;
   }
  };
  xmlObj_note.open("POST", "get_note.php");
  xmlObj_note.send(formData_note);
  } 
</script>
<script>
let showResult = () => {

let searchQuery = document.getElementById('entered-query').value;
let searchId = document.getElementById("user-id").value;
let searchData = new FormData();
searchData.append("search_val", searchQuery);
searchData.append("id_user", searchId);

if(searchQuery == '') 
{
  document.getElementById("pop-up-search-container-box").style.display = "block";
} 
else 
{
  const searchhttp = new XMLHttpRequest();
  searchhttp.onreadystatechange = function() {
    if(searchhttp.status == 200)
    {
      document.getElementById("display-search-result").innerHTML = this.responseText;
      document.getElementById("pop-up-search-result-box").style.display = 'block';
    }  
  }
  searchhttp.open("POST", "search.php");
  searchhttp.send(searchData);
}
}

let closeSearch = () => {document.getElementById("pop-up-search-container-box").style.display = 'none';}
let closeSearchResult = () => {document.getElementById("pop-up-search-result-box").style.display = 'none';}
</script>
<script>
function clickingColor(event)
{
 const getLink = document.getElementsByClassName("colorlink");
 for(let i = 0; i < getLink.length; i++)
 {
  getLink[i].className = getLink[i].className.replace("active","");
 }
 event.currentTarget.className = event.currentTarget.className + " active";
}
</script>
<script>
var d = new Date(); 
document.getElementById("year").innerHTML = d.getFullYear();
document.getElementById("date").innerHTML = d.toDateString();
</script>
<script>
function stopWatch() 
{
  let d = new Date();
  let s = 00;           
  setInterval(timer, 1000);
             
  function timer() 
  {   
   s = s + 1;             
   d.setMinutes(0);                
   d.setSeconds(s);               
   let second = d.getSeconds();
   let minute = d.getMinutes();
   if(second < 10)
   {
     second = "0" + second;
   }
   document.getElementById("time-show").innerHTML = minute + ":" + second;
   document.getElementById("timer-run").value = minute;
  } 
}
</script>
<script>
  setTimeout(moveForward, 600000);
  function moveForward() {location.replace("signout.php");}
  setTimeout(warningMessageShow, 420000);  
  setTimeout(warningMessageOff, 430000);  
  function warningMessageShow() {document.getElementById("pop-up-warning-box").style.display = 'block';}
  function warningMessageOff() {document.getElementById("pop-up-warning-box").style.display = 'none';}
  function closeWarning() {document.getElementById("pop-up-warning-box").style.display = 'none';}

  let boxOne = document.getElementById("pop-up-warning-box");
  window.onclick = (event) => {
  if(event.target == boxOne)
  {
    document.getElementById("pop-up-warning-box").style.display = "none";
  }
  else if(event.target == document.getElementById("pop-up-warning-box-delete"))
  {
    document.getElementById("pop-up-warning-box-delete").style.display = 'none';
  }
  else if(event.target == document.getElementById("pop-up-delete-success-box"))
  {
    document.getElementById("pop-up-delete-success-box").style.display = 'none';
  }
  else if(event.target == document.getElementById("pop-up-search-container-box"))
  {
    document.getElementById("pop-up-search-container-box").style.display = 'none';
  }
  else if(event.target == document.getElementById("pop-up-search-result-box"))
  {
    document.getElementById("pop-up-search-result-box").style.display = 'none';
  }
 }
// let time = document.getElementById("timer-run").value;
// var xmlObj = new XMLHttpRequest();
// xmlObj.onreadystatechange = () => {
//   if(xmlObj.status == 200)
//   {
//     document.getElementById("output").innerHTML = this.responseText;
//   }
//  };
//  xmlObj.open("POST", "logout.php");
//  xmlObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//  xmlObj.send("time= " + time); 
</script>
<script>        /*Delete function*/
  let delFunc = (id) => {
    document.getElementById("pop-up-warning-box-delete").style.display = 'block';
    document.getElementById("Yes").addEventListener("click", clickYes);
    document.getElementById("No").addEventListener("click", clickNo);
    function clickYes()
    {
      checkFuncYes(id);
      document.getElementById("pop-up-warning-box-delete").style.display = 'none';
    }
    function clickNo()
    {
      document.getElementById("pop-up-warning-box-delete").style.display = 'none';
    }
}

  function checkFuncYes(id) 
  {
    let formData = new FormData();
    formData.append("file_id", id);

    var xmlObj = new XMLHttpRequest();
    xmlObj.onreadystatechange = function() 
    {
     if(xmlObj.status == 200)
     { 
       document.getElementById("delete-success-message").innerHTML = this.responseText;
       document.getElementById("pop-up-delete-success-box").style.display = 'block';
     }
    };
    xmlObj.open("POST", "delete_script.php");
    xmlObj.send(formData);
  }
  
  function closeDel() {document.getElementById("pop-up-warning-box-delete").style.display = 'none';}
  function closeDeleteMessage() {document.getElementById("pop-up-delete-success-box").style.display = 'none';}
</script>
<script>         /*show function */
  function displayCmtFunc(id)
  {
    let formData = new FormData();
    formData.append("showing_id", id);
    var xmlReq = new XMLHttpRequest();
    xmlReq.onreadystatechange = function() 
    {
      if(xmlReq.status == 200)
      {
        document.getElementById("display-comment").innerHTML = this.responseText;
      }
    }
    xmlReq.open("POST", "show_cmt_script.php");
    xmlReq.send(formData);
    // alert("The Show id is:- " + id);
  }

  function displayPhotoFunc(id)
  {
    let formDataImg = new FormData();
    formDataImg.append("showing_id", id);
    var xmlReqImg = new XMLHttpRequest();
    xmlReqImg.onreadystatechange = function() 
    {
      if(xmlReqImg.status == 200)
      {
        document.getElementById("output-image-script").innerHTML = this.responseText;
      }
    }
    xmlReqImg.open("POST", "show_image_script.php");
    xmlReqImg.send(formDataImg);
    // alert("The Show id is:- " + id);
  }

  function displayVideoFunc(id)
  {
    let formDataVid = new FormData();
    formDataVid.append("showing_id", id);
    var xmlReqVid = new XMLHttpRequest();
    xmlReqVid.onreadystatechange = function() 
    {
      if(xmlReqVid.status == 200)
      {
        document.getElementById("output-video-script").innerHTML = this.responseText;
      }
    }
    xmlReqVid.open("POST", "show_video_script.php");
    xmlReqVid.send(formDataVid);
    // alert("The Show id is:- " + id);
  }

  function displayFileFunc(id)
  {
    let formDataFile = new FormData();
    formDataFile.append("showing_id", id);
    var xmlReqFile = new XMLHttpRequest();
    xmlReqFile.onreadystatechange = function() 
    {
      if(xmlReqFile.status == 200)
      {
        document.getElementById("output-file-script").innerHTML = this.responseText;
      }
    }
    xmlReqFile.open("POST", "show_file_script.php");
    xmlReqFile.send(formDataFile);
    // alert("The Show id is:- " + id);
  }
</script>
<script>
document.getElementById("default-color-btn").addEventListener("click", defaultColorFunc);  
document.getElementById("color-btn-dark").addEventListener("click", darkFunc);
document.getElementById("color-btn-bright").addEventListener("click", brightFunc);

function defaultColorFunc()
{
  document.getElementById("default-color-btn").style.display = 'none';
  document.getElementById("color-btn-dark").style.display = 'none';
  document.getElementById("color-btn-bright").style.display = 'block';
  defaultReturnFunc();
}
function darkFunc() 
{
  document.getElementById("color-btn-dark").style.display = 'none';
  document.getElementById("color-btn-bright").style.display = 'block';
  darkReturnFunc();
}
function brightFunc()
{
  document.getElementById("color-btn-dark").style.display = 'block';
  document.getElementById("color-btn-bright").style.display = 'none';
  brightReturnFunc();
}

function defaultReturnFunc()
{
  let setDefColor = "dark";
   let defId = document.getElementById("user-id").value;
   let xmlReqDef = new XMLHttpRequest();
   xmlReqDef.onreadystatechange = function()
   {
     if(xmlReqDef.status == 200) 
     {
      document.getElementById("styling-sheet").innerHTML = xmlReqDef.responseText;
     }
   }
   xmlReqDef.open("POST", "main_page_background_set_def.php");
   xmlReqDef.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlReqDef.send("ref_val_def="+setDefColor+"&u_id="+defId);
  //  alert(setDefColor+" and "+defId);
}

function darkReturnFunc()
{
   let setValDark = "dark";
   let darkId = document.getElementById("user-id").value;
   let xmlReqDark = new XMLHttpRequest();
   xmlReqDark.onreadystatechange = function()
   {
     if(xmlReqDark.status == 200) //http: 200
     {
      document.getElementById("styling-sheet").innerHTML = xmlReqDark.responseText;
      // document.getElementById("styling-sheet-dark").style.display = 'block';
     }
   }
   xmlReqDark.open("POST", "main_page_background_set_dark.php");
   xmlReqDark.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlReqDark.send("ref_val_dark="+setValDark+"&u_id="+darkId);
  //  alert(setValDark+" and "+darkId);
}
function brightReturnFunc()
{
  let setValBright = "bright";
  let brightId = document.getElementById("user-id").value;
   let xmlReqBright = new XMLHttpRequest();
   xmlReqBright.onreadystatechange = function()
   {
     if(xmlReqBright.status == 200) 
     {
      document.getElementById("styling-sheet").innerHTML = xmlReqBright.responseText;
     }
   }
   xmlReqBright.open("POST", "main_page_background_set_bright.php");
   xmlReqBright.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlReqBright.send("ref_val_bright="+setValBright+"&u_id="+brightId);
  //  alert(setValBright+" and "+brightId);
}
</script>
<script>
document.getElementById("default-color-btn-lwr-px").addEventListener("click", defaultColorFunc);  
document.getElementById("color-btn-dark-lwr-px").addEventListener("click", darkFunc);
document.getElementById("color-btn-bright-lwr-px").addEventListener("click", brightFunc);

function defaultColorFunc()
{
  document.getElementById("default-color-btn-lwr-px").style.display = 'none';
  document.getElementById("color-btn-dark-lwr-px").style.display = 'none';
  document.getElementById("color-btn-bright-lwr-px").style.display = 'block';
  defaultReturnFunc();
}
function darkFunc() 
{
  document.getElementById("color-btn-dark-lwr-px").style.display = 'none';
  document.getElementById("color-btn-bright-lwr-px").style.display = 'block';
  darkReturnFunc();
}
function brightFunc()
{
  document.getElementById("color-btn-dark-lwr-px").style.display = 'block';
  document.getElementById("color-btn-bright-lwr-px").style.display = 'none';
  brightReturnFunc();
}

function defaultReturnFunc()
{
  let setDefColor = "dark";
   let defId = document.getElementById("user-id").value;
   let xmlReqDef = new XMLHttpRequest();
   xmlReqDef.onreadystatechange = function()
   {
     if(xmlReqDef.status == 200) 
     {
      document.getElementById("styling-sheet").innerHTML = xmlReqDef.responseText;
     }
   }
   xmlReqDef.open("POST", "main_page_background_set_def.php");
   xmlReqDef.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlReqDef.send("ref_val_def="+setDefColor+"&u_id="+defId);
  //  alert(setDefColor+" and "+defId);
}

function darkReturnFunc()
{
   let setValDark = "dark";
   let darkId = document.getElementById("user-id").value;
   let xmlReqDark = new XMLHttpRequest();
   xmlReqDark.onreadystatechange = function()
   {
     if(xmlReqDark.status == 200) //http: 200
     {
      document.getElementById("styling-sheet").innerHTML = xmlReqDark.responseText;
      // document.getElementById("styling-sheet-dark").style.display = 'block';
     }
   }
   xmlReqDark.open("POST", "main_page_background_set_dark.php");
   xmlReqDark.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlReqDark.send("ref_val_dark="+setValDark+"&u_id="+darkId);
  //  alert(setValDark+" and "+darkId);
}
function brightReturnFunc()
{
  let setValBright = "bright";
  let brightId = document.getElementById("user-id").value;
   let xmlReqBright = new XMLHttpRequest();
   xmlReqBright.onreadystatechange = function()
   {
     if(xmlReqBright.status == 200) 
     {
      document.getElementById("styling-sheet").innerHTML = xmlReqBright.responseText;
     }
   }
   xmlReqBright.open("POST", "main_page_background_set_bright.php");
   xmlReqBright.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xmlReqBright.send("ref_val_bright="+setValBright+"&u_id="+brightId);
  //  alert(setValBright+" and "+brightId);
}
</script>

</body>
</html>

<?php
 }
}
else      
{                          //If id not get in a session forward to below link.  
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}

if(session_destroy())      //If page reload session will destroy and forward to below link.
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>