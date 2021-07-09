<?php
include('connect.php');

$assno = $_POST['assessmentno'];

if (isset($_POST['deleteAssessments'])) {
	$sql12 = "delete from AssessmentMarks where Assessment='$assno'";
	$result = mysql_query($sql12);
}

$sqlcheck = "select * from AssessmentMarks where Assessment='$assno'";
$resultcheck = mysql_query($sqlcheck);
$nummarks = mysql_num_rows($resultcheck);
if ($nummarks != 0) {
	print "There are $nummarks student marks registered for this assessment. 
			Please confirm that you want to delete the student marks as 
			well.
			<form action='assessmentDelete.php'  method='post'><input type='submit' 
			name='deleteAssessments' 
			value='Delete student marks as well'><input type='hidden' 
			name='assessmentno' value='$assno'> 
			</form>";
} else {

	$sql = "delete from Assessments where AssessmentNo='$assno'";
	$result = mysql_query($sql);


	echo "<br>Assessment deleted Successfully<br>";
}
?>

<br /><button onclick="opener.show('assessmentCorrection.php','mainBody');self.close()">Go Back</button>