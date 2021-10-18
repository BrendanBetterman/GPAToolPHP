<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL){ 
    header("Location: ../index.html");
  }else{
 
?>
<?php
/*
+--------------+------------+------+-----+---------+-------+
| Field        | Type       | Null | Key | Default | Extra |
+--------------+------------+------+-----+---------+-------+
| user_id      | varchar(8) | YES  |     | NULL    |       |
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
$course_id =  $_REQUEST['course_id'];
$course_value = mysqli_real_escape_string($link, $_REQUEST['course_value']);
$course_grade = mysqli_real_escape_string($link, $_REQUEST['course_grade']);

//$course_major = mysqli_real_escape_string($link, $_REQUEST['course_major']);
if (isset($_REQUEST['course_major'])) {
    $course_major = "1";
}else{
	$course_major = "0";
}


$sql = "INSERT INTO coursebase (id,course_id,course_value,course_grade,user_session,major) 
VALUES ($userID,$course_id,$course_value,$course_grade,$session,$course_major)";
if(mysqli_query($link, $sql)){
	echo "Grades added successfully.";
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