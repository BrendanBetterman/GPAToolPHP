
<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL){ 
    header("Location: index.php");
  }else {
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href = "../login_screen_final_project_style_sheet.css">
<head><title>PasswordChange</title></head>
<body style="background-color:lightblue; font-size:110%">

<?php
  $mySQL_Host="localhost";
  $mySQL_User="oh5473ay";
  $mySQL_Pass="mooseWagon";
 
 

  function connect(){
    global $mySQL_Host, $mySQL_User,$mySQL_Pass;

    if ( ! $linkid = mysqli_connect("$mySQL_Host",
                                   "$mySQL_User","$mySQL_Pass")){
      echo "Impossible to connect to ", $mySQL_Host, "<br />";
      exit;
    }
    return $linkid;
  }

  function send_sql( $sql, $link, $db ) {
    if ( ! ($succ = mysqli_select_db($link, $db))) {
      echo mysqli_error($link);
      exit;
    }
    if ( ! ($res = mysqli_query ( $link, $sql))) {
      echo  mysqli_error($link);
      exit;
    }
    return $res;
  }
?>
      
<?php

  $password = $_POST['password'];
 // $password = password_hash($password,PASSWORD_DEFAULT);
  $newPass = $_POST['new_password'];
  //$newPass = password_hash($newPass,PASSWORD_DEFAULT);
  $link = connect();
  $database = $mySQL_User;//"oh5473ay";
  $id = $_SESSION['Account'];
  $query = "SELECT pass FROM userbase WHERE id = '$id'";//recieve password from username
    $result = send_sql($query, $link, $database);//post sql
    $pass = mysqli_fetch_row($result);//fetchs row
    echo '<div class="container">';
      echo '<div id="div_login">';
     
    if ($pass[0] == $password){//checks pass received to password saved
      echo "<h1>Password Has Been Changed</h1>";
      $query = "UPDATE userbase SET pass = '$newPass' WHERE id = '$id'";//recieve password from username
      $result = send_sql($query, $link, $database);//post sql
    }else{
      echo "<h1>Password could not Be Changed</h1>";
    }
   
    ?>
    <form action="../homepage.php" method="POST">
        <input type=submit value="User Settings">
    </form>
    <br>
    <form action="../gpatool.php" method="POST">
        <input type=submit value="Gpatool">
    </form>
    <br>
    <form action="loginlogout.php" method="POST">
        <input type=submit value="LogOut">
    </form>
    </div></div>
  <?php
 
  mysqli_close( $link );




?>
</body>
</html>
<?php } ?>