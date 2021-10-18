<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL){ 
    header("Location: ../index.html");
  }else {
	 
?>
<?php
/*
+--------------+------------+------+-----+---------+-------+
| Field        | Type       | Null | Key | Default | Extra |
+--------------+------------+------+-----+---------+-------+
| user_id      | int        | YES  |     | NULL    |       |
| course_id    | int        | YES  |     | NULL    |       |
| course_value | int        | YES  |     | NULL    |       |
| course_grade | int        | YES  |     | NULL    |       |
| user_session | varchar(8) | YES  |     | NULL    |       |
+--------------+------------+------+-----+---------+-------+
*/
$mySQL_Host="localhost";
$mySQL_User="oh5473ay";
$mySQL_Pass="mooseWagon";
$link = mysqli_connect($mySQL_Host, $mySQL_User, $mySQL_Pass, $mySQL_User);

if($link == false){
	die("ERROR: Your connection was lost. " . mysql_connect_error());
}
$userID = $_SESSION['Account'];
$session = "1";
$course_id = $_POST['course_id'];
$course_value = mysqli_real_escape_string($link, $_REQUEST['course_value']);
$course_grade = mysqli_real_escape_string($link, $_REQUEST['course_grade']);

//$sql = "INSERT INTO grades_chris(course_id, course_value, course_grade)
// VALUES ('$course_id', '$course_value', '$course_grade')";
$sql = "DELETE FROM coursebase WHERE course_id = '$course_id' AND id = '$userID' ";
if(mysqli_query($link, $sql)){
	echo "Courses were removed successfully.";
} else{
	echo "ERROR: Something went wrong... grades were not added, could not execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
header("Location: ../gpatool.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.37.1" />
</head>

<body>
	
</body>

</html>
<?php
}?>