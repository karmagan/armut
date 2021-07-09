<?php
include('connect.php');


$sql1 = "select * from MeritDemerit inner join StudentInformation on StudentInformation.ID=MeritDemerit.Student where Teacher='$teacher' and Year(`Date`)=Year(NOW()) order by Date desc";
$result1 = mysql_query($sql1);



echo ' <fieldset><legend>Registered Merits and Demerits</legend>These are the students that you have given Merit/Demerit. To delete select the students and click the button. <br>';
echo ' <form action="meritsDelete.php" method="post" onSubmit="popupform(this, \'join\',\'meritsCorrection\')"><input type="submit" value="Delete Merit/Demerit" /><table><tr><th>Check</th><th>No</th> <th>Name</th> <th>Date</th> <th>Amount</th></tr> ';

while ($row1 = mysql_fetch_array($result1)) {

  printf('<tr><td><input type="checkbox" name="meritno[]" value=%s ></td><td>%s</td> <td> %s  %s</td> <td>%s</td> <td>%s</td></tr> ', $row1['MeritNo'], $row1['Student'], $row1['FirstName'], $row1['LastName'], $row1['Date'], $row1['Point']);
}
echo ' </table><br></form></fieldset></body></html>';
