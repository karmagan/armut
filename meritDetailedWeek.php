<?php

include('connect.php');

$sql = "select * from  StudentInformation where `Transfered ?`='0' order by Grade, Class";
$result = mysql_query($sql);

echo '<table  BORDER=1 CELLPADDING=1 CELLSPACING=0  FRAME=box>';
while ($row = mysql_fetch_array($result)) {
    $sql2 = "select * from MeritDemerit inner join MeritReasons on 
MeritDemerit.Reason=MeritReasons.ReasonNo inner join Staff on 
Staff.TeacherNo=MeritDemerit.Teacher where Student=$row[0] and 
Date>DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE())+1 DAY) 
order by Date";
    $result2 = mysql_query($sql2);
    if (mysql_num_rows($result2) != 0) {
        printf('<tr><td><fieldset><legend>%s %s in Grade %s</legend><table BORDER=1 CELLPADDING=1 CELLSPACING=0  FRAME=box>', $row['FirstName'], $row['LastName'], $row['Grade'] . $row['Class']);
        echo '<tr><th>Date</th><th>Teacher Name</th><th>Reason</th><th>Amount</th></tr>';
        $totalpoint = 0;
        while ($row2 = mysql_fetch_array($result2)) {
            printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row2['Date'], $row2['Name'] . ' ' . $row2['Surname'], $row2['Reason'] . "/" . $row2['MeritExplanation'], $row2['Point']);
            $totalpoint = $totalpoint + $row2['Point'];
        }
        echo '</table><strong>Total Disciplinary Points: ' . $totalpoint . '</strong></fieldset></td></tr>';
    }
}
echo '</table>';
