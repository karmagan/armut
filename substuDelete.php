<?php
include('connect.php');

$stuno = $_POST['stuno'];
$sub2 = $_SESSION['sub2'];



for ($i = 0; $i < count($stuno); $i++) {
	$stu = $stuno[$i];
	$sql = "delete from SubStu where Student='$stu' AND Subject='$sub2[$stu]'";
	$result = mysql_query($sql);
	echo $stu . $sub2[$stu];
}


echo "<br>Students deleted Successfully<br>";

?>
<br /><button onclick="opener.show('substuCorrection','mainBody');self.close()">Go Back</button>