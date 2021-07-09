<?php
include('connect.php');

$sql2 = "select * from ATardy inner join  StudentInformation on StudentInformation.ID=ATardy.ID order by Date desc";
$result2 = mysql_query($sql2);

echo '<fieldset><legend>Late Students</legend>';
echo '<br>These students are currently registered as late<br>To remove students, select them and click "Delete"';
echo '<form action="lateDelete.php" method="post" onSubmit="popupform(this, \'join\',\'assessmentCorrection\')">';

echo '<input type="submit" value="Delete Learners" /><br><select name="stuno[]" size="25" multiple>';
while ($row2 = mysql_fetch_array($result2)) {

	printf('<option value=%s >%s  %s in Grade %s on %s', $row2['Date'] . ';' . $row2['ID'], $row2['FirstName'], $row2['LastName'], $row2['Grade'], $row2['Date']);

	echo '</option>';
}
echo '</select><br>';
echo '</form>';
