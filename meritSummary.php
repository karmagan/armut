<?php

include('connect.php');

echo '<head><style>body{font-size:70%;} td{font-size:60%;} th{font-size:70%;} fieldset {width:250px;}</style></head><center>';
$sql = "select * from  StudentInformation where `Transfered ?`='0' order by Grade, Class";

$result = mysql_query($sql);
echo '<table  BORDER=1 CELLPADDING=1 CELLSPACING=0  FRAME=box><tr>';
$tdcount = 0;

while ($row = mysql_fetch_array($result)) {

	if ($tdcount == 3) {
		echo '</tr><tr>';
		$tdcount = 0;
	}

	$sql2 = "select * from MeritDemerit where Student=$row[0] and YEAR(Date)=YEAR(NOW()) order by Date";
	$result2 = mysql_query($sql2);
	$sql3 = "select * from Discipline  where `Student ID`=$row[0] and DetentionServed='1' and YEAR(Date)=YEAR(NOW()) order by Date";
	$result3 = mysql_query($sql3);
	$detentionserved = mysql_num_rows($result3);
	if (mysql_num_rows($result2) != 0) {
		$tdcount = $tdcount + 1;
		printf('<td><fieldset><legend>%s %s in Grade %s</legend>', $row['FirstName'], $row['LastName'], $row['Grade'] . $row['Class']);

		$totalpoint = 0;
		while ($row2 = mysql_fetch_array($result2)) {


			$totalpoint = $totalpoint + $row2['Point'];
		}
		echo '<strong>Total Disciplinary Points: ' . $totalpoint;

		if ($totalpoint >= 100) {
			echo "<br>Diamond Badge";
		} elseif ($totalpoint >= 80) {
			echo "<br>Platinum Badge";
		} elseif ($totalpoint >= 60) {
			echo "<br>Gold Badge";
		} elseif ($totalpoint >= 40) {
			echo "<br>Blue Badge";
		} elseif ($totalpoint >= 20) {
			echo "<br>Red Badge";
		}


		printf('<br>Detentions served: %s', $detentionserved);
		$detentionleft = -ceil($totalpoint / 10) - $detentionserved;
		if ($detentionleft > 0) {
			printf('<br><a style="color:red">Detention Left: %s</a>', $detentionleft);
		}

		echo '</strong></fieldset></td>';
	}
}
echo '</tr></table>';
