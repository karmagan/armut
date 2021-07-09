<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];

echo '<fieldset><legend>New Merit Demerit</legend><br>Select the students you would like to give Merit/Demerit and click the button:<br>';

$sql  = "SELECT *  FROM `StudentInformation` where `Transfered ?`='0' and `$searchField` LIKE '%$search%' order by Grade ASC";
$result = mysql_query($sql);

$sql2 = "SELECT *  FROM MeritReasons";
$result2 = mysql_query($sql2);

$i = 0;
while ($row2 = mysql_fetch_array($result2)) {
	$reasonno[$i] = $row2[0];
	$point[$i] = $row2[2];
	$reason[$i] = $row2[1];
	$i++;
}

echo '<form name=f1 action="meritsInsert.php" method="post" onSubmit="popupform(this, \'join\')">';
echo '<table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>';
echo '<tr><th><input type=checkbox onclick="checkAll(0, 1)" >Check All</th><th>Number</th><th>Name</th><th>Surname</th><th>Class</th></tr>';

while ($row = mysql_fetch_array($result)) {

	printf("<tr><td><input type='checkbox' name=stu[] value= %s /> </td> <td>%s </td> <td> %s </td> <td> %s </td><td> %s </td></tr> ", $row['ID'], $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);
}


echo '</table>';
echo '<select name="reason" size="0">';
//	while ( $row2 = mysql_fetch_array($result2))  {
for ($i = 0; $i < count($reasonno); $i++) {
	echo '<option value="' . $reasonno[$i] . '">' . $point[$i] . ' points for ' . $reasonno[$i] . $reason[$i] . '</option>';
}
echo '</select><input type="text" name="explanation" size=30 maxlength=50/>';

?><center>

	Date

	<select name="dateyear" size="0">
		<?php echo '<option value=' . date("Y") . '>' . date("Y") . '</option>';
		?>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
	</select>
	<select name="datemonth" size="0">
		<?php echo '<option value=' . date("m") . '>' . date("F") . '</option>';
		?>
		<option value="1">January</option>
		<option value="2">February</option>
		<option value="3">March</option>
		<option value="4">April</option>
		<option value="5">May</option>
		<option value="6">June</option>
		<option value="7">July</option>
		<option value="8">August</option>
		<option value="9">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	</select>
	<select name="dateday" size="0">
		<?php
		echo '<option value=' . date("d") . '>' . date("d") . '</option>';

		for ($i = 1; $i < 32; $i++) {
			printf('<option value="%s">%s</option>', $i, $i);
		}
		?>
	</select>
	<br>
	<input type="submit" value="Submit Merits" />
</center><br>

<?php
echo '</form>';

?>