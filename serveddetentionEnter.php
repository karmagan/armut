<?php
include('connect.php');

$sql = "select * from  StudentInformation where `Transfered ?`='0' order by Grade, Class";
$result = mysql_query($sql);
echo '<form action="serveddetentionInsert.php" method="post" onSubmit="popupform(this, \'join\',\'meritsCorrection\')"><table  BORDER=1 CELLPADDING=1 CELLSPACING=0  FRAME=box>';
printf('<tr><th>Served?</th><th>Name</th><th>Class</th><th>Total Points</th><th>Detention Served</th><th>Detention Left</th></tr>');

while ($row = mysql_fetch_array($result)) {

	$sql2 = "select * from MeritDemerit inner join MeritReasons on 
MeritDemerit.Reason=MeritReasons.ReasonNo inner join Staff on Staff.TeacherNo=MeritDemerit.Teacher where 
Student=$row[0] and YEAR(Date)=YEAR(NOW()) order by Date";
	$result2 = mysql_query($sql2);
	$sql3 = "select * from Discipline  where `Student ID`=$row[0] and 
DetentionServed='1' and YEAR(Date)=YEAR(NOW()) order by Date";
	$result3 = mysql_query($sql3);
	$detentionserved = mysql_num_rows($result3);
	if (mysql_num_rows($result2) != 0) {

		$totalpoint = 0;
		while ($row2 = mysql_fetch_array($result2)) {
			$totalpoint = $totalpoint + $row2['Point'];
		}
		$detentionleft = -ceil($totalpoint / 10) - $detentionserved;
		if ($detentionleft > 0) {

			printf('<tr><td><input type="checkbox" name="stuno[]" value="%s" /></td><td>%s %s</td><td>%s%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade'], $row['Class'], $totalpoint, $detentionserved, $detentionleft);
		}
	}
}
echo '';
?>

<tr>
	<td colspan="6">
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


		<input type="submit" value="Submit Served Detention" />
	</td>
</tr>
</table>
</form>