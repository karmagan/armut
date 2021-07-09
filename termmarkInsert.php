<?php
include('connect.php');

$stuno = $_POST['id'];
$mark = $_POST['mark'];
$subteacher = $_POST['subteacher'];
$comment = $_POST['comment'];

if ($_POST['term'] == 1) {
	$term = "FrsTrm";
	$commentField = "Comment1";
} elseif ($_POST['term'] == 2) {
	$term = "ScndTrm";
	$commentField = "Comment2";
} elseif ($_POST['term'] == 3) {
	$term = "ThrdTrm";
	$commentField = "Comment3";
} elseif ($_POST['term'] == 4) {
	$term = "FrthTrm";
	$commentField = "Comment4";
}

echo $subteacher . $term;
// get lesson info
$sql2 = "select * from LessonNames inner join Subjects on Subjects.SubjectName=LessonNames.ID where Subjects.SubjectNo=$subteacher ";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_array($result2);

$i = 0;

//loop through student id's
foreach ($stuno as $id) {
	echo $id;

	//check if any marks entered previously 
	$sql3 = "select * from Marks where ID='$id' and Year='$row2[6]' and Lesson='$row2[1]'";
	$result3 = mysql_query($sql3);

	if (mysql_num_rows($result3) == 0) {

		$sql1 = "select * from StudentInformation where ID='$id'";
		$result1 = mysql_query($sql1);
		$row = mysql_fetch_array($result1);
		$sql = "insert into Marks (Year, ID, `Student Name`, `Student Surname`, Lesson, `$term` , $commentField, Grde, 
Clss) values ('$row2[6]','" . mysql_real_escape_string($row[0]) . "','" . mysql_real_escape_string($row[1]) . "', 
'$row[2]','$row2[1]','$mark[$i]','" . mysql_real_escape_string($comment[$i]) . "','$row[3]','$row[4]')";
		mysql_query($sql);
		$i++;
	} else {
		$sql = "UPDATE Marks SET `$term` ='$mark[$i]' , $commentField='$comment[$i]' where ID='$id' AND Year= '$row2[6]' AND Lesson='$row2[1]'";
		mysql_query($sql);
		$i++;
	}
}



echo date('Y-m-d');
echo "Marks entered Successfully";


?>

<br /><button onclick="opener.show('termmarks','mainBody');self.close()">Go Back</button>