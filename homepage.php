<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL){ 
    header("Location: index.php");
  }else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Account Settings</title>
<link rel="stylesheet" href = "login_screen_final_project_style_sheet.css">
<style>
#clear  {
    padding: 7px;
    width: 100px;
    background-color: lightcoral;
    border: 0px;
    color: white;
}
  </style>
</head>

 <body>
    <div id="button">
    <form action="login_tools/loginlogout.php" method="POST" >
        <input type=submit value="LogOut" >
    </form>
    <form action="gpatool.php" method="POST" >
        <input type=submit value="GPA Tool" id="button">
    </form>
</div>
    <div class="container">
    <div id="div_login">
<h1>Delete Account</h1>
<form action="logintools/logindelete.php" method="POST">
       <p>Password <br>
        <input type="password" size=50 name="password">
      </p>
<p>
 <input type=submit value="submit">
<input id="clear" type=reset value="clear">
</p>
 </form>
 </div>
 </div>
 <hr>
 <div class="container">
 <div id="div_login">
<h1>Change password</h1>
<form action="logintools/loginchange.php" method="POST">
       <p>
        Old Password <br>
         <input type="password" size=50 name="password">
        </p>
        <p>New Password <br>
             <input type="password" size=50 name="new_password">
            </p>
<p>
 <input type=submit value="submit">
<input id="clear" type=reset value="clear">
</p>
 </form>
 </div></div>
</body>
</html>
<?php

  }?>