<?php
include('connect.php');

$reason = $_POST['reason'];
$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$explanation = $_POST['explanation'];
$stu = $_POST['stu'];

$date = "$dateyear-$datemonth-$dateday";

for ($i = 0; $i < count($stu); $i++) {
	echo $reason[$i];
	if ($reason != 49) {
		$sql1 = "select Amount from MeritReasons where ReasonNo='$reason' ";
		$result = mysql_query($sql1);
		$amount = mysql_fetch_array($result);
		$sql = "insert into MeritDemerit (Student,Point,Reason,MeritExplanation,Teacher,Date)values ('$stu[$i]', '$amount[0]','$reason','$explanation','$teacher','$date' )";
		mysql_query($sql);

		echo $stu[$i];
	}
}

echo $date;
echo "<h2>Merit Demerits entered Successfully</h2>";


?>

<br /><button onclick="opener.show('meritsEnter.php','mainBody');self.close()">Go Back</button>