<?php

include('connect.php');

$stubadge = $_POST['badge'];


//loop through the students

foreach ($stubadge as $stu => $badge) {

    $sql1 = "select * from BadgeList where StudentNo=$stu and Year=YEAR(NOW())";
    $result = mysql_query($sql1);

    if (mysql_num_rows($result) == 0) {


        $sql = "insert into BadgeList (`StudentNo`, `Year`, `Badge`) values ('$stu', YEAR(NOW()),'$badge')";
        mysql_query($sql);
    } else {

        $sql = "update BadgeList set Badge='$badge' where StudentNo='$stu' and Year=YEAR(NOW())";
        mysql_query($sql);
    }
}


?>
<br /><button onclick="opener.show('badgelist.php','mainBody');self.close()">Go Back</button>