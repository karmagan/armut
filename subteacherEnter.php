<?php
include('connect.php');

$sql = "SELECT * FROM LessonNames ";
$result = mysql_query($sql);

echo '<fieldset><legend>Register New Subject</legend>Please select the subject you want to register and class that you teach:<br>';

echo '<form action="subteacherInsert.php" method="post"   onSubmit="popupform(this, \'join\',\'subteacherEnter\')"><table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX><tr><td>Subject</td><td><select name="subject" >';

while ($row = mysql_fetch_array($result)) {

  printf('<option value="%s">%s</option>', $row[0], $row[1]);
}

echo '</select></td></tr><tr><td>Class</td><td><select name="class">';

for ($i = 0; $i < 13; $i++) {
  echo '<option value="' . $i . '" >' . $i . '</option>';
}
echo '</select></td></tr><tr><td>Year:</td><td><select name="year" size="0"> <option value=' . date("Y") . '>' . date("Y") . '</option><option value="2011">2011</option><option value="2012">2012</option></select></td></tr></table><input type="submit" value="register subject" /></form></fieldset>';


$sql1 = "SELECT * FROM Subjects INNER JOIN LessonNames ON 
Subjects.SubjectName=LessonNames.ID WHERE Teacher='$teacher' and 
Year=YEAR(NOW())";
$result1 = mysql_query($sql1);


if (mysql_num_rows($result1) == 0) {
  echo '<h1>No Subjects Registered. Please register your subjects using 
the form above!</h1>';
} else {
  echo '<br><fieldset><legend>Registered Subjects</legend>You are 
currently registered as the teacher of the following subjects and classes. To add students, click the button.';

  echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX><tr><th>Stu</th><th>Subject</th><th>Class</th><th>Year</th></tr>';

  while ($row1 = mysql_fetch_array($result1)) {

    printf('<tr><td><form action="substuEnter.php" method="post" onSubmit="popupform(this, \'join\')"><input type="submit" name="subjectno" value="%s"><input type="hidden" name="subjectclass" value="%s"></form></td>  <td>%s</td>  <td>%s</td> <td>%s</td> </tr> ', $row1['SubjectNo'], $row1['SubClass'], $row1['Lesson'], $row1['SubClass'], $row1['Year']);
  }
  echo '</table></fieldset>';
}
