<?php
include('connect.php');
$grade = $_GET["search"];
$sql  = "SELECT *  FROM `StudentInformation` where `Transfered ?`='0' and Grade=$grade ";
$result = mysql_query($sql);
?>

<fieldset>
    <form name=f1 action="weeklyInsert.php" method="post" onSubmit="popupform(this, 'join','subteacherEnter')">
        <table BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=BOX>
            <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Class</th>
                <th>Comment</th>
            </tr>

            <?php
            while ($row = mysql_fetch_array($result)) {

                $sql2 = "select * from WeeklyNewsletter where Teacher=$teacher and Student=$row[ID] and Date >DATE_SUB(DATE(NOW()),INTERVAL DAYOFWEEK(NOW()) DAY)";
                $result2 = mysql_query($sql2);
                $row2 = mysql_fetch_array($result2);
                printf("<tr><td> %s </td> <td> %s </td> <td> %s </td> <td> %s </td> ", $row['ID'], $row['FirstName'], $row['LastName'], $row['Grade']);
                printf('<td><input type="text" name="comment[]" value="%s" size=40 maxlength=5000/></td></tr>', htmlspecialchars($row2[Comment]));
                printf('<input type="hidden" name=stu[] value= %s />', $row['ID']);
            }

            $sql2 = "select * from WeeklyNewsletter where Teacher=$teacher and Student=$grade and Date > DATE_SUB(DATE(NOW()), INTERVAL DAYOFWEEK(NOW()) DAY )";
            $result2 = mysql_query($sql2);
            $row2 = mysql_fetch_array($result2);
            printf("<tr><td colspan=4> General Anouncements For the whole class </td> ");
            printf('<td><input type="text" name="comment[]" value="%s" size=40
	            maxlength=50000/></td></tr>', htmlspecialchars($row2[Comment]));
            printf('<input type="hidden" name=stu[] value= %s />', $grade);
            ?>
        </table>
        <br>
        <center><input type="submit" value="Submit Weekly Comments" /></center><br>
    </form>
</fieldset>