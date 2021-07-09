<?php
include('connect.php');

$reason = $_POST['reason'];
$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$stu = $_POST['stu'];
$excused = $_POST['excused'];
$timehour = $_POST['timehour'];
$timeminute = $_POST['timeminute'];

$date = "$dateyear-$datemonth-$dateday";


for ($i = 0; $i < count($reason); $i++) {
	$time = "$timehour[$i]:$timeminute[$i]";
	$sql = "insert into ATardy (ID,Date,Explanation,Excused,Time)values ('$stu[$i]','$date', '$reason[$i]','$excused[$i]','$time' )";
	mysql_query($sql);
	$sql2 = "insert into MeritDemerit (Student,Point,Reason,MeritExplanation,Teacher,Date)values ('$stu[$i]', '-1' ,'36','$time','$teacher','$date')";
	mysql_query($sql2);
}

echo $date;
echo "<h2>Late Learners entered Successfully</h2>";
?>

<br /><button onclick="opener.show('lateEnter.php','mainBody');self.close()">Go
	Back</button>