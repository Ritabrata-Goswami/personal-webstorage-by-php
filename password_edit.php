<?php
error_reporting(0);
session_start();
if(isset($_SESSION['email']))
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
    
    if(isset($_POST['submit']))
    {
    $session_email = $_SESSION['email'];
    $password = mysqli_real_escape_string($connection, $_POST['password-name']);

    $sql_match = "SELECT * FROM registration WHERE password = '$password'";
    $result_match = mysqli_query($connection, $sql_match);
    $fetched_result = mysqli_fetch_assoc($result_match);

    if($password == '')
    {
       echo "<div style = 'background-color: #ff1a1a; padding: 7px;'><h5><center style = 'color: #ffffff;'>Password Field Can't Be Left Blank!</center></h5></div>";
    }
    else if(strlen($password) < 6)
    {
       echo "<div style = 'background-color: #ff1a1a; padding: 7px;'><h5><center style = 'color: #ffffff;'>Password Must Be Minimum of 6 Characters!</center></h5></div>";
    }
    else if(mysqli_num_rows($result_match) == 0)
    {
      $sql = "UPDATE registration SET password = '$password' WHERE email = '$session_email'";
      if(mysqli_query($connection, $sql))
      {
        date_default_timezone_set("Asia/Kolkata");
        $t = date("jS  F Y h:i A");

        $to = $session_email;
        $subject = 'Mycloud Password Update.';
        $message = $fetched_result['name'].' you updated your password of Mycloud at '.$t.'. And your new password is:- '.$password;
        $headers = 'From: ritabratagoswami95@gmail.com';
        mail($to, $subject, $message, $headers);

        echo "<div style = 'background-color: #00cca3; padding: 7px;'><h5><center style = 'color: #000000;'>Success!</center></h5></div>";
        echo '<meta http-equiv="refresh" content="3; url=http://localhost/Ritabrata/mycloud.html">';
      }
    }
    else
    {
       echo "<div style = 'background-color: #ff1a1a; padding: 7px;'><h5><center style = 'color: #ffffff;'>ERROR! The same password already exist. Please try another one.</center></h5></div>";
    }
  }
    mysqli_close($connection);
?>
<html>
<head>
<meta charset = "UTF-8"/>
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel = "icon" href = "iconStorage/logo_f.jpg">
<title>MyCloud</title>
<style type = "text/css">
#block {
width: 350px;
height: 250px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
box-shadow: 0px 5px 8px #777777;
border-radius: 5px;
background: #f1f1f1;
}
#inside-box {padding: 10px;}
input[type = text] {
padding: 5px;
width: 100%;
margin-top: 10px;
border-style: inset;
}
input[type = submit]{
margin-left: 12%;
margin-top: 10%;
padding: 5px;
background: #4d79ff;
color: #ffffff;
cursor: pointer;
}
#back-btn {
background: #4d79ff;
color: #ffffff;
padding: 5px;
}
.box-css {
display: none; 
position: absolute; 
z-index: 1; 
padding-top: 20px; 
left: 0;
top: 0;
width: 100%;
height: 100%; 
background-color: rgba(0,0,0,0.4); 
}
#pop-up-two {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
.success-box-css {
display: none;
position: absolute; 
z-index: 1; 
padding-top: 30px; 
left: 0;
top: 0;
width: 100%;
height: 100%; 
background-color: rgba(0,0,0,0.4);
}
#pop-up-success {
margin: auto;
width: 90%;
background: #33ffcc;
color: #000000;
padding: 10px;
}
.close {
float: right; 
cursor: pointer; 
font-weight: bold; 
font-size: 20px;
}
#copyright {
font-size: 10px; 
margin-top: 750px;
text-align: center;
}
</style> 
</head>
<body>

<div id = "block">
    <h3 style = "text-align: center; margin-bottom: 30px;">Change Password</h3>   
       <form method = "POST" action = "password_edit.php">
        <div id = "inside-box">
          Enter your new password:
          <input id = "pass-id" type = "text" name = "password-name" placeholder = "Enter Password"/>
          <input id = "btn" type = "submit" name = "submit" value = "Save Password"/>
          <button id = 'back-btn'><a href = 'http://localhost/Ritabrata/mycloud.html' style = "text-decoration: none;">Back to Login</a></button>
        </div>
       </form>
    </div>

    <div id = "pop-up-box-two" class = "box-css">
      <div id = "pop-up-two">
      <span class = "close" onclick = "closeOne()">&times;</span>
        <div>Please provide new password!</div>
      </div>
    </div>

    <!-- <div class = "success-box-css" id = "event-tag">
      <div id = "pop-up-success">
      <span class = "close" onclick = "closeSuccess()">&times;</span>
        <div id = "output"></div>
      </div>
    </div> -->

    <p id = "copyright">&copy: <span id = "demo"></span> MyCloud. Developed By Ritabrata Goswami.</p>

    <script>
      var forward = document.getElementById("btn"); 
      forward.addEventListener("click", forwardFunc);

      function forwardFunc()
      {
        let pass_value = document.getElementById("enter-otp").value;
        if(pass_value == '')
        {
          document.getElementById('pop-up-box-two').style.display = 'block';
        }
      }

      function closeOne() {document.getElementById('pop-up-box-two').style.display = 'none';}
      var closeSuccess = () => {
          document.getElementById('event-tag').style.display = 'none';  
      }

      let boxTwo = document.getElementById("pop-up-box-two");
      let successBox = document.getElementById('event-tag');
      window.onclick = (event) => {
      if(event.target == boxTwo)
      {
        document.getElementById('pop-up-box-two').style.display = 'none';
      }
      else if(event.target == successBox)
      {
        document.getElementById('event-tag').style.display = 'none'; 
      }
    }
    </script>
    <script>
      var d = new Date(); 
      document.getElementById("demo").innerHTML = d.getFullYear();
    </script>

</body>
</html>

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
?>