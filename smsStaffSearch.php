<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];

echo '<fieldset>';


$sql = "SELECT *  FROM `Staff` where $searchField LIKE '$search%'";

$result = mysql_query($sql);

printf('<form  action="smsSend.php" method="POST" onSubmit="popupform(this, \'join\',\'\')"><table><tr><th>Name 
Surname</th> <th>Cell<br>Check All<input type=checkbox onclick="checkAll(0, 1)" ></th></tr>');
while ($row = mysql_fetch_array($result)) {

	printf(
		'<tr><td>%s %s</td> <td><input type="checkbox" name ="phone[]"  value= "%s">%s</td></tr>',
		$row['Name'],
		$row['Surname'],
		$row['Cell'],
		$row['Cell']
	);
}
echo '</table><br>Type Your SMS:<br><input type="text" name="smstext" size="50" maxlength="150"><input type="image" src="icons/arrow-right.png" /><br>Maximum 150 characters are allowed.<br>Schools Name will be added to your SMS automatically.</form></fieldset>';
