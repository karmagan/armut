<?php
include('connect.php');
$assNo = $_POST['assessmentno'];

echo "<br> Assessment Number: " . $assNo;

$sql1 = "SELECT Subject FROM Assessments WHERE AssessmentNo = '$assNo' ";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_array($result1);

$subNo = $row1[0];


$sql2 = "SELECT *  FROM `AssessmentMarks` where Assessment=$assNo ";

$result2 = mysql_query($sql2);
while ($row2 = mysql_fetch_array($result2)) {

	$mark2[$row2['Student']] = $row2['Mark'];
}



$sql = "SELECT *  FROM StudentInformation INNER JOIN SubStu ON StudentInformation.ID = SubStu.Student WHERE SubStu.Subject = '$subNo' order by `LastName`";

$result = mysql_query($sql);
if (mysql_num_rows($result) == 0) {

	echo '<h1><br>No students registered!!<br>Please register students first.</h1>';
} else {

	echo '<form name=f1 action="editmarks.php" method="post">';
	echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';
	echo '<tr><th>No</th><th>Name</th><th>Surname</th><th>Class</th><th>Mark</th></tr>';

	while ($row = mysql_fetch_array($result)) {

		printf("<tr><td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> ", $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);
		echo '<input type="hidden" name=stuno[] value="' . $row['ID'] . '" />';

		echo '<td><input type="text" name="mark[]" size=5 value="' . $mark2[$row['ID']] . '" /></td></tr>';
	}


	echo '</table>';
	echo '<input type="hidden" name="assessmentno" value="' . $assNo . '" />';
	echo '<input type="submit" value="Submit Marks" />';


	echo '</form>';
}
