<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8"/>
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0"/>
<meta name = "description" content = "Storing personal information"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel = "icon" href = "iconStorage/logo_f.jpg">
<title>MyCloud</title>
<style type = "text/css">
body {font-family: arial;}
#block {
width: 380px;
height: 610px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
box-shadow: 0px 5px 8px #777777;
border-radius: 5px;
}
#inside-box {padding: 10px;}
input[type = text] {
padding: 7px;
width: 100%;
margin-top: 10px;
border-radius: 30px;
}
input[type = email] {
padding: 7px;
width: 100%;
margin-top: 10px;
border-radius: 30px;
}
input[type = password] {
padding: 7px;
width: 100%;
margin-top: 10px;
border-radius: 30px;
}
input[type = file] {
margin-left: 60px;
margin-top: 20px;
}
input[type = submit]{
margin-left: 40%;
margin-top: 20%;
border-radius: 30px;
padding: 10px;
background: #4d79ff;
color: #ffffff;
cursor: pointer;
}
#pass-show{
font-size: 13px; 
cursor: pointer;
}
#copyright {
font-size: 10px; 
margin-top: 705px;
text-align: center;
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
.close {
float: right; 
cursor: pointer; 
font-weight: bold; 
font-size: 20px;
}
.close:hover {
color: #000000;
}
#pop-up-one {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
#pop-up-two {
margin: auto;
width: 90%;
background: #ff0000;
color: #ffffff;
padding: 5px;
}
#pop-up-success {
margin: auto;
width: 90%;
background: #33ffcc;
color: #000000;
padding: 10px;
}
#image_show {
border-radius: 50%;
border: 1px solid #f1f1f1;
background: #e6e6e6;
margin-left: 40%;
height: 70px;
width: 70px;
}
#res {display: none;}
@media only screen and (max-width: 325px){
 #res {
 display: block;
 text-align: center;
 background: #1f1f1f;
 color: #ff0000;
 }
 #block {display: none;}
 #adjustment {display: none;}
}
#adjustment-btn{
position: fixed;
left: 80%;
top: 0;
margin-bottom: 35px;
}
</style>
</head>
<body>

<div id = "res">Sorry, This device is not suitable! Please use a device with higher pixel such as desktop or laptop or similar kind of devices.</div>

<?php
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

 $sql_two = "SELECT color FROM background_color WHERE id = (SELECT MAX(id) FROM background_color)";
 $result_two = mysqli_query($connect, $sql_two);
 $fetch_result = mysqli_fetch_assoc($result_two);
 $exploded_checked = explode(",", $fetch_result["color"]);
?>

<div id = "block-container">
  <style>
    body {background:  <?php if (in_array("two", $exploded_checked)){echo "#1f1f1f";} else if(in_array("four", $exploded_checked)){echo "white";}?>;}
    h3 {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #res {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #block {background: <?php if (in_array("two", $exploded_checked)){echo "#1f1f1f";} else if(in_array("four", $exploded_checked)){echo "white";}?>;}
    #pass-show {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #photo {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #copyright {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
    #demo {color: <?php if (in_array("two", $exploded_checked)){echo "white";} else if(in_array("four", $exploded_checked)){echo "black";}?>;}
  </style>
</div> <!---block-container--->

<select id = "adjustment" onchange = "setBackgroundColor()">
     <option>-Set Background Color-</option>
     <option value = "one,two" <?= (in_array('two', $exploded_checked)) ? "selected" : ""?>>Black background</option>
     <option value = "three,four" <?= (in_array('four', $exploded_checked)) ? "selected" : ""?>>White background</option>
</select>

<div id = "block">
            
  <h3 style = "text-align: center;">Registration Form</h3>
  <div id = "inside-box">
    <img id = "image_show"/>
    <p style = "color: #ff0000; font-size: 12px; text-align: center; font-family: arial;">Image must be jpg or png format!</p>
    <input id = "user-name" type = "text" name = "enter_name" placeholder = "Enter your full name"/>
    <input id = "user-email" type = "email" name = "enter_email" placeholder = "Enter your email"/>
    <p style = "color: red; font-size: 12px; text-align: center;">Password must be minimum of 6 characters.</p>
    <input id = "user-pass" type = "password" name = "enter_pass" placeholder = "Enter your password"/>
    <p id = "pass-show" onclick = "showPassword()">Click to see password</p>
    <input type = "file" onchange = "load_img(event)" id = "photo"/>    
    <input type = "submit" name = "submit" value = "submit" onclick = "return validation()"/>
    <div style = "margin-top: 20px;">
      <a href = "#" id = "link-one" style = "font-size: 12px;"></a>
    </div>
    <div style = "margin-top: 25px;">
      <a href = "#" id = "link-two"></a>
    </div>
  </div>
    
</div> <!---block--->

<div class = "success-box-css" id = "event-tag">
  <div id = "pop-up-success">
  <span class = "close" onclick = "closeSuccess()">&times;</span>
    <div id = "output"></div>
  </div>
</div>

<div id = "pop-up-box-one" class = "box-css">
  <div id = "pop-up-one">
  <span class = "close" onclick = "closeBoxOne()">&times;</span>
    <div>Please provide all the necessary fields!</div>
  </div>
</div>

<div id = "pop-up-box-two" class = "box-css">
  <div id = "pop-up-two">
  <span class = "close" onclick = "closeBoxTwo()">&times;</span>
    <div>Please provide Proper Email!</div>
  </div>
</div>

<p id = "copyright">&copy: <span id = "demo"></span> MyCloud. Developed By Ritabrata Goswami.</p>

<script>
var showPassword = () => {
 if(document.getElementById("user-pass").type == "password")
 {
   document.getElementById("user-pass").type = "text";
   document.getElementById("pass-show").innerHTML = "Hide Password";
 }
 else
 {
   document.getElementById("user-pass").type = "password";
   document.getElementById("pass-show").innerHTML = "Click to see password";
 }
}

//Form validation started
 function validation()
{
 let name = document.getElementById("user-name").value;
 let password = document.getElementById("user-pass").value;
 let email = document.getElementById("user-email").value;
 let photo = document.getElementById("photo").value;
 let uploadedFile = document.getElementById("photo").files[0];
 
 let atTheRate = email.indexOf("@");
 let dotPosition = email.lastIndexOf(".");
 if(name == "" || password == "" || email == "" || photo == "")
 {
   document.getElementById("pop-up-box-one").style.display = "block";
   return false;
 }
 else if(atTheRate < 1 || dotPosition < 6)
 {
   document.getElementById("pop-up-box-two").style.display = "block";
   return false;
 }
 else if(name != "" && password != "" && email != "" && photo != "")
 {

    let formData = new FormData(); 
    //let uploadedFile = document.getElementById("photo").files[0];
    // let nameVal = document.getElementById("user-name").value; 
    // let passwordVal = document.getElementById("user-pass").value;
    // let emailVal = document.getElementById("user-email").value; 

    formData.append("yourFile", uploadedFile);
    formData.append("yourName", name);
    formData.append("yourPassword", password);
    formData.append("yourEmail", email);

    const httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function()
   {
     if(httpRequest.status == 200)
     {
       document.getElementById("output").innerHTML = this.responseText;
       document.getElementById('event-tag').style.display = 'block';
     }
   };
    httpRequest.open("POST", "reg_save.php");
    httpRequest.send(formData);
    // fetch('reg_save.php', {method: "POST", body: formData});
    
    // document.getElementById("output").style.display = 'block';
    // alert('Your credential details inserted successfully!');

   setTimeout(moveForward, 10000);
   function moveForward() {location.replace("http://localhost/Ritabrata/mycloud.html");}
 }
}

let image = document.getElementById("photo");
image.setAttribute("accept", "image/jpeg, image/png");

var closeSuccess = () => {
document.getElementById('event-tag').style.display = 'none';  
}
var closeBoxOne = () => {
document.getElementById('pop-up-box-one').style.display = 'none';
}
var closeBoxTwo = () => {
document.getElementById('pop-up-box-two').style.display = 'none';
}

let container = document.getElementById("container");
let boxOne = document.getElementById("pop-up-box-one");
let boxTwo = document.getElementById("pop-up-box-two");
let successBox = document.getElementById('event-tag');

window.onclick = (event) => {
 if(event.target == container || event.target == boxOne)
 {
   document.getElementById("pop-up-box-one").style.display = "none";
 }
 else if(event.target == container || event.target == boxTwo)
 {
   document.getElementById("pop-up-box-two").style.display = "none";
 }
 else if(event.target == container || event.target == successBox)
 {
   document.getElementById('event-tag').style.display = 'none'; 
 }
}
</script>
<script>
 function load_img(event) 
 {
  document.getElementById('image_show').src = URL.createObjectURL(event.target.files[0]);
 }
</script>
<script>
 var d = new Date(); 
 document.getElementById("demo").innerHTML = d.getFullYear();
</script>
<script>
var setBackgroundColor = () => {
   let adjust = document.getElementById("adjustment").value;
   
   var http = new XMLHttpRequest();
   http.onreadystatechange = function()
   {
     if(http.status == 200)
     {
       document.getElementById("block-container").innerHTML = this.responseText;
     }
   };
   http.open("POST", "background-color.php", true);
   http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   http.send("adjustment= " + adjust); 
}
</script>

</body>
</html>

