<?php
include('connect.php');


$sql1 = "SELECT * FROM Subjects INNER JOIN LessonNames ON 
Subjects.SubjectName=LessonNames.ID WHERE Teacher='$teacher' order by 
Year DESC ";

$result1 = mysql_query($sql1);

if (mysql_num_rows($result1) == 0) {
	echo '<h1>No Subjects Registered. Please register your subjects using the form below!</h1>';
} else {
	echo '<fieldset><legend>Registered Subjects</legend>You are currently registered as the teacher of the following subjects and classes:';

	echo '<form action="subteacherDelete.php" method="post"  onSubmit="popupform(this, \'join\',\'meritsCorrection\')"><table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX><tr><th>Subject</th><th>Class</th><th>Year</th><th>DELETE</th></tr>';

	while ($row1 = mysql_fetch_array($result1)) {

		printf('<tr><td>%s</td>  <td>%s</td> <td>%s</td> <td><input type="submit" name="subteacherno" value="%s" ></td> </tr> ', $row1['Lesson'], $row1['SubClass'], $row1['Year'], $row1['SubjectNo']);
	}
	echo '</table></form></fieldset>';
}
