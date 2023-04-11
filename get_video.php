<?php
session_start();
error_reporting(0);

$user_vid = $_POST['user_file_id_vid'];    //$_POST['user_file_id']
$_SESSION['id_vid'] = $user_vid;
if(isset($_SESSION['id_vid']))
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
?>

<!---<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--->
<style type = "text/css">
  #container {
   display: flex;
  }
  #left-container {
  flex: 80%;
  }
  #right-container {
  flex: 20%;
  }
  #image-container {
    margin-right: 5px;
    margin-left: 20px;
    margin-bottom: 30px;
    margin-top: 20px;
    /* background: #cccccc;
    border-radius: 5px;   */
 }
.display-file {
 width: 180px;
cursor: pointer;
}
#heading {
  margin-left: 20px;
  margin-bottom: 10px;
  font-size: 20px;
}
.Video-show {
  width: 50%;
  height: auto;
  margin-left: 20px;
}
/* #image {
     border-radius: 5px; 
     transition: 0.7s;
     height: 180px; 
     width: 180px;
     cursor: pointer;
 } */
#output-video-script {
  position: sticky;
  top: 50px;
}
#comment {
  white-space: nowrap;
  width: 180px;
  overflow: hidden; 
  text-overflow: ellipsis; 
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
.delete-box-css {
display: none; 
position: fixed;
z-index: 1; 
padding-top: 20px; 
left: 0;
top: 0;
width: 100%;
height: 100%; 
background-color: rgba(0,0,0,0.4); 
}
#pop-up-delete-warning {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
#del {
  color: #ffffff;
  background: #ff3333;
  cursor: pointer;
}
#dnl-btn {
  background: #00802b;
  color: #ffffff;
  cursor: pointer;
}
#show-sepe-btn {display: none;}
.close-del {
float: right; 
cursor: pointer; 
font-weight: bold; 
font-size: 45px;
}
.close:hover {
color: #000000;
}

@media only screen and (max-width: 750px) {
  .Video-show {
  width: 95%;
  height: auto;
  margin-left: 20px;
  }
}
@media only screen and (max-width: 700px) {
  #show-sepe-btn {
    display: block;
    background: #0099cc;
    color: #ffffff;
  }
  #right-container {
  flex: 100%;
  }
  #left-container {flex: none;}
  .display-file {
  width: 250px;
  cursor: pointer;
  }
  #image-container {
  text-align: center;  
  margin-top: 30px;
  }
  #comment {margin: auto;}
  #show-sepe-btn {margin: auto;}
}
</style>

<div id = "container">
  <div id = "left-container">
    <div id = "output-video-script">
      <!-- <div id = "heading"></div>  
      <video class = "Video-show" id = "showing-vid" controls onerror = "this.style.display = 'none';">
        <source id = "produce-vid" type="video/mp4"/>
      </video> -->
    </div>
  </div>
  <div id = "right-container">

<?php
$sql = "SELECT * FROM file_store WHERE user_id = '$user_vid'";
$result = mysqli_query( $connection, $sql);
while($fetched_result = mysqli_fetch_assoc($result))
{
    $x = $fetched_result['file'];
    $array_file = explode(".", $x);

    $sanatized_vid_cmt = stripslashes($fetched_result['comment']);

    if(in_array("mp4", $array_file))
    {

?>


            <div id = "image-container">
                <video class = "display-file" onclick = "displayVideoFunc(<?=$fetched_result['id'];?>)">
                    <source src = "dataStorage/<?=$fetched_result['file'];?>" type="video/mp4"/>
                </video> 
                 <p id = 'comment'><?=$sanatized_vid_cmt?></p>
                 <p style = 'font-size: 11px;' id = "comment-time"><?=$fetched_result['time']?></p>
                 <button id = 'del' onclick = "delFunc(<?=$fetched_result['id'];?>)">Delete</button>
                 <button id = "dnl-btn"><a href = "dataStorage/<?=$fetched_result['file'];?>" style = "text-decoration: none;" download>Download</a></button>
                 <button id = "show-sepe-btn"><a href = "search_display_result.php?id=<?=base64_encode($fetched_result['id']);?>" target = "_blank" style = "text-decoration: none;">Play Video</a></button>
            </div>
            <hr style = 'width: 80%; background: #000000; margin: auto;'>   
            <!-- document.getElementById('showing-vid').src = 'dataStorage/<?=$fetched_result['file'];?>'; document.getElementById('heading').innerHTML = '<?=$fetched_result['comment']?>';  -->

<?php
    }
  }
?>
  </div>
</div>  <!---container--->

<!-- <div id = "pop-up-delete-warning-box" class = "delete-box-css">
    <div id = "pop-up-delete-warning">
      <span class = "close-del" onclick = "closeDel()">&times;</span>
        <div id = 'warning-box'>
          <div style = 'font-size: 25px;'>Confirm delete?</div>
          <br/>
          <button id = 'Yes'>Yes</button>
          <button id = 'No'>No</button>
        </div>
    </div>
</div> -->

<script>
// function displayFunc(id)
//   {
//     let formData = new FormData();
//     formData.append("file_id_show", id);
//     var xmlObj = new XMLHttpRequest();
//     xmlObj.open("POST", "get_image.php");
//     xmlObj.send(formData);
//     alert("The Show id is:- " + id);
//   }
  // function idPass()
  // {
  //   let formData = new FormData();
  //   let id_val = document.getElementById('file_id_val').value;
  //   formData.append('file_id', id_val);
  //   var xmlObj = new XMLHttpRequest();
  //   xmlObj.open("POST", "main_page.php");
  //   xmlObj.send(formData);
  // }
//  function fetchImage(id)
//  {
//    var xmlObj = new XMLHttpRequest();
//    xmlObj.onreadystatechange = () => {
//    if(xmlObj.status == 200)
//    {
//      document.getElementById("output").innerHTML = this.responseText;
//    }
//   }
//    http.open("GET", "action_file_save.php");
//    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//    http.send("id= " + id); 
//  }
// let delFunc = () => {
//   document.getElementById("pop-up-delete-warning-box").style.display = 'block';
// }
// function closeDel() {document.getElementById("pop-up-delete-warning-box").style.display = 'none';}
// window.onclick = (event) => {
//   if(event.target == document.getElementById("pop-up-delete-warning-box"))
//   {
//     document.getElementById("pop-up-delete-warning-box").style.display = 'none';
//   }
// }
</script>

<?php
}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}

if(session_destroy())      //If page reload session will destroy and forward to below link.
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>
