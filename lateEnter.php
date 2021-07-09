<?php include('connect.php'); ?>

<fieldset>
	For Late comers Search by First name: <input type="text" onkeyup="search(this.value,'late','FirstName')" size="20" />
	<br>
	For Absent Search by Student ID: <input type="text" onkeyup="search(this.value,'late','ID')" size="20" />
	<br>
	or search by grade :
	<select onchange="search(this.value,'late','Grade')" />
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

$sql3 = "select * from ATardy inner join  StudentInformation on StudentInformation.ID=ATardy.ID where Date='$date' ";
$result3 = mysql_query($sql3);
echo '<br><fieldset><legend>Late Students</legend>';
echo '<br>These students are currently registered as late today:<br><table>';
while ($row3 = mysql_fetch_array($result3)) {
	printf('<tr><td>%s  %s</td> <td>Grade %s</td> <td>NO:%s</td></tr>', $row3['FirstName'], $row3['LastName'], $row3['Grade'], $row3['ID']);
}
echo '</table></fieldset>';
?>