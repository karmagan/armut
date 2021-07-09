<?php
include('connect.php');

$subject = $_POST['subject'];
$year = $_POST['year'];
$class = $_POST['class'];


echo $subno;

$sql = "insert into Subjects (Teacher, SubjectName, SubClass, Year) values ('$teacher','$subject','$class', '$year' )";
$result = mysql_query($sql);



echo "<h2>subject registered Successfully<br><a href='entersubteacher.php'>Go back to subject registration</a><br><a href='entersubstu.php'>Go to student registration</a></h2>";


?>
<br /><button onclick="opener.show('subteacherEnter.php','mainBody');self.close()">Go
	Back</button>