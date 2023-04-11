<?php
session_start();
error_reporting(0);

$user_note = $_POST['user_file_id_note'];    //$_POST['user_file_id']
$_SESSION['id_note'] = $user_note;
if(isset($_SESSION['id_note']))
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
#image {
     border-radius: 5px; 
     transition: 0.7s;
     height: 180px; 
     width: 180px;
     cursor: pointer;
 }
#output {
  position: sticky;
  top: 10px;
}
/* #comment {
  white-space: nowrap;
  width: 180px;
  overflow: hidden; 
  text-overflow: ellipsis;
} */
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
#show {
  color: #ffffff;
  background: #3377ff;
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
#display-image {
  width: 50%;
  height: auto;
  margin: 20px;
}
#display-comment {
  margin: 20px;
  font-size: 15px;
}
#edit-btn {
  background: #0099cc;
  color: #ffffff;
  cursor: pointer;  
}
</style>


<div id = "container">
  <div id = "left-container">

    <div id = "output">
        <div id = "display-comment"></div>
        <!-- <p id = "date" style = 'font-size: 10px; margin: 20px;'></p> -->
    </div>  <!-- output -->

  </div>
  <div id = "right-container">

<?php
$sql = "SELECT * FROM file_store WHERE user_id = '$user_note'";
$result = mysqli_query($connection, $sql);
while($fetched_result = mysqli_fetch_assoc($result))
{
    $x = $fetched_result['file'];
    // $array_file = explode(".", $x);
    // $edit_id = $fetched_result['id'];
    // $encoded_id = convert_uudecode($edit_id);

    if(is_numeric($x) == true)  //in_array(" ", $array_file)
    {
       
      $sentence = stripslashes($fetched_result['comment']);
      $result_array = explode(" ", $sentence);      
?>

            
            <div id = "image-container">
                 <p id = 'comment'><?=$result_array[0]." ".$result_array[1]." ".$result_array[2]." ".$result_array[3]." ".$result_array[4]." ".$result_array[5]." ".$result_array[6]." ".$result_array[7]." ".$result_array[8]." ".$result_array[9]." ".$result_array[10]." ".$result_array[11]." ".$result_array[12]." ".$result_array[13]." ".$result_array[14]." ".$result_array[15]." ".$result_array[16]."...."?></p>
                 <p style = 'font-size: 11px;' id = "comment-time"><?=$fetched_result['time']?></p>
                 <input type = 'text' name = 'get_file_id' id = 'file_id_val' value = "<?=$fetched_result['id'];?>" style = 'display: none;'/>
                 <button id = 'del' onclick = "delFunc(<?=$fetched_result['id'];?>);">Delete</button>
                 <button id = 'show' onclick = "displayCmtFunc(<?=$fetched_result['id']?>)">Show Details</button>  
                 <button id = 'edit-btn'><a href = 'edit_notes.php?content=<?=base64_encode($fetched_result['id']);?>' style = "text-decoration: none;" target = "_blank">Edit</a></button>
            </div>
            <hr style = 'width: 80%; background: #000000'>   
          
            <!-- document.getElementById('display-image').src = 'dataStorage/<?=$fetched_result['file'];?>'; document.getElementById('display-comment').innerHTML = '<?=$fetched_result['comment']?>'; document.getElementById('date').innerHTML = '<?=$fetched_result['time']?>'; -->
            <!-- document.getElementById('display-comment').innerHTML = '<?=$fetched_result['comment']?>'; -->

<?php
    }
  }
?>
  </div>  <!-- right-container -->
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





// $sentence = "I love my Cat. That cat is black in color. That is cool to keep a cat in house.";
// $result_array = explode(" ", $sentence);
// echo $result_array[0]." ".$result_array[1]." ".$result_array[2]." ".$result_array[3]." ".$result_array[4]." ".$result_array[5]." ".$result_array[6]." ".$result_array[7]." ".$result_array[8]."....";
?>