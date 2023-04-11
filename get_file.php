<?php
session_start();
error_reporting(0);

$user_file = $_POST['user_file_id_file'];    //$_POST['user_file_id']
$_SESSION['id_file'] = $user_file;
if(isset($_SESSION['id_file']))
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
    /* background: #cccccc;
    border-radius: 5px;   */
 }
.display-file {
width: 180px;
cursor: pointer;
}
/* #image {
     border-radius: 5px; 
     transition: 0.7s;
     height: 180px; 
     width: 180px;
     cursor: pointer;
 } */
#output-file-script {
  position: sticky;
  top: 10px;
}
#heading {
  margin-left: 20px;
  margin-bottom: 10px;
  font-size: 20px;
}
#pdf-file {
  width: 70%;
  height: 700px;
  margin-left: 20px;
  background: #f1f1f1;
}
#comment {
  white-space: nowrap;
  width: 180px;
  overflow: hidden; 
  text-overflow: ellipsis; 
}
#show {
  color: #ffffff;
  background: #3377ff;
  cursor: pointer;
}
#dnl-btn {
  background: #00802b;
  color: #ffffff;
  cursor: pointer;
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
  #image-container {
  text-align: center;  
  margin-top: 30px;
  }
  #right-container {
  flex: 100%;
  }
  #left-container {flex: none;}
  #show {display: none;}
  #comment {margin: auto;}
  #description {padding: 20px;}
}
</style>

<div id = "container">
  <div id = "left-container">
    <div id = "output-file-script">
       <!-- <div id = "heading"></div> 
       <iframe id = "pdf-file" title="pdf or txt files" onerror = "this.style.display = 'none';"></iframe> -->
    </div>
  </div>
  <div id = "right-container">
    <p id = "description" style = "color: #1a75ff; font-size: 15px;">Incase PDF or txt file is not opening by clicking Open File, click on the File Image. (This will open the file in seperate tab).</p>
<?php
$sql = "SELECT * FROM file_store WHERE user_id = '$user_file'";
$result = mysqli_query( $connection, $sql);
while($fetched_result = mysqli_fetch_assoc($result))
{
    $x = $fetched_result['file'];
    $array_file = explode(".", $x);

    $sanatized_file_cmt = stripslashes($fetched_result['comment']);

    if(in_array("txt", $array_file) || in_array("pdf", $array_file))
    {

?>


            <div id = "image-container">
            <a href = "dataStorage/<?=$fetched_result['file'];?>" target = "_blank"><img id = "file-img" src = "fileStorage/512px-File_alt_font_awesome.svg.png" alt = "image" class = "display-file"/></a><br/> 
                 <p id = 'comment'><?=$sanatized_file_cmt?></p>
                 <p style = 'font-size: 11px;' id = "comment-time"><?=$fetched_result['time']?></p>
                 <button id = 'del' onclick = "delFunc(<?=$fetched_result['id'];?>)">Delete</button>
                 <button id = 'show' onclick = "displayFileFunc(<?=$fetched_result['id'];?>)">Open File</button>
                 <button id = "dnl-btn"><a href = "dataStorage/<?=$fetched_result['file'];?>" style = "text-decoration: none;" download>Download</a></button>
            </div>
            <hr style = 'width: 80%; background: #000000; margin: auto;'>   
            <!-- document.getElementById('pdf-file').src = 'dataStorage/<?=$fetched_result['file'];?>'; document.getElementById('heading').innerHTML = '<?=$fetched_result['comment']?>' -->

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
