<?php
include('connect.php');


$stu = $_POST['stu'];
$comment = $_POST['comment'];

for ($i = 0; $i < count($comment); $i++) {


   // check if any comments previously
   if ($comment[$i] != null) {


      $sql2 = "select * from WeeklyNewsletter where Teacher='$teacher' and Student='$stu[$i]' and Date>=DATE_SUB(DATE(NOW()),INTERVAL DAYOFWEEK(NOW()) DAY)";
      $result2 = mysql_query($sql2)
         or die(mysql_error());
      echo mysql_num_rows($result2);
      if (mysql_num_rows($result2) == 0) {


         $sql = "insert into WeeklyNewsletter (Teacher, Student, Week, Comment,Date) values ('$teacher', '$stu[$i]',WEEKOFYEAR(NOW()),'$comment[$i]',DATE(NOW()))";
      } else {
         $sql = "update WeeklyNewsletter set Comment='$comment[$i]' where Teacher='$teacher' and Student='$stu[$i]' and Date>=DATE_SUB(DATE(NOW()),INTERVAL DAYOFWEEK(NOW()) DAY)";
      }
      mysql_query($sql)
         or die(mysql_error());
      echo $stu[$i] . ' ' . $comment[$i];
   }
}

echo $date;
echo "<h2>Weekly Comments entered Successfully</h2>";

?>

<br /><button onclick="opener.show('weeklyEnter','mainBody');self.close()">Go Back</button>