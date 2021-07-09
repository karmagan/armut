<?php
include('connect.php');

$id = $_POST['id'];
$address = $_POST['address'];
$email = $_POST['email'];
$cellphone = $_POST['cellphone'];
$password = $_POST['password'];


$sql = "UPDATE Staff SET `ID #`='$id', `Address`='$address', `email`='$email',`Password`='$password', `Cell`='$cellphone' where TeacherNo='$teacher'";

$result = mysql_query($sql);
$_SESSION['passwd'] = $password;

echo "<h2>Personal Information edited Successfully<br></h2>";


?>

<br /><button onclick="opener.show('personal','mainBody');self.close()">Go Back</button>