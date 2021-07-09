<?php
include('connect.php');

$sub = $_POST['subteacherno'];



$sql = "delete from Subjects where SubjectNo='$sub'";
$result = mysql_query($sql);


echo "<br>subject deleted Successfully<br>";
?>

<br /><button onclick="opener.show('subteacherCorrect','mainBody');self.close()">Go Back</button>