<?php
include('connect.php');

$stu = $_POST['stuno'];

$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$date = "$dateyear-$datemonth-$dateday";
for ($i = 0; $i < count($stu); $i++) {

	$sql = "insert into Discipline (`Student ID`,`Date`,`DetentionServed`,Teacher)values ('$stu[$i]','$date', '1','$teacher')";
	mysql_query($sql);

	echo $stu[$i];
}


echo "<h2>Served Detentions entered Successfully</h2>";




?>
<br /><button onclick="opener.show('serveddetentionEnter','mainBody');self.close()">Go Back</button>