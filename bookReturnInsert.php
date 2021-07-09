<?php
include('connect.php');


$dateyear = $_POST['dateyear'];
$datemonth = $_POST['datemonth'];
$dateday = $_POST['dateday'];
$date = "$dateyear-$datemonth-$dateday";
$stubook = $_POST['stu'];

foreach ($stubook as $nextstubook) {
	$pieces = explode(':', $nextstubook);
	$book	=	$pieces[1];
	$stu	=	$pieces[0];
	echo $book;
	echo $stu;


	$sql = "update BookLending set DateReturn = '$date' where Student='$stu' and Book='$book' ";
	mysql_query($sql)
		or die(mysql_error());
}

echo $date;
echo "<h2>Book Transaction entered Successfully</h2>";
?>

<br /><button onclick="opener.show('bookReturnEnter.php','mainBody');self.close()">Go Back</button>