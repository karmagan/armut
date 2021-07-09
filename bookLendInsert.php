<?php
include('connect.php');

$book = $_POST['bookid'];
$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$stu = $_POST['stu'];

$date = "$dateyear-$datemonth-$dateday";

$sql = "insert into BookLending (Student,Teacher,DateLend,Book)values ('$stu', '$teacher','$date','$book' )";
mysql_query($sql);

echo $date;
echo "<h2>Book Transaction entered Successfully</h2>";
?>

<br /><button onclick="opener.show('bookLendEnter.php','mainBody');self.close()">Go Back</button>