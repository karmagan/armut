<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];

echo '<fieldset>';


//		$sql = "SELECT *  FROM `Staff`"	;
//		$result=mysql_query($sql);

$sql  = "SELECT * FROM StudentInformation inner join Payee on StudentInformation.PayeeId=Payee.PayeeId where $searchField LIKE '%$search%' and `Transfered ?`='0' order by Grade ASC";

$result = mysql_query($sql);

printf('<form  action="smsSend.php" method="POST" onSubmit="popupform(this, \'join\',\'\')"><table><tr><th> Grade</th> <th>Name Surname</th> <th>Father<br>Check All<input type=checkbox onclick="checkAll(0, 3)" ></th><th>Mother<br>Check All<input type=checkbox onclick="checkAll(1, 3)" ></th><th>Primary Contact<br>Check All<input type=checkbox onclick="checkAll(2, 3)" ></th>');
while ($row = mysql_fetch_array($result)) {

	printf('<tr><td> %s</td> <td>%s %s</td> <td><input type="checkbox" name ="phone[]"  value= "%s" >%s</td><td><input type="checkbox" name ="phone[]"  value= "%s" > %s</td><td><input type="checkbox" name ="phone[]"  value= "%s" > %s</td> </tr>', $row['Grade'], $row['FirstName'], $row['LastName'], $row['FatherCell'], $row['FatherCell'], $row['MotherCell'], $row['MotherCell'], $row['PrmCntctNo'], $row['PrmCntctNo']);
}
echo '</table><br>Type Your SMS:<br><input type="text" name="smstext" size="50" maxlength="150"><input type="image" src="icons/arrow-right.png" /><br>Maximum 150 characters are allowed.<br>Schools Name will be added to your SMS automatically.</form></fieldset>';
