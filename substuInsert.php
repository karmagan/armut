<?php
include('connect.php');

$stuno = $_POST['stuno'];
$subno = $_POST['subject'];

echo $subno;
for ($i = 0; $i < count($stuno); $i++) {
	$sql = "insert into SubStu (Student, Subject) values ('$stuno[$i]','$subno' )";
	$result = mysql_query($sql);
	echo $stuno[$i];
}


echo "<h2><br>Students registered Successfully<br></h2>";

?>

<br /><button onclick="opener.show('subteacherEnter','mainBody');self.close()">Go Back</button>