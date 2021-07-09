<?php
include('connect.php');

$reason = $_POST['reason'];
$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$stu = $_POST['stu'];
$excused = $_POST['excused'];

$date = "$dateyear-$datemonth-$dateday";

for ($i = 0; $i < count($reason); $i++) {

	$sql = "insert into AAbsent (ID,Date,Explanation,Excused,1or0forabsenteism)values ('$stu[$i]','$date', '$reason[$i]','$excused[$i]','1' )";
	mysql_query($sql);
	$sql2 = "SELECT *  FROM StudentInformation inner join Payee on StudentInformation.PayeeId=Payee.PayeeId where `ID`='$stu[$i]'";
	$result = mysql_query($sql2);
	$row = mysql_fetch_array($result);
	if ($row[Grade] > 5) {


		$to = str_replace(" ", "", $row['PrmCntctNo']) . "@sms.axxess.co.za";
		$subject = "ala6:service::$myemail";
		$message = "[Al-Azhar] Dear Parent/Guardian, your child/ward $row[FirstName] $row[LastName] has been absent on $date. Please send a letter explaining the absenteism.";
		//	mail($to, $subject, $message, $additional_headers = null, $additional_parameters = null);
		print $message;
	}
}


echo "<h2>Absent Learners entered Successfully</h2>";




?>

<br /><button onclick="opener.show('absentEnter.php','mainBody');self.close()">Go Back</button>