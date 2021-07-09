<?php


$link = mysql_connect('', '', '');
mysql_select_db('');
$phone = $_POST['stuno'];
$phone = str_replace(' ', '', $phone);

$sql = "select * from Payee where replace(PrmCntctNo,' ','')='$phone'";
$result = mysql_query($sql);

if (mysql_num_rows($result) == 0) {

	echo "<center>This telephone number is not registered in our system. <br>Please enter the phone number that is registered in 
our database, or contact the school.</center>";
} else {
	$sql2 = "select * from ParentAccess where Parent='$phone'";
	$result2 = mysql_query($sql2);
	if (mysql_num_rows($result2) == 0) {
		$parentPasswd = rand(1000, 9999);
		$sql1 = "insert into ParentAccess (Parent, Password) values ('$phone', '$parentPasswd')";
		mysql_query($sql1)
			or die("Error: " . mysql_error());
	} else {
		$sql1 = "select * from ParentAccess where Parent='$phone'";
		$result1 = mysql_query($sql1)
			or die("Error: " . mysql_error());
		$row = mysql_fetch_array($result1);
		$parentPasswd = $row['Password'];
		//	echo $parentPasswd;

	}


	$message = "[Al-Azhar] Your Password for Al-Azhar ARMUT system is: " . $parentPasswd;
	$subject = "ala6:service::$myemail";

	$to = $phone . "@sms.axxess.co.za";
	mail($to, $subject, $message, $additional_headers = null, $additional_parameters = null);
	echo "<br><br><center>Your password for Al-Azhar ARMUT system is sent to 
'$phone',<br>the phone number that is registered in our 
database.</center>";
}
