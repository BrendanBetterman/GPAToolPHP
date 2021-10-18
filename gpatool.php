<?php
  session_start();
  if ((! isset($_SESSION['Account'])) || $_SESSION == NULL || $_SESSION['Account'] == "incorrect"){ 
    header("Location: index.php");
  }else {
	  
?>
<?php
/*
 * grades_chris_import_mySQL.php
 * 
 * Copyright 2021 Chris <Chris@DESKTOP-2EU25IO>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>GPA Tool</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.37.1" />
	<link rel="stylesheet" href = "login_screen_final_project_style_sheet.css">
</head>

<body>

	<div id="div_login">
	<form action="logintools/loginlogout.php" method="POST">
        <input type=submit value="LogOut">
    </form>
	<br>
	<form action="homepage.php" method="POST">
        <input type=submit value="User Settings">
    </form>
	<form action="gpatools/insert.php" method="post">
	<p>
		<label for "courseID">Course ID:</label>
		<input type="text" name="course_id" id="courseID">
	</p>
		
	<p>
		<label for "courseValue">Course Value:</label>
		<input type="text" name="course_value" id="courseValue">
	</p>
	<p>
		<label for "courseGrade">Course Grade:</label>
		<input type="text" name="course_grade" id="courseGrade">
	</p>
	<p>
		<label for "course_major">Is this a class in your major? Check for yes, leave blank for no.</label>
		<input type = "checkbox" name="course_major" value="1">
	</p>
	<input type="submit" value="ADD">
	</form>
	</div>
	<div id="div_logi">
	<table>
	<tr>
	<th>Course ID:</th>
	<th>Course Weight:</th>
	<th>Course Grade:</th>
	<th>Course Major:</th>
	</tr>
	<?php
	$mySQL_Host="localhost";
	$mySQL_User="oh5473ay";
	$mySQL_Pass="mooseWagon";
	$user_id = $_SESSION['Account'];
	$conn = mysqli_connect($mySQL_Host, $mySQL_User, $mySQL_Pass, $mySQL_User);
	if($conn-> connect_error){
		die("Your connection has failed:".$conn-> connect_error);
	}
	$sql = "SELECT id ,course_id,course_value,course_grade,user_session,major FROM coursebase WHERE id = '$user_id'  ";
	$result = $conn-> query($sql);
	$temp_gpa = 0;
	$temp_credits = 0;	
	$temp_major_gpa = 0;
	$temp_major_credits = 0;
	
	if ($result-> num_rows > 0){
		while($row = $result-> fetch_assoc()){
			if($row["major"]==1){
				$major = "yes";
			}else{$major ="no";}
			echo '<form action="gpatools/delete.php" method="POST">';
			echo "<tr><td>" . '<input type="text" name="course_id" value='.$row["course_id"].'><br/>' ."\n"
			. "</td><td>" . '<input type="text" value='.$row["course_value"].'><br/>' ."\n"
			. "</td><td>" . '<input type="text" value='.$row["course_grade"].'><br/>' ."\n"
			. "</td><td>" . '<input type="text" value='.$major.'><br/>' ."\n";
				?></td><td>
				
					<input type=submit value='x' course_id="<?php $row["course_id"]?>">
				</form>
				<?php
echo "</td></tr>";
			
			
			if ($row["major"]!=0){
				$temp_major_gpa += $row['course_grade']*$row['course_value'];
				$temp_major_credits +=$row['course_value'];
			}
			$temp_gpa += $row['course_grade']*$row['course_value'];
			$temp_credits +=$row['course_value'];
		}
		$final_gpa = round(($temp_gpa/$temp_credits),3);

		
		echo "</table>";
		echo "Cumalative GPA: " . $final_gpa ."<br>";
		if ($temp_major_credits >0){
			$final_major_gpa = round(($temp_major_gpa/$temp_major_credits),3);
			echo "Major GPA: " . $final_major_gpa;
		}else{
			echo "Major GPA: " . "No Grades yet";
		}
		$conn->close();
	}
	?>
	</div>
<p>
    <strong><u>How to use our GPA Tool:</u></strong>
</p>
<p>
    1. Login to the tool after clicking the href link on the login page to
    create a username and a password. The password and username may be anything
    you like, there is no requirements to either the username or password for
    creation.
</p>
<p>
    2. After the user inserts their credentials into the login page, you should
    be met with a tool that has a button assigned for the LogOut that will kill
    the session for that page, and three text boxes that are used for inputs.
    The text boxes will accept as follows:
</p>
<p>
    - <strong>Couse ID: </strong>will accept all numerical values and represent
    what the course number is.
</p>
<p>
    - <strong>Course Value:</strong> this will accept a numerical value of how
    many credits the course is worth.
</p>
<p>
    - <strong>Course Grade:</strong> this textbox will accept values between 0
    – 4, 0 being a F or a fail, 1 being a D, 2 being a C, 3 being a B, and 4
    being an A.
</p>
<p>
    3. The user may then press the add after deciding if the class is a part of
    their major or not and clicking the checkbox located below the initial
    three input/text boxes for reference, and after the user has pressed the
    add button the database will then update the information using an insert
    mysqli command and then a query will represent the data in a four column
    table/textbox representation to be presented on the PHP/HTML page.
</p>
<p>
    4. The user may add as many classes as they want, this is so they may
    simulate what their future GPA for both overall and major GPA’s will be,
    and if the user wishes to delete a class from the table, all they must do
    is press the DELETE button beside each row of the html/php table on the
    front end webpage... This will update the mySQL table on both the backend,
    and then submit a query to update the data represented in the HTML/PHP user
    on the front end for user visualization and confirmation.
</p>
<p>
    5. Once the user is done with the tool, they may press the LogOut button
    located at the top left of the page and after the button is pressed all
    session information will be destroyed and the user can go about their day.
    All information being destroyed in the session is for security purposes.
</p>

	
</body>
</html>
<?php
}?>
