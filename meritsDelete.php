<?php
include('connect.php');

$meritno = $_POST['meritno'];




for ($i = 0; $i < count($meritno); $i++) {
	$merit = $meritno[$i];
	$sql = "delete from MeritDemerit where MeritNo='$merit'";
	mysql_query($sql);
}


echo "<br>Merit/Demerit deleted Successfully<br>";

?>

<br /><button onclick="opener.show('meritsCorrection.php','mainBody');self.close()">Go Back</button>