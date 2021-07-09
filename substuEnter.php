<?php
include('connect.php');
$subjectno = $_POST['subjectno'];
$grade = $_POST['subjectclass'];
echo $subjectno . $grade;

echo '<br><fieldset style="style1"><legend>Register New Students</legend>To add students in your subject select the learners, the subject they take and click "Register"';

$sql  = "SELECT *  FROM `StudentInformation` where `Transfered ?`='0' and `Grade`=$grade order by Grade ASC";

$result = mysql_query($sql);

echo '<form action="substuInsert.php" method="post">';

echo '<select name="stuno[]" size="22" multiple>';
while ($row = mysql_fetch_array($result)) {
  printf("<option value= %s >No:%s Name: %s  %s Grade:%s</option> ", $row['ID'], $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);
}
echo '</select>' . '<br>';

printf('<input type=hidden  name="subject" value=%s >', $subjectno);
echo '<input type="submit" value="Register learners" />';
echo '</form>';
echo '</fieldset>';
