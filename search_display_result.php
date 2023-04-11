<?php
$id_val = base64_decode($_GET['id']);
$_SESSION['get_file_id'] = $id_val;
if(isset($_SESSION['get_file_id']))
{
?>

<meta charset = "UTF-8"/>
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0"/>
<link rel = "icon" href = "iconStorage/logo_f.jpg">
<title>MyCloud</title>
<style type = "text/css">
    #pdf-file{
        width: 100%;
        height: 90%;

    }
    #heading {
        margin-left: 20px;
        margin-bottom: 10px;
        font-size: 20px;
    }
    .image {
        width: 50%;
        height: 60%;
    }
    .video {
        width: 50%;
        height: 60%;
    }
    .display-comment {
        font-size: 20px;
    }
    #comment {
        font-size: 17px;
        padding: 5px 15px;
        line-height: 25px;
    }
    @media only screen and (max-width: 850px) {
    .video {
     width: 100%;
     height: auto;
    }
    .image {
     width: 100%;
     height: auto;
    }  
}
</style>

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

    $sql = "SELECT * FROM file_store WHERE id = '$id_val'";
    $result = mysqli_query($connection, $sql);
    $fetched_result = mysqli_fetch_assoc($result);

    $x = $fetched_result['file'];
    $array_file = explode(".", $x);   
    $sanatized_cmt = stripslashes($fetched_result['comment']);

    if(in_array("jpg", $array_file) || in_array("png", $array_file) || in_array("jpeg", $array_file) || in_array("gif", $array_file))
    {
?>

       <p class = "display-comment"><?=$sanatized_cmt;?></p>
       <img src = "dataStorage/<?=$fetched_result['file'];?>" alt = "image" class = "display-file image"/><br/>                                    

<?php
    }
    if(in_array("mp4", $array_file))
    {
?>
        
        <p class = "display-comment"><?=$sanatized_cmt;?></p>
        <video class = "display-file video" controls>
            <source src = "dataStorage/<?=$fetched_result['file'];?>" type="video/mp4"/>
        </video>
            
<?php             
    }
    if(in_array("txt", $array_file) || in_array("pdf", $array_file))
    {
?>

        <div id = "heading"><?=$fetched_result['comment']?></div>
        <iframe id = "pdf-file" src = "dataStorage/<?=$fetched_result['file'];?>" title="pdf or txt files" onerror = "this.style.display = 'none';"></iframe>

<?php
    }
    if(is_numeric($x) == true)  
    {
?>

       <p id = 'comment' class = "display-file"><?=$fetched_result['comment']?></p>

<?php
    }
}
else
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>