<?php
include('connect.php');



$sql2 = "select * from SubStu inner join Subjects on SubStu.Subject=Subjects.SubjectNo inner join StudentInformation on StudentInformation.ID=SubStu.Student inner join LessonNames on Subjects.SubjectName=LessonNames.ID where Teacher= $teacher";

$result2 = mysql_query($sql2);



if (mysql_num_rows($result2) == 0) {
	echo '<h1>No Students Registered</h1>';
} else {

	echo '<fieldset><legend>Registered Students</legend>';
	echo '<br>These students are currently registered in your subjects<br>To remove students, select them and click "Delete"';
	echo '<form action="substuDelete.php" method="post" onSubmit="popupform(this, \'join\')">';

	echo '<select name="stuno[]" size="5" multiple>';
	while ($row2 = mysql_fetch_array($result2)) {

		printf("<option value=%s >%s  %s in Grade %s Registered to %s %s", $row2['Student'], $row2['FirstName'], $row2['LastName'], $row2['Grade'] . $row2['Class'], $row2['Lesson'], $row2['SubClass']);
		$subject2[$row2['Student']] = $row2['SubjectNo'];

		echo '</option>';
	}
	echo '</select><br>';
	echo '<input type="submit" value="Delete Learners" /></form>';
}

//<input type="hidden" name="sub2" value="'.$subject2.'" />
$_SESSION['sub2'] = $subject2;
