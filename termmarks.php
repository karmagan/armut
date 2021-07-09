<?php
include('connect.php');

$sql = "SELECT *  FROM LessonNames ";
$sql1 = "SELECT * FROM Subjects INNER JOIN LessonNames ON Subjects.SubjectName=LessonNames.ID WHERE Teacher='$teacher' and Year=YEAR(NOW())";
$result = mysql_query($sql);
$result1 = mysql_query($sql1);

if (mysql_num_rows($result1) == 0) {
	echo '<h1>No Subjects Registered. Please register your subjects using the form below!</h1>';
} else {
	echo '<fieldset><legend>Registered Subjects</legend>You are currently registered as the teacher of the following subjects and classes:';
	echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';
	echo '<tr><th>Subject</th><th>Class</th><th>Year</th><th>TERM MARKS</th></tr>';

	while ($row1 = mysql_fetch_array($result1)) {

		printf('<tr><td>%s</td>  <td>%s</td> <td>%s</td> <td> <form action="termmarkEnter.php" method="post" onSubmit="popupform(this, \'join\')"><input type="hidden" name="subteacherno" value="%s" > ', $row1['Lesson'], $row1['SubClass'], $row1['Year'], $row1['SubjectNo']);

		echo '<select name="term" >';
		echo '<option value=' . ceil(date("m") / 3) . ' >term ' . ceil(date("m") / 3) . '</option>';
		for ($i = 1; $i < 5; $i++) {
			echo "<option value=$i >term $i</option>";
		}
		echo '</select><br><input name="termMarkButton" type="submit" 
				value="Edit/Correct Term Marks" /><input name="termMarkButton" 
				type="submit" value="Calculate Term Marks" /></form> </td></tr>';
	}
	echo '</table>';

	echo '</fieldset>';
}
