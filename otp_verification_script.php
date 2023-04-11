<?php
//error_reporting(0);
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
if(isset($_SESSION['email']))
{
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
height: 280px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
box-shadow: 0px 5px 8px #777777;
border-radius: 5px;
background: #f1f1f1;
}
#inside-box {
padding: 10px; 
margin-top: 20px;
}
#session-timer {
text-align: center;    
}
input[type = text] {
padding: 5px;
width: 100%;
margin-top: 10px;
border-style: inset;
}
input[type = submit]{
margin-left: 40%;
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
<body onload = "stopWatch()">
        <?php echo $_SESSION['email'];?>
    <div id = "block">
    <h3 style = "text-align: center; margin-bottom: 30px;">Verify OTP</h3>   
       <!-- <form method = "POST" action = "password_recover.php"> -->
        <p style = "text-align: center; color: #ff0000;">Session will out in 1 minute: <span id = 'session-timer'></span></p>
        <div id = "inside-box">
          Enter your OTP(One Time Password):
          <input id = "get-session-id" type = "text" name = "session-id" value = "<?=$_SESSION['email']?>" style = "display: none;"/>
          <input id = "get-time-id" type = "text" name = "time-id" value = "<?=$_SESSION['time']?>" style = "display: none;"/>
          <input id = "enter-otp" type = "text" name = "name" placeholder = "Enter otp"/>
          <input id = "btn" type = "submit" name = "submit" value = "Verify"/>
        </div>
       <!-- </form> -->
    </div>

    <div id = "pop-up-box-two" class = "box-css">
      <div id = "pop-up-two">
      <span class = "close" onclick = "closeOne()">&times;</span>
        <div>Please provide OTP!</div>
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
        let otp_field = document.getElementById("enter-otp").value;
        let session_email = document.getElementById("get-session-id").value;
        let session_time = document.getElementById("get-time-id").value;

        if(otp_field == '')
        {
          document.getElementById('pop-up-box-two').style.display = 'block';
        }
        else
        {
          // location.replace("verify_otp.php");
          
          let formData = new FormData();
          formData.append("otp_val", otp_field);
          formData.append("email_val", session_email);
          formData.append("time_val", session_time);

          var http = new XMLHttpRequest();
          http.onreadystatechange = function() 
          {
           if(http.status == 200)
           {
             document.getElementById("output").innerHTML = this.responseText;
             document.getElementById("event-tag").style.display = 'block';
           }
          };
          http.open("POST", "verify_otp.php");
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
            document.getElementById("session-timer").innerHTML = minute + ":" + second;
          } 
        }

        setTimeout(moveForward, 95000);
        function moveForward() {location.replace("signout.php");}

        // function reloadSession()
        // {
        //   location.replace("signout.php");
        // }
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

if(session_destroy())
{
  header("Location: http://localhost/Ritabrata/mycloud.html");
  exit();
}
?>