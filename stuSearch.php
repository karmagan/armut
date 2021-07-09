<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];

$sql  = "SELECT *  FROM `StudentInformation`  where `Transfered ?`='0' and `$searchField` LIKE '$search%'";
$result = mysql_query($sql)
	or die(mysql_error);

echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';
echo '<tr><th>Check </th><th>Number</th><th>Name</th><th>Surname</th><th>Grade</th></tr>';

while ($row = mysql_fetch_array($result)) {

	printf("<tr><td><input type='radio' name=stu value= %s /> </td> <td>%s </td> <td> %s </td><td> %s </td> <td> %s </td> </tr>", $row['ID'], $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);
}

echo '</table>';
