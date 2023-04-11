<?php
session_start();
error_reporting(0);

$get_id = $_GET['content'];
$edit_id_show = base64_decode($get_id);
$_SESSION['edit_id'] = $edit_id_show;
if(isset($_SESSION['edit_id']))
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

    $sql = "SELECT comment FROM file_store WHERE id = '$edit_id_show'";
    $result = mysqli_query($connection, $sql);
    $fetched_result = mysqli_fetch_assoc($result);
?>

<title>MyCloud</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel = "icon" href = "iconStorage/logo_f.jpg">
<style type = "text/css">
 #edit-written-text {
 padding: 10px;
 width: 60%;
 height: 150px;
 }
 #save-btn {
 background: #00802b;
 color: #ffffff;
 cursor: pointer;
 }
 #output {
    display: none;
    background: #00b38f;
    padding: 10px;
    margin-top: 20px;
    text-align: center;
 }
</style>

<div id = "output"></div>

<div style = 'margin-top: 30px; margin-left: 15px;'>
  <h2>Edit Your Note</h2>
  <input type = 'text' id = 'edit-note-id' name = 'edit_id_shown' value = '<?=$edit_id_show?>' style = 'display: none;'/>
  <textarea id = "edit-written-text" placeholder = "Write about this file..."><?=stripslashes($fetched_result['comment']);?></textarea>
  <br/><br/>
  <button id = "save-btn" onclick = "saveEditFunc()">Save Edit</button>
</div>

<script>
 function saveEditFunc() 
 {
    let value = document.getElementById('edit-written-text').value;
    let enWrittenVal = encodeURIComponent(value);
    let editIdSend = document.getElementById('edit-note-id').value; 
    var xmlReq = new XMLHttpRequest();
    xmlReq.onreadystatechange = function()
    {
        if(xmlReq.status == 200)
        {
            document.getElementById("output").innerHTML = this.responseText;
            document.getElementById("output").style.display = 'block';
        }
    }
    xmlReq.open("POST", "edit_note_save.php");
    xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlReq.send("edit-comment="+enWrittenVal+"&content-id="+editIdSend);
    // alert("comment:- "+writtenVal+"<br/>"+"ID:- "+editIdSend);
 }
</script>
<?php
}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}

// if(session_destroy())
// {
//   header("Location: http://localhost/Ritabrata/mycloud.html");
//   exit();
// }
// echo "<h2>Hello. This is edit note.</h2>";
// echo "Your content id is:- ".$edit_id_show;
?>