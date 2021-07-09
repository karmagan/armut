<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];


echo '<fieldset ><legend>Student List:</legend>';

$sql  = "SELECT *  FROM `StudentInformation` where `Transfered ?`='0' and `$searchField` LIKE '%$search%' order by Grade ASC";


$result = mysql_query($sql);

echo '<form action="fetchmark.php" method="post"  onSubmit="popupform(this, \'join\')"><table BORDER=1 CELLPADDING=0 CELLSPACING=0 RULES=rows FRAME=box>';

echo '<tr><th>Student No</th><th>First Name</th><th>Last Name</th><th>Grade</th></tr>';
while ($row = mysql_fetch_array($result)) {

    printf("<tr><td> <input type='submit' name='stuno' value=%s > </td> <td> %s </td> <td> %s </td> <td> %s </td> </tr>", $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);
}

echo '</table></form>';

echo '</fieldset>';
