<?php
include('connect.php');

$asstyp = $_POST['assessmentType'];
$subject = $_POST['subject'];
$outOf = $_POST['outOf'];
$term = $_POST['term'];
$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$comment = $_POST['comment'];


$sql = "insert into Assessments (Subject, AssessmentType, AssTerm, OutOf, AssDate, AssessmentComment) values ('$subject', '$asstyp', '$term' ,'$outOf', '$dateyear\/$datemonth\/$dateday' ,'$comment' )";

$result = mysql_query($sql);

if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

echo "<h2>Assessment created successfully<br><br></h2>";

?>
<br /><button onclick="opener.show('assessmentList.php','mainBody');self.close()">Go Back</button>