<?php
include('connect.php');



$sql1 = "SELECT *  FROM Assessments INNER JOIN Subjects ON Assessments.Subject=Subjects.SubjectNo INNER JOIN AssessmentTypes  ON 
Assessments.AssessmentType=AssessmentTypes.AssessmentTypeNo INNER JOIN LessonNames ON LessonNames.ID=Subjects.SubjectName where Subjects.Teacher='$teacher' 
order by Assessments.AssDate desc";

$result = mysql_query($sql1);
echo '<fieldset><legend>Registered Assessments</legend>The following assessments are registered:<br>To <em>delete</em> the assessment click the button. You can only delete an assessment if no marks entered yet.';


if (mysql_num_rows($result) == 0) {
  echo '<h1>No Assessments Registered</h1>';
} else {

  echo '<form action="assessmentDelete.php" method="post" onSubmit="popupform(this, \'join\',\'assessmentlist\')">';
  echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=cols FRAME=box>';
  echo '<tr><th>Class</th><th>Subject</th><th>Type</th><th>Year</th><th>Term</th><th>Date</th><th>Out Of</th><th>Comment</th><th>Delete Assessment</th></tr>';

  while ($row1 = mysql_fetch_array($result)) {
    echo '<tr>';
    printf('<td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td><td> %s </td><td><input type="submit" name="assessmentno" value="%s" ></td></tr>', $row1['SubClass'], $row1['Lesson'], $row1['AssessmentType'], $row1['Year'], $row1['AssTerm'], $row1['AssDate'], $row1['OutOf'], $row1['AssessmentComment'], $row1['AssessmentNo']);
  }
  echo '</table> </form> ';
}
echo '</fieldset>';
