<?php
include('connect.php');

$mark = $_POST['mark'];
$assessmentno = $_POST['assessmentno'];
$stuno = $_POST['stuno'];

$i = 0;


echo count($mark);
echo count($stuno);

foreach ($stuno as $stu) {


	$sql2 = "select * from AssessmentMarks where Student='$stu' and Assessment='$assessmentno'";
	$result2 = mysql_query($sql2);
	if (mysql_num_rows($result2) == 0) {
		$sql = "insert into AssessmentMarks (Student, Assessment, Mark) values ('$stu', '$assessmentno' , '$mark[$i]' )";
		$result = mysql_query($sql);
		$i++;
	} else {
		$sql = "UPDATE AssessmentMarks SET Mark='$mark[$i]' where Student='$stu' AND Assessment= '$assessmentno' ";
		$result = mysql_query($sql);
		$i++;
	}
}

echo "<h2>Marks edited Successfully<br></h2>";


?>
<br /><button onclick="opener.show('assessmentList','mainBody');self.close()">Go Back</button>