<?php
include('connect.php');
$assessment = array();
$subteacher = $_POST['subteacherno'];

$term = $_POST['term'];
echo '<br>You selected term: ' . $term . '<br>';


// Assessments' Weights
if ($weight = $_POST['weight']) {

	$assno = $_POST['assno'];

	for ($i = 0; $i < count($assno); $i++) {
		$sql2 = "UPDATE Assessments SET AssWeight='$weight[$i]' where AssessmentNo='$assno[$i]' ";
		mysql_query($sql2);
	}
}

// Check Term Marks and Comments

if ($_POST['termMarkButton'] == 'Edit/Correct Term Marks') {





	//echo '<br><br>If You wish to change weights and recalculate the marks:';

	//$sql = "SELECT *  FROM Assessments inner join Subjects on Assessments.Subject=Subjects.SubjectNo inner join
	//AssessmentTypes on AssessmentTypes.AssessmentTypeNo=Assessments.AssessmentType where
	//Assessments.Subject=$subteacher AND Assessments.AssTerm=$term ";

	//$result=mysql_query($sql);


	//echo '<form  method="post"><fieldset><legend>Assessment Weights</legend> ';
	//echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';
	//echo '<th>Assessment Type</th><th>Date</th><th>Out Of</th><th>Enter Weight</th>';
	//while($row=mysql_fetch_array($result)) {

	//	printf('<tr><td>%s</td> <td>%s</td> <td>%s</td> ', $row['AssessmentType'],$row['AssDate'],$row['OutOf']);
	//	echo '<td><input type="text" name="weight[]" value="'.$row['AssWeight'].'" /></td></tr><input type="hidden" 
	//name="assno[]" value='.$row['AssessmentNo'].' />';
	//	$assessment[]=	$row['AssessmentType'].' - '. ($row['OutOf']);
	//	}
	//	echo '</table></fieldset><input type="submit" value="Calculate Term Marks" />';

	//	echo '<input type="hidden" name="subteacherno" value='.$subteacher.' /><input type="hidden" name="term" 
	//value='.$term.' /></form>';

	//Enter Students' marks and Comments
	//Get student info
	$sql = "select ID, FirstName, LastName from StudentInformation inner join SubStu on StudentInformation.ID=SubStu.Student where Subject=$subteacher order by `LastName`";
	$result = mysql_query($sql);

	//Get Subject Name
	$sql2 = "select * from LessonNames inner join Subjects on Subjects.SubjectName=LessonNames.ID where Subjects.SubjectNo=$subteacher ";
	$result2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($result2);

	//Start Form
	echo	'<form action="termmarkInsert.php" method="post"><fieldset><legend>Terms Marks</legend><table border="1"><tr><th>Name</th>';
	//$i=0;
	//foreach ($assessment as $assmnt){
	//		echo '<th>'.$assmnt[$i].'</th>';
	//		}
	echo '<th>Final Mark</th><th>Comment</th></tr>';
	//Loop through Students
	while ($row = mysql_fetch_array($result)) {
		echo '<tr><td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>';
		//Get Marks for the student	
		$sql3 = "select * from Marks where Year='$row2[6]' and Lesson='$row2[1]' and Grde='$row2[5]' and ID='$row[ID]'";
		$result3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($result3);

		if ($term == 1) {
			$termno = "FrsTrm";
			$commentField = "Comment1";
		} elseif ($term == 2) {
			$termno = "ScndTrm";
			$commentField = "Comment2";
		} elseif ($term == 3) {
			$termno = "ThrdTrm";
			$commentField = "Comment3";
		} elseif ($term == 4) {
			$termno = "FrthTrm";
			$commentField = "Comment4";
		}

		//Get Assessment Marks For the student
		//	$sql1 = "select * from AssessmentMarks inner join Assessments on 
		//Assessments.AssessmentNo=AssessmentMarks.Assessment WHERE Subject=$subteacher AND Student=$row[0] AND 
		//Assessments.AssTerm=$term";
		//	$result1 = mysql_query($sql1);

		//	$mark[$row['ID']]=0;

		//	while($row1=mysql_fetch_array($result1)) {
		//	printf ( '<td>%s</td>',$row1['Mark']);
		//	$mark[$row['ID']]=$mark[$row['ID']]+$row1['Mark']/$row1['OutOf']*$row1['AssWeight'];
		//	}


		printf('<td><input type="text" name="mark[]" value="%s"></td><td><input type="text" name="comment[]" size="20" 
maxlength="110" value="%s"></td></tr><input type="hidden" name="id[]" 
value="%s">', $row3[$termno], $row3[$commentField], $row['ID']);
	}

	echo '</table></fieldset><input type="hidden" name="subteacher" value="' . $subteacher . '" />';
	echo '<input type="hidden" name="term" value="' . $term . '">';
	echo 'If you are happy with the results <input type="submit" value="Submit Term Marks" /></form>';
} else {





	echo '<br><br>If You wish to change weights and recalculate the marks:';

	$sql = "SELECT *  FROM Assessments inner join Subjects on Assessments.Subject=Subjects.SubjectNo inner join AssessmentTypes on AssessmentTypes.AssessmentTypeNo=Assessments.AssessmentType where Assessments.Subject=$subteacher AND Assessments.AssTerm=$term ";

	$result = mysql_query($sql);

	echo '<form  method="post"><fieldset><legend>Assessment Weights</legend> ';
	echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';
	echo '<th>Assessment Type</th><th>Date</th><th>Out Of</th><th>Comment</th><th>Enter Weight</th>';
	while ($row = mysql_fetch_array($result)) {

		printf('<tr><td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td>', $row['AssessmentType'], $row['AssDate'], $row['OutOf'], $row['AssessmentComment']);
		echo '<td><input type="text" name="weight[]" value="' . $row['AssWeight'] . '" /></td></tr><input type="hidden" name="assno[]" value=' . $row['AssessmentNo'] . ' />';
		$assessment[] = $row['AssessmentType'] . ' - (' . $row['OutOf'] . ')';
	}
	echo '</table></fieldset><input type="submit" value="Calculate Term Marks" />';

	echo '<input type="hidden" name="subteacherno" value=' . $subteacher . ' /><input type="hidden" name="term"
value=' . $term . ' /></form>';

	//Enter Students' marks and Comments
	//Get student info
	$sql = "select ID, FirstName, LastName from StudentInformation inner join SubStu on StudentInformation.ID=SubStu.Student where Subject=$subteacher order by 
`LastName`";
	$result = mysql_query($sql);

	//Get Subject Name
	$sql2 = "select * from LessonNames inner join Subjects on Subjects.SubjectName=LessonNames.ID where Subjects.SubjectNo=$subteacher ";
	$result2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($result2);

	//Start Form
	echo    '<form action="termmarkInsert.php" method="post"><fieldset><legend>Terms Marks</legend><table border="1"><tr><th>Name</th>';
	$i = 0;
	foreach ($assessment as $assmnt) {
		echo '<th>' . "$assmnt" . '</th>';
	}
	echo '<th>Final Mark</th><th>Comment</th></tr>';
	//Loop through Students
	while ($row = mysql_fetch_array($result)) {
		echo '<tr><td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>';
		//Get Marks for the student
		$sql3 = "select * from Marks where Year='$row2[6]' and Lesson='$row2[1]' and Grde='$row2[5]' and ID='$row[ID]'";
		$result3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($result3);

		if ($term == 1) {
			$termno = "FrsTrm";
			$commentField = "Comment1";
		} elseif ($term == 2) {
			$termno = "ScndTrm";
			$commentField = "Comment2";
		} elseif ($term == 3) {
			$termno = "ThrdTrm";
			$commentField = "Comment3";
		} elseif ($term == 4) {
			$termno = "FrthTrm";
			$commentField = "Comment4";
		}

		//Get Assessment Marks For the student
		$sql1 = "select * from AssessmentMarks inner join Assessments on
	Assessments.AssessmentNo=AssessmentMarks.Assessment WHERE Subject=$subteacher AND Student=$row[0] AND
	Assessments.AssTerm=$term";
		$result1 = mysql_query($sql1);

		// Calculate final mark
		$mark[$row['ID']] = 0;

		while ($row1 = mysql_fetch_array($result1)) {
			printf('<td>%s</td>', $row1['Mark']);
			$mark[$row['ID']] = $mark[$row['ID']] + $row1['Mark'] / $row1['OutOf'] * $row1['AssWeight'];
		}

		// Print the row for the student
		printf('<td>%s<input type="hidden" name="mark[]" value="%s"></td><td><input type="text" name="comment[]" size="50"
	maxlength="110" value="%s"></td></tr><input type="hidden" name="id[]"
	value="%s">', $mark[$row['ID']], $mark[$row['ID']], $row3[$commentField], $row['ID']);
	}

	echo '</table></fieldset><input type="hidden" name="subteacher" value="' . $subteacher . '" />';
	echo '<input type="hidden" name="term" value="' . $term . '">';
	echo 'If you are happy with the results <input type="submit" value="Submit Term Marks" /></form>';
}
