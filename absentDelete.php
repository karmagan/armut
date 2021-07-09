<?php
include('connect.php');

$stu = $_POST['stuno'];

foreach ($stu as $stuno) {
	echo $stuno;

	$stuno = explode(";", $stuno);

	echo $stuno[0];
	echo $stuno[1];

	//for($i=0;$i<count($stuno);$i++) {
	//	$stu=$stuno[$i];
	$sql = "delete from AAbsent where ID='$stuno[1]' AND Date='$stuno[0]'";
	$result = mysql_query($sql);
	//echo $absentdate[$stu];
	//	}

}
echo "<br>Students deleted Successfully<br>";

?>

<br /><button onclick="opener.show('absentCorrection.php','mainBody');self.close()">Go Back</button>