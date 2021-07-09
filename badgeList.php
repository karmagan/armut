<?php

$link = mysql_connect('', '');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db('', $link);
echo '<head><style>body{font-size:110%;} td{font-size:100%;} th{font-size:110%;} fieldset {width:250px;}</style></head><center>';

$sql = "select * from  StudentInformation where `Transfered ?`='0' order by Grade, Class";
$result = mysql_query($sql);
echo '<form action="badgeUpdate.php" method="POST" onSubmit="popupform(this, \'join\',\'badgelist\')">
<table  BORDER=1 CELLPADDING=1 CELLSPACING=0  FRAME=box>';
printf('<tr><th>Name</th><th>Class</th><th>Total Points</th><th>New Badge</th><th>Current 
Badge</th><th>New Badge Given?</th></tr>');

while ($row = mysql_fetch_array($result)) {

	$sql2 = "select * from MeritDemerit  where Student=$row[0] and YEAR(Date)=YEAR(NOW()) order by Date";
	$result2 = mysql_query($sql2);

	if (mysql_num_rows($result2) != 0) {

		$totalpoint = 0;
		while ($row2 = mysql_fetch_array($result2)) {
			$totalpoint = $totalpoint + $row2['Point'];
		}

		$sql3 = "select * from BadgeList where StudentNo=$row[0] and Year=YEAR(NOW())";
		$result3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($result3);
		$ID = $row['ID'];
		if ($totalpoint >= 100) {
			printf('<tr><td>%s 
%s</td><td>%s%s</td><td>%s</td><td>Diamond</td><td>%s</td><td><input type="checkbox" name="badge[%s]" 
value="Diamond"></td>
</tr>', $row['FirstName'], $row['LastName'], $row['Grade'], $row['Class'], $totalpoint, $row3[2], $row['ID']);
		} elseif ($totalpoint >= 75) {
			printf('<tr><td>%s 
%s</td><td>%s%s</td><td>%s</td><td>Platinum</td><td>%s</td><td><input type="checkbox" name="badge[%s]"
value="Platinum"></td>
</tr>', $row['FirstName'], $row['LastName'], $row['Grade'], $row['Class'], $totalpoint, $row3[2], $row['ID']);
		} elseif ($totalpoint >= 50) {
			printf('<tr><td>%s 
%s</td><td>%s%s</td><td>%s</td><td>Gold</td><td>%s</td><td><input type="checkbox" name="badge[%s]"
value="Gold"></td>
</tr>', $row['FirstName'], $row['LastName'], $row['Grade'], $row['Class'], $totalpoint, $row3[2], $row['ID']);
		} elseif ($totalpoint >= 30) {
			printf('<tr><td>%s 
%s</td><td>%s%s</td><td>%s</td><td>Blue</td><td>%s</td><td><input type="checkbox" name="badge[%s]"
value="Blue"></td>
</tr>', $row['FirstName'], $row['LastName'], $row['Grade'], $row['Class'], $totalpoint, $row3[2], $row['ID']);
		} elseif ($totalpoint >= 15) {
			printf('<tr><td>%s 
%s</td><td>%s%s</td><td>%s</td><td>Red</td><td>%s</td><td><input type="checkbox" name="badge[%s]"
value="Red"></td>
</tr>', $row['FirstName'], $row['LastName'], $row['Grade'], $row['Class'], $totalpoint, $row3[2], $row['ID']);
		}
	}
}
echo '</table> <input type="submit"></form>';
