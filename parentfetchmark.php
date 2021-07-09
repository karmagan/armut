<?php

$phone = $_POST['stuno'];
$passwd = $_POST['stupass'];
$link = mysql_connect('', '', '');
mysql_select_db('');

$sql = "SELECT *  FROM ParentAccess WHERE replace(Parent,' ','') =replace('$phone',' ','') AND Password='$passwd' ";
$result = mysql_query($sql)
   or die("Error: " . mysql_error());
$count = mysql_num_rows($result);

if ($count != 1) {
   echo '<table style="margin:auto;"><tr><th>Wrong password</br>Please Try 
Again, or click <a 
href="forgotpassword.html">here</a>.</th></tr></table>';
   exit;
} else {
   $sql = "SELECT *  FROM Payee WHERE replace(PrmCntctNo,' ','') =replace('$phone',' ','')  ";
   $result = mysql_query($sql)
      or die("Error: " . mysql_error());
   $row = mysql_fetch_array($result);
   $payeeid = $row['PayeeId'];
   $date = date('Y-m-d');
   printf('<center><fieldset style="text-align:left;"><h1>Welcome %s </h1>', $row['PayeeName']);
   $sql1 = "select * from StudentInformation where PayeeId=$payeeid and `Transfered ?`='0'";
   $sql2 = "select * from Transaction where PayeeId=$payeeid and Date < '$date' and YEAR(Date) = YEAR(NOW()) order by Date";
   $result1 = mysql_query($sql1);
   $result2 = mysql_query($sql2);

   //write a log to ParentLogon
   $sqlParentLogon = "insert into ParentLogon (Parent, Date) values ($payeeid,NOW())";
   mysql_query($sqlParentLogon);

   //Account Information
   $account = 0.00;
   echo '<fieldset><legend>Account For ' . $row['PayeeName'] . '</legend><table BORDER=1 CELLPADDING=0 CELLSPACING=0 RULES=rows FRAME=box >';
   echo '<tr><th>Invoice No</th><th>Date</th><th>Description</th><th>Amount</th></tr>';
   while ($row2 = mysql_fetch_array($result2)) {

      printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>R %s %s</td></tr>', $row2['InvoiceNo'], $row2['Date'], $row2['Description'], $row2['Amount'], $row2['CrDb']);
      if ($row2['CrDb'] == 'Cr') {
         $account = $account + $row2['Amount'];
      } else {
         $account = $account - $row2['Amount'];
      }
   }
   if ($account < 0) {
      printf('</table><strong><div style="text-align: right">Balance: R %s Db</div></strong></fieldset>', abs($account));
   } else {
      printf('</table><strong><div style="text-align: right">Balance: R %s Cr</div></strong></fieldset>', abs($account));
   }

   //Student Information
   while ($row1 = mysql_fetch_array($result1)) {
      $stuno = $row1['ID'];

      $sql = "select * from AssessmentMarks inner join Assessments on AssessmentMarks.Assessment=Assessments.AssessmentNo  inner join Subjects on Assessments.Subject=Subjects.SubjectNo inner join 
Staff on Subjects.Teacher=Staff.TeacherNo inner join LessonNames on Subjects.SubjectName=LessonNames.ID inner join AssessmentTypes on 
Assessments.AssessmentType=AssessmentTypes.AssessmentTypeNo WHERE Student = $stuno and YEAR(AssDate) = YEAR(NOW()) order by AssDate desc";
      $sql2 = "select * from MeritDemerit inner join MeritReasons on MeritDemerit.Reason=MeritReasons.ReasonNo inner join Staff on Staff.TeacherNo=MeritDemerit.Teacher where Student=$stuno and 
YEAR(Date) = YEAR(NOW()) order by Date desc";
      $sql3 = "select * from Marks where ID=$stuno";
      $sql4 = "select * from AAbsent where ID=$stuno and YEAR(Date) = YEAR(NOW())";

      $result = mysql_query($sql);
      $result2 = mysql_query($sql2);
      $result3 = mysql_query($sql3);
      $result4 = mysql_query($sql4);

      printf('<br><h2>Results for %s %s in Grade %s%s</h2>', $row1['FirstName'], $row1['LastName'], $row1['Grade'], $row1['Class']);

      //Assessment results

      echo '<fieldset><legend>Results per Assessment</legend><table BORDER=1 CELLPADDING=0 CELLSPACING=0 RULES=rows FRAME=box >';
      echo '<tr><th>Subject</th><th>Assessment Type</th><th>Explanation</th><th>Teacher Name</th><th>Year</th><th>Term</th><th>Out Of</th><th>Mark</th></tr>';
      while ($row = mysql_fetch_array($result)) {

         printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row['Lesson'], $row['AssessmentType'], $row['AssessmentComment'], $row['Name'] . ' ' . $row['Surname'], $row['Year'], $row['AssTerm'], $row['OutOf'], $row['Mark']);
      }
      echo '</table></fieldset>';

      //Merit Demerits

      echo '<fieldset><legend>Merit/Demerits</legend><table BORDER=1 CELLPADDING=0 CELLSPACING=0 RULES=rows FRAME=box >';
      echo '<tr><th>Date</th><th>Teacher Name</th><th>Reason</th><th>Amount</th></tr>';
      $meritcount = 0;
      while ($row2 = mysql_fetch_array($result2)) {

         printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $row2['Date'], $row2['Name'] . ' ' . $row2['Surname'], $row2['Reason'] . "/" . $row2['MeritExplanation'], $row2['Point']);
         $meritcount = $meritcount + $row2['Point'];
      }
      printf('</table><strong><div style="text-align: right">Total Disciplinary points: %s</div></strong></fieldset>', $meritcount);

      //Term Marks

      echo '<fieldset><legend>Term Marks</legend><table BORDER=1 CELLPADDING=0 CELLSPACING=0 RULES=rows FRAME=box >';
      echo '<tr><th> Subject </th><th> Year </th><th>First Term</th><th>Second Term</th><th>Third Term</th><th>Fourth Term</th></tr>';
      while ($row3 = mysql_fetch_array($result3)) {

         printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row3['Lesson'], $row3['Year'], $row3['FrsTrm'], $row3['ScndTrm'], $row3['ThrdTrm'], $row3['FrthTrm']);
      }
      echo '</table></fieldset>';

      //Absenteism

      echo '<fieldset><legend>Absenteism</legend><table BORDER=1 CELLPADDING=0 CELLSPACING=0 RULES=rows FRAME=box>';
      echo '<tr><th>Date</th><th>Explanation</th></tr>';
      $absentcount = 0;
      while ($row4 = mysql_fetch_array($result4)) {

         printf("<tr><td>%s</td><td>%s</td></tr>", $row4['Date'], $row4['Explanation']);
         $absentcount++;
      }

      printf('</table><strong><div style="text-align: right">Total Absenteism: %s</div></strong></fieldset>', $absentcount);


      echo '<center>>>>>>>>>>>>>>>>==============================<<<<<<<<<<<<</center><br><br>';
   }
}
echo '</fieldset>';
?>

<html>

<head>
   <link rel="stylesheet" type="text/css" href="style1.css" />
</head>

</html>