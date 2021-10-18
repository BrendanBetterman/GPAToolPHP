<?php
  session_start();
 

?>

<!DOCTYPE html>
<html lang="en">

<head><title>MySQL Query in PHP</title></head>
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
  
  $username = $_POST['username'];
  $str_password = $_POST['password'];
  //$str_password = password_hash($str_password,PASSWORD_DEFAULT);


  $logState = false;
  print "Opening the connection to the database server<br>";
  $link = connect();
  $database = $mySQL_User;//"oh5473ay";
  
  $query = "SELECT pass FROM userbase WHERE user = '$username'";//recieve password from username
    $result = send_sql($query, $link, $database);//post sql
    $pass = mysqli_fetch_row($result);//fetchs row
    if ($pass[0] == $str_password){//checks pass received to password saved
      $logState =true;
    }
    $query = "SELECT id FROM userbase WHERE user = '$username'";
    $result = send_sql($query, $link, $database);//post sql
    $user = mysqli_fetch_row($result);//fetchs row
  
  print "Closing the connection<br>";
  mysqli_close( $link );
  if ($logState == true){
    $_SESSION['Account'] = $user[0];
    
  }else{
    $_SESSION['Account'] = "incorrect";
  }
  echo $_SESSION['Account'];

  header("Location: ../gpatool.php");
 

?>
</body>
</html>
