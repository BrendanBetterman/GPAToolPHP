<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL){ 
    header("Location: ../index.html");
  }else {
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

  function create_user($database,$username,$password){
    $query = "INSERT INTO userbase (user,pass,sesone,sestwo,sesthree) 
    VALUES ($username,$password,'1','2','3')";
    $result = send_sql($query, $link, $database);
    
  }
  //Delete Query DELETE FROM userbase WHERE user = "$_POST['username']";
?>
      
<?php
  
  $password = $_POST['password'];
  //$password = password_hash($password,PASSWORD_DEFAULT);
  print "Opening the connection to the database server<br>";
  $link = connect();
  $database = $mySQL_User;//"oh5473ay";
  $id=$_SESSION['Account'];
  $query = "SELECT pass, id FROM userbase WHERE id = '$id'";
    $result = send_sql($query, $link, $database);
    $pass = mysqli_fetch_row($result);
    if ($pass[0] == $_POST['password']){
      $query = "DELETE FROM userbase WHERE id = '$id'";
      $result = send_sql($query, $link, $database);
      $query = "DELETE FROM coursebase WHERE id = '$id'";
      $result = send_sql($query, $link, $database);
      //session_destroy();
    }else{
      echo "Incorrect login<br>";
    }
    

  
  print "Closing the connection<br>";
  mysqli_close( $link );
  session_destroy();



  }?>
</body>
</html>
