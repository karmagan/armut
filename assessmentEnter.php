<?php
include('connect.php');

$sql = "SELECT *  FROM `AssessmentTypes` ";
$sql2 = "SELECT *  FROM `Subjects` INNER JOIN LessonNames ON 
Subjects.SubjectName=LessonNames.ID  where Subjects.Teacher ='$teacher' 
and Year=YEAR(NOW()) ";

$result = mysql_query($sql);
$result2 = mysql_query($sql2);

if (mysql_num_rows($result2) == 0) {

	echo '<h1>No Subjects Registered<br>Please <a href="entersubteacher.php">register</a> a subject first!</h1>';
} else {

	echo '<br><fieldset><legend>New Assessment</legend>If you want to 
	register a new assessment <br>please select the type of the assessment:<br>';

	echo ('<form action="assessmentInsert.php" method="post" onSubmit="popupform(this, \'join\')"><table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=ROWS FRAME=BOX><tr>');

	echo '<td>Type:</td><td><select name="assessmentType" size="0" >';

	while ($row = mysql_fetch_array($result)) {

		printf('<option value="%s"> %s</option>', $row[0], $row[1]);
	}

	echo '</select></td></tr><tr><td>Subject:</td><td><select name="subject" size="0" >';


	while ($row2 = mysql_fetch_array($result2)) {

		printf('<option value="%s">Subject:%s Grade:%s', $row2['SubjectNo'], $row2['Lesson'], $row2['SubClass']);

		echo '</option>';
	}
	echo '</select></td></tr>';
?>
	<tr>
		<td>Out of</td>
		<td><input type="text" name="outOf" /> </td>
	</tr>

	<tr>
		<td>Term</td>

		<td><select name="term" size="0">
				<?php echo '<option value=' . ceil(date("m") / 3) . ' >' . ceil(date("m") / 3) . '</option>'; ?>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select></td>
	</tr>

	<tr>
		<td>Date</td>
		<td>

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

		</td>
	</tr>
	<tr>
		<td>Comment</td>
		<td>

			<input type="text" name="comment" maxlength="50" />

		</td>
	</tr>
	</table>

	<input type="submit" value="Register assessment">



	</form>
	</fieldset>
<?php }
?>