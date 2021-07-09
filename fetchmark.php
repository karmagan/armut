<?php
$stuno = $_POST['stuno'];
include('connect.php');

$sql = "select * from AssessmentMarks inner join Assessments on AssessmentMarks.Assessment=Assessments.AssessmentNo  inner join Subjects on Assessments.Subject=Subjects.SubjectNo inner join Staff on Subjects.Teacher=Staff.TeacherNo inner join LessonNames on Subjects.SubjectName=LessonNames.ID inner join AssessmentTypes on Assessments.AssessmentType=AssessmentTypes.AssessmentTypeNo WHERE Student = $stuno order by AssDate desc";
$sql1 = "select * from StudentInformation where ID=$stuno";
$sql2 = "select * from MeritDemerit inner join MeritReasons on MeritDemerit.Reason=MeritReasons.ReasonNo inner join Staff on Staff.TeacherNo=MeritDemerit.Teacher where Student=$stuno order by Date desc";
$sql3 = "select * from Marks where ID=$stuno";
$sql4 = "select * from AAbsent where ID=$stuno and Date > '2011-01-01'";

$result = mysql_query($sql);
$result1 = mysql_query($sql1);
$result2 = mysql_query($sql2);
$result3 = mysql_query($sql3);
$result4 = mysql_query($sql4);

$row1 = mysql_fetch_array($result1);
echo "<br>Results for " . $row1['FirstName'] . " " . $row1['LastName'];

echo '<br><fieldset><legend>Results per Assessment</legend><table style="border:\'1px transparent\';">';
echo '<tr><th>Subject</th><th>Assessment Type</th><th>Teacher Name</th><th>Year</th><th>Term</th><th>Out Of</th><th>Mark</th></tr>';
while ($row = mysql_fetch_array($result)) {

   printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row['Lesson'], $row['AssessmentType'], $row['Name'] . ' ' . $row['Surname'], $row['Year'], $row['AssTerm'], $row['OutOf'], $row['Mark']);
}
echo '</table></fieldset>';

echo '<br><fieldset><legend>Merit/Demerits</legend><table border="1">';
echo '<tr><th>Date</th><th>Teacher Name</th><th>Reason</th><th>Amount</th></tr>';
while ($row2 = mysql_fetch_array($result2)) {

   printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row2['Date'], $row2['Name'] . ' ' . $row2['Surname'], $row2['Reason'] . "/" . $row2['MeritExplanation'], $row2['Point']);
}
echo '</table></fieldset>';


echo '<br><fieldset><legend>Term Marks</legend><table border="1">';
echo '<tr><th>Subject</th><th>Year</th><th>First Term</th><th>Second Term</th><th>Third Term</th><th>Fourth Term</th></tr>';
while ($row3 = mysql_fetch_array($result3)) {
   echo '<tr>';
   printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>", $row3['Lesson'], $row3['Year'], $row3['FrsTrm'], $row3['ScndTrm'], $row3['ThrdTrm'], $row3['FrthTrm']);
   echo '</tr>';
}
echo '</table></fieldset>';

//Absenteism

echo '<br><fieldset><legend>Absenteism</legend><table BORDER=1 >';
echo '<tr><th>Date</th><th>Explanation</th></tr>';
$absentcount = 0;
while ($row4 = mysql_fetch_array($result4)) {

   printf("<tr><td>%s</td><td>%s</td></tr>", $row4['Date'], $row4['Explanation']);
   $absentcount++;
}

printf('</table><strong><div style="text-align: right">Total Absenteism: %s</div></strong></fieldset>', $absentcount);

?>

<html>

<head>
   <link rel="stylesheet" type="text/css" href="style1.css" />
</head>

</html>