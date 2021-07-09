<?php

$link = mysql_connect('', '');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db('', $link);
?>

<head>
   <link rel="stylesheet" type="text/css" href="print.css" media="print" />
</head>

<?php
if (isset($_GET['grade'])) {
?>

<?php
   $grade = $_GET['grade'];
   // Get the general Announcements for the grade
   $sql3 = "select * from WeeklyNewsletter inner join Staff on Staff.TeacherNo=WeeklyNewsletter.Teacher where Student=$grade and  Date>=DATE_SUB(DATE(NOW()),INTERVAL DAYOFWEEK(NOW()) DAY) ";
   $result3 = mysql_query($sql3);
   $general = '<ul>';
   while ($row3 = mysql_fetch_array($result3)) {
      $general = $general . '<h3>Teacher: ' . $row3['Name'] . ' ' . $row3['Surname'] . '</h3><li>' . $row3['Comment'] . '</li>';
   }
   $general = $general . '</ul>';

   // Get the students in the grade
   $sql = "select * from  StudentInformation where `Transfered ?`='0' and `Grade`='$grade' order by Grade, Class";
   $result = mysql_query($sql);

   // Iterate through student list
   while ($row = mysql_fetch_array($result)) {
      // Get the comments for the student
      $sql2 = "select * from WeeklyNewsletter inner join Staff on Staff.TeacherNo=WeeklyNewsletter.Teacher where Student=$row[0] and  
Date>=DATE_SUB(DATE(NOW()),INTERVAL DAYOFWEEK(NOW()) DAY) ";
      $result2 = mysql_query($sql2);
      //Get Test results
      $sqltest = "select * from AssessmentMarks inner join Assessments on AssessmentMarks.Assessment=Assessments.AssessmentNo  inner join
Subjects on Assessments.Subject=Subjects.SubjectNo inner join Staff on Subjects.Teacher=Staff.TeacherNo inner join
LessonNames on Subjects.SubjectName=LessonNames.ID inner join AssessmentTypes on Assessments.AssessmentType=AssessmentTypes.AssessmentTypeNo
WHERE Student = $row[0] and AssDate>=DATE_SUB(DATE(NOW()),INTERVAL DAYOFWEEK(NOW()) DAY)  order by AssDate desc";
      $resulttest = mysql_query($sqltest);


      // Get Merit/Demerit for the student
      $sql4 = "select * from MeritDemerit inner join MeritReasons on MeritDemerit.Reason=MeritReasons.ReasonNo inner join Staff on Staff.TeacherNo=MeritDemerit.Teacher where Student=$row[0] and Date>DATE_SUB(NOW(), interval 7 DAY) order by Date desc";
      $result4 = mysql_query($sql4);
      //Get Absenteism
      $sql5 = "select * from AAbsent where ID=$row[0] and Date>DATE_SUB(NOW(), interval 7 DAY)";
      $result5 = mysql_query($sql5);
      //Get TARDY
      $sql6 = "select * from ATardy where ID=$row[0] and Date>DATE_SUB(NOW(), interval 7 DAY)";
      $result6 = mysql_query($sql6);
      //Get Books
      $sql7 = "select * from Books inner join BookLending on Books.BookID=BookLending.Book where Student=$row[0] ";
      $result7 = mysql_query($sql7);

      // print the weekly newsletter
      printf('  <div><table><tr><td colspan=2><legend><h1>WEEKLY NEWSLETTER</h1></legend><h2> %s %s </h2>in Grade %s, 
%s</td></tr>', $row['FirstName'], $row['LastName'], $row['Grade'] . $row['Class'], date('Y-m-d'));

      echo '<tr>';
      if (mysql_num_rows($result3) != 0) {
         echo '<td><h1>General Announcements for the Class:</h1>';
         echo $general . '</td>';
      }
      echo '</tr><tr>';

      if (mysql_num_rows($result2) != 0) {
         echo '<td><h1>Teacher Comments for the Learner:</h1>';
         while ($row2 = mysql_fetch_array($result2)) {
            printf('<h3>Teacher: %s %s</h3>  <p> %s</p>', $row2['Name'], $row2['Surname'], $row2['Comment']);
         }
         echo '</td>';
      }
      echo '</tr><tr>';

      if (mysql_num_rows($resulttest) != 0) {
         echo '<tr><td><h1>Test Results</h1></td></tr>';
         while ($row = mysql_fetch_array($resulttest)) {

            printf(
               '<tr><td>Subject: %s Type: %s | Out of: %s | Mark: %s</td></tr>',
               $row['Lesson'],
               $row['AssessmentType'],
               $row['OutOf'],
               $row['Mark']
            );
         }
      }

      if (mysql_num_rows($result4) != 0) {
         echo '<td><h1>Merit/Demerits</h1>';
         while ($row4 = mysql_fetch_array($result4)) {
            printf('%s %s %s %s <br> ', $row4['Date'], $row4['Name'] . ' ' . $row4['Surname'], $row4['Reason'] . "/" . $row4['MeritExplanation'], $row4['Point']);
         }
         echo '</td>';
      }
      echo '</tr><tr>';

      if (mysql_num_rows($result5) != 0) {
         echo '<td><h1>Absenteeism</h1>';
         while ($row5 = mysql_fetch_array($result5)) {
            printf("%s %s", $row5['Date'], $row5['Explanation']);
         }
         echo '</td>';
      }
      echo '</tr>';

      if (mysql_num_rows($result6) != 0) {
         echo '<td><h1>Late coming</h1>';
         while ($row6 = mysql_fetch_array($result6)) {
            printf("%s %s", $row6['Date'], $row6['Time']);
         }
         echo '</td>';
      }
      echo '</tr>';

      if (mysql_num_rows($result7) != 0) {
         echo '<td><h1>Books borrowed from the library</h1>';
         while ($row7 = mysql_fetch_array($result7)) {
            printf("Title:%s Borrowed:%s Returned:%s</br>", $row7['Title'], $row7['DateLend'], $row7['DateReturn']);
         }
         echo '</td>';
      }
      echo '</tr>';


      // Parent's comment
      echo '<tr><td colspan=2><h1>Parent\'s Comment:</h1>' . 'For the newsletter of ' . date('Y-m-d');
      echo '<br><hr><br><hr><br><hr><br><hr><br>Name: <br>Signature:<br><p class=fineprint>Please sign and 
return.</p></td></tr>';
      echo '</table></div><br>';
   }
}
?>