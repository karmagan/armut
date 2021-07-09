<?php
include('connect.php');
$search = $_GET["search"];
$searchField = $_GET["searchField"];

echo '<br><fieldset><legend>Late Learners</legend><br>Select the 
students you would like to register as Late and click the button:<br>';

$sql  = "SELECT *  FROM `StudentInformation` where `Transfered ?`='0' and $searchField LIKE '%$search%' ";
$result = mysql_query($sql);

echo 'Grade:' . $grade . '<form action="lateInsert.php" method="post" onSubmit="popupform(this, \'join\')"><table BORDER=1 CELLPADDING=2 CELLSPACING=0 RULES=rows FRAME=box>';
echo '<tr><th>Check</th><th>Number</th><th>Name</th><th>Surname</th><th>Class</th><th>Hour</th><th>Minute</th><th>Reason</th><th>Excused?</th></tr>';

while ($row = mysql_fetch_array($result)) {


	printf("<tr><td><input type=\"checkbox\" name=\"stu[]\" value=\"%s\" /></td> <td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> ", $row['ID'], $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);


	echo '<td><select name="timehour[]" size="0">';
	echo '<option value=' . date("G") . '>' . date("G") . '</option>';
	for ($i = 8; $i < 15; $i++) {
		printf('<option value="%s">%s</option>', $i, $i);
	}
	echo '</td><td></select><select name="timeminute[]" size="0">';
	echo '<option value=' . date("i") . '>' . date("i") . '</option>';
	for ($i = 0; $i < 59; $i = $i + 5) {
		printf('<option value="%s">%s</option>', $i, $i);
	}
	echo '</select></td>';
	echo '<td><input type="text" name="reason[]" size="20" maxlength="50"></td><td><input type="checkbox" name="excused[]" value="1" /></td>';
}

echo '</table>';

?>
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


<br>
<input type="submit" value="Submit Tardy" />

</form>