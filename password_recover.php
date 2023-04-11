<?php
session_start();
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
<!DOCTYPE html>
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
margin-left: 36%;
margin-top: 10%;
padding: 5px;
background: #4d79ff;
color: #ffffff;
cursor: pointer;
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
    <h3 style = "text-align: center; margin-bottom: 30px;">Recover Password</h3>   
       <!-- <form method = "POST" action = "password_recover.php"> -->
        <div id = "inside-box">
          Enter your registered email:
          <input id = "email-id" type = "text" name = "name" placeholder = "Enter Email"/>
          <input id = "btn" type = "submit" name = "submit" value = "Send OTP"/>
        </div>
       <!-- </form> -->
    </div>

    <div id = "pop-up-box-two" class = "box-css">
      <div id = "pop-up-two">
      <span class = "close" onclick = "closeOne()">&times;</span>
        <div>Please provide Proper Email!</div>
      </div>
    </div>
             
    <div class = "success-box-css" id = "event-tag">
      <div id = "pop-up-success">
      <span class = "close" onclick = "closeSuccess()">&times;</span>
        <div id = "output"></div>
      </div>
    </div>

    <p id = "copyright">&copy: <span id = "demo"></span> MyCloud. Developed By Ritabrata Goswami.</p>

    <script>
        var forward = document.getElementById("btn"); 
        forward.addEventListener("click", forwardFunc);

      function forwardFunc() 
      {
        let emailId = document.getElementById("email-id").value;
        let atTheRate = emailId.indexOf("@");
        let dotPosition = emailId.lastIndexOf(".");
        if(emailId == '' || atTheRate < 1 || dotPosition < 6)
        {
          document.getElementById('pop-up-box-two').style.display = 'block';
        }
        else if(emailId != '')
        {
          // location.replace("verify_otp.php");

          let formData = new FormData();
          formData.append("yourEmail", emailId);

          var http = new XMLHttpRequest();
          http.onreadystatechange = function()
          {
           if(http.status == 200)
           {
             document.getElementById("output").innerHTML = this.responseText;
             document.getElementById('event-tag').style.display = 'block';
           }
          };
          http.open("POST", "gen_otp.php");
          // http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          http.send(formData); 
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