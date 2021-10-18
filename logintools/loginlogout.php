<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL){ 
    header("Location: ../index.php");
  }else {
    session_destroy();
    header("Location: ../index.php");
  }
?>

