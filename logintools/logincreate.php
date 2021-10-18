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
  function safeEncrypt(string $message, string $key): string
  {
    $cipher = $message;
      return $cipher;
  }
  function create_user($database,$username,$password){
    $query = "INSERT INTO userbase (user,pass,sesone,sestwo,sesthree) 
    VALUES ($username,$password,'1','2','3')";
    $result = send_sql($query, $link, $database);
    
  }
  //Delete Query DELETE FROM userbase WHERE user = "$_POST['username']";
?>
      
<?php
  $username = $_POST['username'];
  $str_password = $_POST['password'];
  //$str_password = password_hash($str_password,PASSWORD_DEFAULT);
 

  print "Opening the connection to the database server<br>";
  $link = connect();
  $database = $mySQL_User;//"oh5473ay";
  

  $query = "SELECT user FROM userbase WHERE user = '$username'";
  $result = send_sql($query, $link, $database);
  $isUser = mysqli_fetch_row($result);
  if ($isUser[0] == NULL){//check to see if username is taken
    $query = "INSERT INTO userbase (user,pass,sesone,sestwo,sesthree) 
    VALUES ('$username','$str_password','1','2','3')";
    $result = send_sql($query, $link, $database);//sets user name
    echo "<br>Account Has Been created<br>";
  }else{
    echo "<br>UserName taken<br>";
  }

  $query = "SELECT id FROM userbase WHERE user = '$username'";
    $result = send_sql($query, $link, $database);//post sql
    $user = mysqli_fetch_row($result);//fetchs row
  
  print "Closing the connection<br>";
  mysqli_close( $link );


  header("Location: ../");


?>
</body>
</html>
