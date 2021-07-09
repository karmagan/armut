<?php include('connect.php'); ?>
<fieldset>
	For Absent Search by First name: <input type="text" onkeyup="search(this.value,'absent','FirstName')" size="20" />
	<br>
	For Absent Search by Student ID: <input type="text" onkeyup="search(this.value,'absent','ID')" size="20" />
	<br>
	or search by grade :
	<select onchange="search(this.value,'absent','Grade')" />
	<option>select</option>
	<?php for ($i = -2; $i < +12; $i++) {
		echo "<option value=$i>$i";
	}
	?>
	</select>
</fieldset>
<br>

<div id="searchResult"></div>

<?php




$date = date('Y-m-d');
$sql2 = "select * from AAbsent inner join  StudentInformation on StudentInformation.ID=AAbsent.ID where Date='$date' ";
$result2 = mysql_query($sql2);
echo '<br><fieldset><legend>Absent Students</legend>';
echo '<br>These students are currently registered as absent today:<br><table>';
while ($row2 = mysql_fetch_array($result2)) {
	printf('<tr><td>%s  %s</td> <td>Grade %s</td> <td>NO:%s</td></tr>', $row2['FirstName'], $row2['LastName'], $row2['Grade'], $row2['ID']);
}
echo '</table></fieldset>';


?>