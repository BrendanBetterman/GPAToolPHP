<?php
  session_start();
  if (( isset($_SESSION['Account'])) && $_SESSION != NULL && $_SESSION['Account'] != "incorrect"){ 
    header("Location: gpatool.php");
  }else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Splash Screen / Login Screen For CW and BB Final Project</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.37.1" />
	<link rel="stylesheet" href = "login_screen_final_project_style_sheet.css">
</head>

<body>
	<div class="container">
    <form method="post" action="logintools/loginverify.php">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="username" name="username" placeholder="Username" />
            </div>
            <div>
                <input type="password" class="textbox" id="password" name="password" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
            <?php
                if($_SESSION != NULL && $_SESSION['Account']=="incorrect"){
                    echo "Either password or username are incorrect<br>";
                    $_SESSION['Account']=NULL;
                }else{}
            ?>
            <a href="register.html">Don't have an account,Register</a>
        </div>
    </form>
</div>
</body>

</html>
<?php
}?>